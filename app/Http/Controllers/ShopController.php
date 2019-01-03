<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function searchitem($name,$category)
    {
      return view('user.product.search-result',compact('name','category'));
    }

    public function categoryitem($category)
    {
      return view('user.product.category-item',compact('category'));
    }

    public function deletecart($id)
    {
      \Cart::remove($id);
      return redirect()->back();
    }

    public function transaction()
    {
      \Cart::clear();
      return redirect()->back();
    }

    public function cartAction($action,$id,$jumlah)
    {
        if($action == 'minus')
        {
          \Cart::update($id,[
            'quantity' => -1
          ]);
        }
        else
        {
          if($jumlah >= \App\Products::where('id',$id)->pluck('stock')->first())
          {
            return redirect()->back()->with('error-add','set');
          }
          else {
            \Cart::update($id,[
              'quantity' => +1
            ]);
          }
        }
    }

    public function doOrder(Request $r)
    {
      $weighttotal = 0;

      foreach(\Cart::getContent() as $data)
      {
        $weighttotal = $weighttotal*(\App\Products::where('id',$data->id)->pluck('weight')->first()*$data->quantity);
      }

      $orders = new \App\Orders;
      $orders->id_confirmation = date('Y').date('m').date('d').\App\Orders::max('id')+1;
      $orders->code = $orders->id_confirmation;
      $orders->weight_total = $weighttotal;
      $orders->payment_deadline = date('Y-m-d', strtotime(date('Y-m-d H:i:s'). ' +1 day'));
      $orders->payment_method = 'Transfer';
      $orders->user_id = \Auth::user()->id;
      $orders->fullname = $r->fullname;
      $orders->phone_number = $r->phone;
      $orders->city = $r->city;
      $orders->address = $r->address;
      $orders->zip = $r->zipcode;
      $orders->status = 0;
      $orders->service = 0;
      $orders->ongkir = 40000;
      $orders->total = \Cart::getTotal();
      $orders->save();

      foreach(\Cart::getContent() as $data)
      {
        $detail = new \App\OrderDetail;
        $detail->qty = $data->quantity;
        $detail->id_order = \App\Orders::max('id');
        $detail->discount_percent = 0;
        $detail->net_price = \App\Products::where('id',$data->id)->pluck('netprice')->first()*$data->quantity;
        $detail->id_products = $data->id;
        $detail->save();
      }

      // \Cart::clear();

      return redirect()->route('detail-transfer',$detail->id_order);

    }

    public function doconfirm(Request $r)
    {

      $image = $r->invoice;
      $image->move(public_path().'/user/invoice/',\App\Orders::max('id').'.jpg');

      $conf = new \App\Confirmation;
      $conf->id_order = $r->orderid;
      $conf->sender_bank = $r->sender;
      $conf->bank_account_name = $r->accname;
      $conf->reciever_bank = $r->transferto;
      $conf->amount = $r->amount;
      $conf->payment_date = $r->date;
      $conf->id_user = \Auth::user()->id;
      $conf->invoice = 'user/invoice/'.\App\Orders::max('id').'.jpg';
      $conf->status = 0;
      $conf->resi = 0;

      $conf->save();

      return redirect()->to('/')->with('success-confirm','set');
    }

    public function actionconfirmation($id,$type)
    {
      if($type == 'confirm')
      {
        $conf = \App\Confirmation::where('id',$id)->first();
        $conf->status = 1;
        $conf->save();

        $trans = \App\Orders::where('id',\App\Confirmation::where('id',$id)->pluck('id_order'))->first();
        $trans->status = 1;
        $trans->save();

        foreach(\App\OrderDetail::where('id_order',\App\Confirmation::where('id',$id)->pluck('id_order')->first())->get() as $data)
        {
          $prod = \App\Products::where('id',$data->id_products)->first();
          $prod->stock = $prod->stock-$data->qty;
          $prod->save();
        }

        return redirect()->back()->with('success-accept','set');
      }
      else {
        $conf = \App\Confirmation::where('id',$id)->first();
        $conf->status = -1;
        $conf->save();

        return redirect()->back()->with('success-decline','set');
      }
    }

    public function checkoutcashier()
    {
      $orders = new \App\Orders;
      $orders->id_confirmation = date('Y').date('m').date('d').\App\Orders::max('id')+1;
      $orders->code = 0;
      $orders->weight_total = 0;
      $orders->payment_deadline = date('Y-m-d');
      $orders->payment_method = 'Cash';
      $orders->user_id = 0;
      $orders->fullname = 0;
      $orders->phone_number = 0;
      $orders->city = 0;
      $orders->address = 0;
      $orders->zip = 0;
      $orders->status = 0;
      $orders->service = 0;
      $orders->ongkir = 0;
      $orders->total = \Cart::getTotal();
      $orders->save();

      foreach(\Cart::getContent() as $data)
      {
        $detail = new \App\OrderDetail;
        $detail->qty = $data->quantity;
        $detail->id_order = \App\Orders::max('id');
        $detail->discount_percent = 0;
        $detail->net_price = \App\Products::where('id',$data->id)->pluck('netprice')->first()*$data->quantity;
        $detail->id_products = $data->id;
        $detail->save();
      }

      foreach(\App\OrderDetail::where('id_order',\App\Orders::max('id'))->get() as $data)
      {

        $prod = \App\Products::where('id',$data->id_products)->first();
        $prod->stock = $prod->stock-$data->qty;
        $prod->save();
      }

      \Cart::clear();
    }

    public function refreshreport($month,$year)
    {
      $type = '0';
      if($month == 0)
      {
        $type = '1';
        $jan = \App\Orders::whereMonth('created_at','01')->whereYear('created_at',$year)->sum('total');
        $feb = \App\Orders::whereMonth('created_at','02')->whereYear('created_at',$year)->sum('total');
        $mar = \App\Orders::whereMonth('created_at','03')->whereYear('created_at',$year)->sum('total');
        $apr = \App\Orders::whereMonth('created_at','04')->whereYear('created_at',$year)->sum('total');
        $mei = \App\Orders::whereMonth('created_at','05')->whereYear('created_at',$year)->sum('total');
        $jun = \App\Orders::whereMonth('created_at','06')->whereYear('created_at',$year)->sum('total');
        $jul = \App\Orders::whereMonth('created_at','07')->whereYear('created_at',$year)->sum('total');
        $ags = \App\Orders::whereMonth('created_at','08')->whereYear('created_at',$year)->sum('total');
        $sep = \App\Orders::whereMonth('created_at','09')->whereYear('created_at',$year)->sum('total');
        $okt = \App\Orders::whereMonth('created_at','10')->whereYear('created_at',$year)->sum('total');
        $nov = \App\Orders::whereMonth('created_at','11')->whereYear('created_at',$year)->sum('total');
        $des = \App\Orders::whereMonth('created_at','12')->whereYear('created_at',$year)->sum('total');

        return view('user.myshop.refresh-report',compact('jan','feb','mar','apr','mei','jun','jul','ags','sep','okt','nov','des','type'));
      }
      else {
        $type = '2';
        $data = json_encode(\DB::table('order_details')->select(\DB::raw('sum(order_details.qty) as total, products.name as name'))
                ->join('products','order_details.id_products','=','products.id')
                ->whereMonth('created_at',$month)->whereYear('created_at',$year)
                ->take(10)->groupBy('products.name')->get());
        return view('user.myshop.refresh-report',compact('data','type'));
      }
    }
}
