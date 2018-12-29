@extends('user.component.master-user')
@section('content')

<div class="span9">

  <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li class="active"> SHOPPING CART</li>
  </ul>
  <h3>  SHOPPING CART [ <small>{{ \Cart::getContent()->count() }} Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
  <hr class="soft"/>

  @if(\Auth::guest())
  <div class="login">
    @if($errors->any())
      <div class="alert alert-danger alert-call">
        {{ $errors->first() }}
      </div>
    @endif
    <table class="table table-bordered">
      <tr><th> LOGIN TO CONTINUE TRANSACTION  </th></tr>
      <tr>
        <td>
          <form class="form-horizontal" action="{{ route('dologin-cart') }}" method="post">
            {{ csrf_field() }}
            <div class="control-group">
              <label class="control-label" for="inputUsername">Email</label>
              <div class="controls">
                <input type="email" name="email" placeholder="Email" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputPassword1">Password</label>
              <div class="controls">
                <input type="password" id="inputPassword1" name="password" placeholder="Password" required>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn">Sign in</button> OR <a href="{{ route('register') }}" class="btn">Register Now!</a>
              </div>
            </div>
          </form>
        </td>
      </tr>
    </table>
  </div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Quantity/Update</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Tax</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach(\Cart::getContent() as $data)
      <tr>
        <td> <img width="60" src="{{ asset(\App\Products::where('id',$data->id)->pluck('picture')->first()) }}" alt=""/></td>
        <td>{{ $data->name }}<br/>{{ $data->description }}</td>
        <td>
          <div class="input-append"><input class="span1 txt_qty_{{ $data->id }}" style="max-width:34px" value="{{ $data->quantity }}" size="16" type="text">
            <button value="{{ $data->id }}" class="btn btn-minus" type="button"><i class="icon-minus"></i></button>
            <button value="{{ $data->id }}" class="btn btn-plus" type="button"><i class="icon-plus"></i></button>
            <button value="{{ $data->id }}" class="btn btn-danger btn-delete-cart" type="button"><i class="icon-remove icon-white"></i></button>
          </div>
        </td>
        <td>Rp {{ number_format($data->price) }}</td>
        <td>--</td>
        <td>--</td>
        <td>Rp {{ number_format($data->price * $data->quantity) }}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="6" style="text-align:right">Total Price:	</td>
        <td> Rp {{ number_format(\Cart::getTotal()) }}</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right">Total Discount:	</td>
        <td> --</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right">Total Tax:	</td>
        <td> --</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right"><strong>TOTAL</strong></td>
        <td class="label label-important" style="display:block"> <strong> Rp {{ number_format(\Cart::getTotal()) }} </strong></td>
      </tr>
    </tbody>
  </table>

  <!-- <table class="table table-bordered">
    <tbody>
      <tr>
        <td>
          <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
              <div class="controls">
                <input type="text" class="input-medium" placeholder="CODE">
                <button type="submit" class="btn"> ADD </button>
              </div>
            </div>
          </form>
        </td>
      </tr>

    </tbody>
  </table> -->

  <!-- <table class="table table-bordered">
    <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
    <tr>
      <td>
        <form class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="inputCountry">Country </label>
            <div class="controls">
              <input type="text" id="inputCountry" placeholder="Country">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPost">Post Code/ Zipcode </label>
            <div class="controls">
              <input type="text" id="inputPost" placeholder="Postcode">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn">ESTIMATE </button>
            </div>
          </div>
        </form>
      </td>
    </tr>
  </table> -->
    <a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
  @if(!\Auth::guest())
    @if(\Cart::getContent()->count())
      <a href="{{ route('contactDetail') }}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
    @endif


  @endif


</div>
</div></div>
</div>
@stop
@section('custom-script')
<script>
var flag = 1;

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
  }
});

$(".btn-minus").click(function(){
  $.ajax({
    url: 'cartAction/minus/'+$(this).val()+'/'+$(".txt_qty_"+$(this).val()).val(),
    type: 'post',
    success: function(){
      location.reload();
    }
  })
});

$(".btn-plus").click(function(){
  $.ajax({
    url: 'cartAction/plus/'+$(this).val()+'/'+$(".txt_qty_"+$(this).val()).val(),
    type: 'post',
    success: function(){
      location.reload();
    }
  })
});

$(".btn-delete-cart").click(function(){
  $.ajax({
    url: 'deletecart/'+$(this).val(),
    type: 'post',
    success: function(){
      location.reload();
    }
  })
});

</script>
@stop
