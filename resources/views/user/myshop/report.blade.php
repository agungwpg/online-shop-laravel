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
            <select class="form-control type">
              <option value="1">Total Sales Per Month</option>
              <option value="2">Most Sold Items</option>
            </select>
          </div>
          <div class="col-md-2 month" style="display: none;">
            <select class="form-control sel-month">
              <option class="val0" value="00">--select--</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">July</option>
              <option value="07">June</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
          </div>
          <div class="col-md-2 year">
            <select class="form-control sel-year">
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary btn-block btn-show">Show</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 graf" style="margin-top:20px">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('custom_script')
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
  }
})

$(".btn-show").click(function(){
  $.ajax({
    url: 'refreshreport/'+$(".sel-month").val()+'/'+$(".sel-year").val(),
    type: 'GET',
    success: function(data){
      $(".graf").html(data);
    }
  })
});

(function($){
  $(".alert-call").fadeOut(2500);
})(jQuery);
$(".tbl-product").DataTable();

$(".type").change(function(){
  if($(this).val() == 1)
  {
    $(".year").show();
    $(".month").hide();
    $(".sel-month").val("00");
  }
  else {
    $(".year").show();
    $(".month").show();
    $(".sel-month").val("01");
    $(".val0").hide();
  }
});
</script>
@stop
