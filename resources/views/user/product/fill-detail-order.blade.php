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
  <h3> Data Order</h3>
  <div class="well">
    <!--
    <div class="alert alert-info fade in">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
  </div>
  <div class="alert fade in">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
</div>
<div class="alert alert-block alert-error fade in">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
</div> -->
<form class="form-horizontal" method="post" action="{{ route('doOrder') }}">
  {{ csrf_field() }}
  <h4>Destination Detail</h4>

  <div class="control-group">
    <label class="control-label" for="inputLnam">Fullname<sup>*</sup></label>
    <div class="controls">
      <input type="text" placeholder="fullname" value="{{ \Auth::user()->full_name }}" name="fullname" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLnam">Phone Number<sup>*</sup></label>
    <div class="controls">
      <input type="text" placeholder="Phone Number" value="{{ \Auth::user()->phone }}" name="phone" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLnam">City<sup>*</sup></label>
    <div class="controls">
      <input type="text" placeholder="Address" value="{{ \Auth::user()->kota }}" name="city" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLnam">Address<sup>*</sup></label>
    <div class="controls">
      <input type="text" placeholder="Address" value="{{ \Auth::user()->address }}" name="address" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLnam">Zip Code<sup>*</sup></label>
    <div class="controls">
      <input type="text" placeholder="Zip Code" value="{{ \Auth::user()->zip }}" name="zipcode" required>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <input type="hidden" name="email_create" value="1">
      <input type="hidden" name="is_new_customer" value="1">
      <input class="btn btn-large btn-success btn-register" type="submit" value="Order" />
    </div>
  </div>
</form>
</div>

</div>
</div>
</div>
</div>
@stop
@section('custom-script')
<script>
var flag = 1;

$(".btn-register").click(function(e){
  if($("#txtpassword").val() != $("#txtrepassword").val())
  {
    e.preventDefault();
    alert("Password and Re-type password must be same");
  }
});


</script>
@stop
