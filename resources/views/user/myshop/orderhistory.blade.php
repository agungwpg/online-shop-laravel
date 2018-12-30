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
    <li class="active">Order History</li>
  </ul>
  <h3> Order History</h3>
  <div class="col-md-12">

    <div class="well">

      @if(\App\Orders::where('user_id',\Auth::user()->id)->first())
      <table class="table table-bordered table-striped tables1">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Payment Deadline</th>
            <th>Fullname</th>
            <th>Phone Number</th>
            <th>City</th>
            <th>Address</th>
            <th>Zip Code</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
          @foreach(\App\Orders::where('user_id',\Auth::user()->id)->get() as $data)
            <tr>
              <td>{{ $data->id }}</td>
              <td>{{ $data->order_date }}</td>
              <td>{{ $data->payment_deadline }}</td>
              <td>{{ $data->fullname }}</td>
              <td>{{ $data->phone_number }}</td>
              <td>{{ $data->city }}</td>
              <td>{{ $data->address }}</td>
              <td>{{ $data->zip }}</td>
              <td><button type="button" class="btn btn-sm btn-primary">Detail</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <h4>You do not have any order</h4>
        <br/>
        <a href="{{ url('/') }}" class="btn btn-md btn-primary">Shop Now!</a>
      @endif


    </div>
  </div>

</div>
</div>
</div>
</div>
@stop
@section('custom-script')
<script>
var flag = 0;

// $(".tables1").DataTable();

$(".btn-register").click(function(e){
  if($("#txtpassword").val() != $("#txtrepassword").val())
  {
    e.preventDefault();
    alert("Password and Re-type password must be same");
  }
});


</script>
@stop
