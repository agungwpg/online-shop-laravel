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
    <li class="active">Registration</li>
  </ul>
  <h3> Registration</h3>
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
<form class="form-horizontal" method="post" action="{{ route('doregister') }}">
  {{ csrf_field() }}
  <h4>Your personal information</h4>

  <div class="control-group">
    <label class="control-label" for="inputFname1">Email <sup>*</sup></label>
    <div class="controls">
      <input type="email" placeholder="email" name="email" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLnam">Fullname<sup>*</sup></label>
    <div class="controls">
      <input type="text" placeholder="fullname" name="fullname" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
    <div class="controls">
      <input type="password" id="txtpassword" placeholder="Password" name="password" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword1">Re-type Password<sup>*</sup></label>
    <div class="controls">
      <input type="password" id="txtrepassword" placeholder="Re-type password" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLnam">Phone Number<sup>*</sup></label>
    <div class="controls">
      <input type="number" placeholder="Phone Number" name="phone" required>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <input type="hidden" name="email_create" value="1">
      <input type="hidden" name="is_new_customer" value="1">
      <input class="btn btn-large btn-success btn-register" type="submit" value="Register" />
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
