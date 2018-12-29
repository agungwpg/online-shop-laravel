@extends('user.component.master-user')
@section('content')

<div class="span9">
  @if(\Session::has('failed-register'))
    <script>
      alert('email address has already registerd. Try register with another email');
    </script>
  @endif
  <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li class="active">Order Detail</li>
  </ul>
  <div class="well">
    <div align="center">
      <div class="col-md-8" align="center">
        <div class="row">
          <div class="col-md-12" align="center">
            <h2>Transaction Success</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <h4>Order ID : {{ $id_order }}*</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <h4>Checkout Total : Rp {{ number_format($total) }}</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <hr style="color:black;margin-left:16px"/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <p>Payment can be transferred to following banks : </p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <p>-Bank 1 </p>
            <p>-Bank 2 </p>
            <p>-Bank 3 </p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <hr style="color:black;margin-left:16px"/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <h5>Note:</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <p><strong>*Make sure you already save your order id. The order id will be used for confirmation transaction</strong></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" align="center">
            <p>After the amount transferred to a bank, please do payment confirmation on from<br/> the button below, or conformation menu on the navigation bar </p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6" align="center">
            <a href="{{route('confirm-payment')}}" class="btn btn-md btn-primary">Confirm Payment Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
@stop
@section('custom-script')
<script>
var flag = 1;

</script>
@stop
