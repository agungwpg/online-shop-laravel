@extends('admin.component.master')
@section('title')
My Products
@stop

@section('content')
@if (Session::has('success-add'))
    <div class="alert alert-success alert-call">
        <p>{{ Session::get('success-add') }}</p>
    </div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Products Data</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <a href="{{ route('add-product') }}" class="btn btn-lg btn-primary btn-block">+ Add Product</a>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-12">
            <table class="table table-responsive tbl-product">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                @foreach(\App\Products::all() as $data)
                <tr>
                  <td>{{ $data->code }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->netprice }}</td>
                  <td>{{ $data->stock }}</td>
                  <td><a href="{{ route('detail-product-my',$data->id) }}" class="btn btn-xs btn-success">Detail</a>
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
