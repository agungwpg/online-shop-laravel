<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id)
    {
      $pr = \App\Products::where('id',$id)->first();
      return view('user.myshop.detail-product',compact('pr','id'));
    }
    public function do_addproduct(Request $r)
    {
      $image = $r->file('image');
      $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/user/products/image');
      $img = \Image::make($image->getRealPath())->save($destinationPath.'/'.$input['imagename']);

      $pr = new \App\Products;

      $pr->id_category = $r->category;
      $pr->code = $r->category.'-'.(int)\App\Products::max('id');
      $pr->name = $r->name;
      $pr->description = $r->desc;
      $pr->netprice = $r->price;
      $pr->weight = $r->weight;
      $pr->stock = $r->qty;
      $pr->picture = 'user/products/image/'.$input['imagename'];
      $pr->id_user = \Auth::user()->id;

      $pr->save();

      return redirect()->route('myshop-dashboard')->with('success-add','success add new product !');
    }

    public function do_editproduct(Request $r,$id)
    {
      $image = $r->file('image');
      $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/user/products/image');
      $img = \Image::make($image->getRealPath());
      $img->resize(100, 100, function ($constraint) {
          $constraint->aspectRatio();
      })->save($destinationPath.'/'.$input['imagename']);

      $pr =  \App\Products::where('id',$id)->first();

      $pr->id_category = $r->category;
      $pr->name = $r->name;
      $pr->description = $r->desc;
      $pr->netprice = $r->price;
      $pr->weight = $r->weight;
      $pr->stock = $r->qty;
      $pr->picture = 'user/products/image/'.$input['imagename'];
      $pr->id_user = \Auth::user()->id;

      $pr->save();

      return redirect()->route('myshop-dashboard')->with('success-add','success edit product !');
    }

    public function detailproduct($id)
    {
      $pr = \App\Products::where('id',$id)->first();
      return view('user.product.detail-product',compact('pr','id'));
    }

    public function addcart(Request $r,$id)
    {
      if(!\Cart::get($id))
      {
        \Cart::add([
          'id' => $id,
          'name' => \App\Products::where('id',$id)->pluck('name')->first(),
          'price' => \App\Products::where('id',$id)->pluck('netprice')->first(),
          'quantity' => $r->qty,
          'attributed' => [
            'subtotal' => $r->price * $r->qty,
          ],
        ]);
      }
      else {
        \Cart::update($id,[
          'quantity' => $r->qty,
          'attributed' => [
            'subtotal' => $r->price * $r->qty,
          ],
        ]);
      }
      return redirect()->back();
    }



}
