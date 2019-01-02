@extends('admin.component.master')

@section('title')
Slides
@stop

@section('content')
@if (Session::has('success-add'))
    <div class="alert alert-success alert-call">
        <p>{{ Session::get('success-add') }}</p>
    </div>
@endif
@if (Session::has('success-edit'))
    <div class="alert alert-success alert-call2">
        <p>{{ Session::get('success-edit') }}</p>
    </div>
@endif
@if (Session::has('success-delete'))
    <div class="alert alert-success alert-call3">
        <p>{{ Session::get('success-delete') }}</p>
    </div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <div class="row">
          <div class="col-md-2">
            <button class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#tambah">+ Tambah Data</button>
          </div>
        </div>
        <div class="row" style="margin-top:15px">
          <div class="col-md-12 tablehistori">
            <table class="table table-responsive table-bordered" id="tbl">
              <thead>
                <th>Title</th>
                <th>Picture</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach(\App\Slides::all() as $data)
                <tr>
                  <td>{{ $data->title }}</td>
                  <td><img src="{{ $data->picture }}" style="height: 100px;width: 200px"></td>
                  <td><button value="{{ $data->id }}" class="btn btn-sm btn-success btn-edit" data-title="{{ $data->title }}" data-toggle="modal" data-target="#edit">Edit</button>
                  <a href="{{ route('deleteslides',$data->id) }}" class="btn btn-sm btn-danger btn-delete">Hapus</a>
                </td>
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


<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        Add Slider Image
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('addslides') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Title: </label>
            <input type="text" class="form-control" name="title" required/>
          </div>
          <div class="form-group">
            <label>Picture: </label>
            <input type="file" class="form-control" name="picture" required/>
          </div>
          <!-- <div class="form-group">
            <label>Position: </label>
            <input type="text" class="form-control" name="nama" required/>
          </div> -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-selesai">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        Edit Category
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('editslides') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <input type="hidden" class="txtid" name="id">
          <div class="form-group">
            <label>Title: </label>
            <input type="text" class="form-control txt-title" name="title" required/>
          </div>
          <div class="form-group">
            <label>Image: </label>
            <input type="file" class="form-control" name="picture"/>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-selesai">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop
@section('custom_script')
<script>

</script>
<script>
$("#tbl").DataTable({
});

function _confirm()
{

  var confirm = confirm("apakah anda yakin ingin menghapus data ini ?")

  // if (confirm == false) {
  //  event.preventDefault();
  // }
}

var id,nama;

$("#tbl").on('click','.btn-edit',function(){
  id = $(this).val();
  nama = $(this).data('title');
});

$('#edit').on('show.bs.modal',function(){
  $(".txtid").val(id);
  $(".txt-title").val(nama);
});

$("#tbl").on('click','.btn-delete',function(e){
  var conf = confirm('are you sure want to delete this data ?');
  if(conf == false)
  {
    e.preventDefault();
  }
});

(function($){
  $(".alert-call").fadeOut(2500);
  $(".alert-call2").fadeOut(2500);
  $(".alert-call3").fadeOut(2500);
})(jQuery);
</script>
@stop
