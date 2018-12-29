@extends('admin.component.master')
@section('title')
@stop

@section('content')
<div class="row">
  <div class="col-md-6">
    <h4>Total : </h4><h1><strong class="total-blj">Rp {{ number_format(\Cart::getSubTotal()) }} </strong></h1>
  </div>
</div>
<div class="row" style="margin-top:15px">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body">
        <table class="table table-bordered tbl-cat">
          <thead>
            <th>Code</th>
            <th>Product Name</th>
            <th>Stock</th>
            <th>Price</th>
            <th></th>
          </thead>
          <tbody>
            @foreach(\App\Products::all() as $data)
            <tr>
                <td>{{ $data->code }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->stock }}</td>
                <td>{{ $data->netprice }}</td>
                <td>
                  <form class="form-horizontal qtyFrm" action="{{ route('addcart',$data->id) }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="qty" value="1">
                  <input type="hidden" name="price" value="{{ $data->netprice }}">
                  <div class="control-group">
                      <button type="submit" class="btn btn-sm btn-add-cart"> + <i class=" icon-shopping-cart"></i></button>
                    </div>
                  </div>
                </form></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-body">
          <div class="col-md-12 tablebarang">
            <div class="row">
              <form id="formsubmit" method="post">
                <div class="col-md-4" style="margin-bottom:10px">
                  <button type="button" class="btn btn-block btn-primary btn-checkout" data-toggle="modal" data-target="#checkout">Checkout</button>
                </div>
              </form>
            </div>
            <div class="row">
              <table class="table table-bordered">
                <thead>
                  <th>Code</th>
                  <th>Product Name</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach(\Cart::getContent() as $data)
                  <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{ $data->price }}</td>
                    <td>
                      <form class="form-horizontal qtyFrm" action="{{ route('deletecart',$data->id) }}" method="post">
                      {{ csrf_field() }}
                      <div class="control-group">
                          <button type="submit" class="btn btn-danger btn-sm"> - <i class=" icon-shopping-cart"></i></button>
                        </div>
                      </div>
                    </form></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal-footer">
</div>
</div>

</div>
</div>

<div id="checkout" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-manual">
          <div class="form-group">
            <label>Total : </label>
            <input type="text" value="{{ \Cart::getSubTotal() }}" class="form-control txt-total" readonly/>
          </div>
          <div class="form-group">
            <label>Cash : </label>
            <input type="text" class="form-control txt-payment"/>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control txt-change" readonly/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-done">Done</button>
      </div>
    </div>

  </div>
</div>
@stop
@section('custom_script')
<script>
$(".btn-done").click(function(){
  if(parseInt($(".txt-total").val()) > parseInt($(".txt-payment").val()))
  {
    alert("insufficient cash payment");
  }
  else {
    $(".txt-change").val(parseInt($(".txt-payment").val())-parseInt($(".txt-total").val()));
    var conf = confirm("Change: "+ $(".txt-change").val()  +", Do you want to print the bill ?");
    if(conf == true)
    {
      window.location.href = '{{ route("transaction") }}'
    }
    else {
      window.location.href = '{{ route("transaction") }}'
    }
  }
});

</script>
@stop
