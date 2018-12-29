@extends('admin.component.master')
@section('title')
My Products
@stop

@section('content')
@if (Session::has('success-accept'))
  <script>
    alert('confirmation accept success');
  </script>
@endif
@if (Session::has('success-decline'))
  <script>
    alert('confirmation decline success');
  </script>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Products Data</h3>
      </div>
      <div class="box-body">
        <div class="row" style="margin-top:20px">
          <div class="col-md-12">
            <table class="table table-responsive tbl-product">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>User ID</th>
                  <th>Sender Bank</th>
                  <th>Account Name</th>
                  <th>Transfer To</th>
                  <th>Amount</th>
                  <th>Payment Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach(\App\Confirmation::where('status',0)->get() as $data)
                <tr>
                  <td>{{ $data->id_order }}</td>
                  <td>{{ $data->id_user }}</td>
                  <td>{{ $data->sender_bank }}</td>
                  <td>{{ $data->bank_account_name }}</td>
                  <td>{{ $data->reciever_bank }}</td>
                  <td>{{ $data->amount }}</td>
                  <td><a href="{{ route('c-action',[$data->id,'confirm']) }}" class="btn btn-xs btn-success">Confirm</a>
                  <a href="{{ route('c-action',[$data->id,'decline']) }}" class="btn btn-xs btn-danger">Decline</a></td>
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
@stop
@section('custom_script')
<script>
(function($){
  $(".alert-call").fadeOut(2500);
})(jQuery);
$(".tbl-product").DataTable();
</script>
@stop
