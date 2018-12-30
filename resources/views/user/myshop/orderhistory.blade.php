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
            <th>Status</th>
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
              @if($data->status == 0)
                <td>Waiting Payment</td>
              @else
                <td>Paid</td>
              @endif
              <td><button type="button" class="btn btn-sm btn-primary btn-detail" data-toggle="modal" data-target="#detail_tran" data-id="{{ $data->id }}">Detail</button></td>
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

<div class="modal fade" id="detail_tran" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transaction Detail</h4>
        </div>
        <div class="modal-body">
          <div class="mdl-content">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


@stop
@section('custom-script')
<script>
var flag = 0;
var id;
$(".btn-detail").click(function(){
  id = $(this).data("id");
});

$.ajaxSetup({
  headers: {
    'X-CSRF_TOKEN' : '{{ csrf_token() }}'
  }
})

$("#detail_tran").on('show.bs.modal',function(){
  $.ajax({
    url: 'orderhistorydetail/'+id,
    type: 'get',
    success: function(data)
    {
      $(".mdl-content").html(data);
    }
  })
});

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
