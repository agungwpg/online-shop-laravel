@extends('admin.component.master')

@section('title')
Data Jenis Barang
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
                <th>Nama Jenis</th>
                <th>All Size</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach(\App\JenisBarang::where('id_clients',\Auth::user()->id_clients)->get() as $data)
                <tr>
                  <td>{{ $data->nama }}</td>
                  <td>
                    @if($data->all_size == 0)
                      Tidak
                    @else
                      Ya
                    @endif
                  </td>
                  <td><button value="{{ $data->id }}" class="btn btn-sm btn-success btn-edit" data-nama="{{ $data->nama }}" data-allsize="{{ $data->all_size }}" data-toggle="modal" data-target="#edit">Edit</button>
                  <a href="{{ route('deletejenisbarang',$data->id) }}" class="btn btn-sm btn-danger btn-delete">Hapus</a>
                  <!-- <form class="formdelete_{{ $data->id }}" method="post" action="{{ route('deletejenisbarang',$data->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                  </form> -->
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
        Tambah Data Jenis Barang
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('tambahjenisbarang') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Nama Jenis: </label>
            <input type="text" class="form-control" name="nama" required/>
          </div>
          <div class="form-group">
            <label>All Size: </label>
            <select class="form-control" name="allsize">
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-selesai">Tambah</button>
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
        Edit Data Jenis Barang
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('editjenisbarang') }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <input type="hidden" class="txtid" name="id">
          <div class="form-group">
            <label>Nama Jenis: </label>
            <input type="text" class="form-control txt-jenis" name="nama" required/>
          </div>
          <div class="form-group">
            <label>All Size: </label>
            <select class="form-control sel-allsize" name="allsize">
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
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

var idjb,nama,allsize;

$("#tbl").on('click','.btn-edit',function(){
  idjb = $(this).val();
  nama = $(this).data('nama');
  allsize = $(this).data('allsize');
});

$('#edit').on('show.bs.modal',function(){
  $(".txtid").val(idjb);
  $(".txt-jenis").val(nama);
  $(".sel-allsize").val(allsize);
});

$("#tbl").on('click','.btn-delete',function(e){
  var conf = confirm('apakah anda yakin ingin menghapus data ini ?');
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
