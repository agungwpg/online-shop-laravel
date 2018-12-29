@extends('admin.component.master')
@section('title')
Detail Products
@stop

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Products Data</h3>
      </div>
      <div class="box-body">
        <div class="row edit-con">
          <div class="col-md-3">
            <button type="button" class="btn btn-md btn-success btn-block btn-edit">Edit Data</button>
          </div>
        </div>
        <div class="row batal-con" style="display:none">
          <div class="col-md-3">
            <button type="button" class="btn btn-md btn-danger btn-block btn-batal">Batal</button>
          </div>
        </div>
        <div class="row" style="margin-top:15px">
          <div class="col-md-12">
            <form id="formedit" class="form-horizontal" action="{{ route('do-edit-product',$id) }}" enctype="multipart/form-data" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-md-6">
                  <label>Product Name : </label>
                  <input type="text" class="form-control" name="name" value="{{ $pr->name }}" required/>
                </div>
                <div class="col-md-2">
                  <label>Qty : </label>
                  <input type="number" class="form-control" name="qty"value="{{ $pr->stock }}" required/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <label>Category</label>
                  <select name="category" class="form-control">
                    @foreach(\App\Category::all() as $data)
                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label>Description</label>
                  <textarea class="form-control" name="desc" rows="5" value="{{ $pr->description }}" required></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                  <label>Price per Item</label>
                  <input type="number" class="form-control" name="price" value="{{ $pr->netprice }}" required/>
                </div>
                <div class="col-md-2">
                  <label>Weight per Item</label>
                  <input type="number" class="form-control" name="weight" value="{{ $pr->weight }}" required/>
                </div>
              </div>
              <div class="form-group dis-img">
                <div class="col-md-6">
                  <img id="blah" src="{{ asset($pr->picture) }}" alt="your image" weight="100" height="100"/>
                </div>
              </div>
              <div class="form-group img-con" style="display:none">
                <div class="col-md-6">
                  <label>Picture</label>
                  <input type="file" class="form-control" name="image" id="imgInp" required/>
                </div>
              </div>
              <div class="form-group submit-con" style="display:none">
                <div class="col-md-3">
                  <button type="button" class="btn btn-success btn-block btn-md btn-tambah">Submit</button>
                </div>
              </div>
            </form>
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
  $("#formedit :input").attr('disabled',true);
})(jQuery);

$(".btn-edit").click(function(){
  $(".batal-con").show();
  $(".edit-con").hide();
  $("#formedit :input").attr('disabled',false);
  $(".submit-con").show();
  $(".img-con").show();
});

$(".btn-batal").click(function(){
  location.reload();
});



$(".tbl-product").DataTable();
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    $(".dis-img").show();
    readURL(this);
});

$(".btn-tambah").click(function(){
  var conf = confirm("Are you sure to add this product to your product list");

  if(conf == true)
  {
    $("#formedit").submit();
  }
});
</script>
@stop
