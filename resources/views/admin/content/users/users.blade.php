@extends('admin.component.master')

@section('title')
Users
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
                <th>Username</th>
                <th>Fullname</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Role</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach(\App\User::where('id_role','<>',2)->get() as $data)
                <tr>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->full_name }}</td>
                  <td>{{ $data->address }}</td>
                  <td>{{ $data->phone }}</td>
                  <td>{{ \App\Role::where('id',$data->id_role)->pluck('role')->first() }}</td>
                  <td><button value="{{ $data->id }}" class="btn btn-sm btn-success btn-edit" data-username="{{ $data->email }}" data-fullname="{{ $data->full_name }}" data-address="{{ $data->address }}" data-phone="{{ $data->phone }}" data-role="{{ $data->id_role }}" data-toggle="modal" data-target="#edit">Edit</button>
                  <a href="{{ route('deleteusers',$data->id) }}" class="btn btn-sm btn-danger btn-delete">Hapus</a>
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
        Add Users
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('addusers') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Username: </label>
            <input type="text" class="form-control" name="username" required/>
          </div>
          <div class="form-group">
            <label>Password: </label>
            <input type="text" class="form-control" name="password" required/>
          </div>
          <div class="form-group">
            <label>Full Name: </label>
            <input type="text" class="form-control" name="fullname" required/>
          </div>
          <div class="form-group">
            <label>Address: </label>
            <input type="text" class="form-control" name="address" required/>
          </div>
          <div class="form-group">
            <label>Phone Number: </label>
            <input type="text" class="form-control" name="phone" required/>
          </div>
          <div class="form-group">
            <label>Role: </label>
            <select class="form-control" name="role">
              <option value="1">Admin</option>
              <option value="3">Kasir</option>
            </select>
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
        Edit Users
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('editusers') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <input type="hidden" class="txtid" name="id">
          <div class="form-group">
            <label>Username: </label>
            <input type="text" class="form-control txt-username" name="username" required/>
          </div>
          <div class="form-group">
            <label>Password: </label>
            <input type="text" class="form-control txt-password" name="password" />
          </div>
          <div class="form-group">
            <label>Full Name: </label>
            <input type="text" class="form-control txt-fullname" name="fullname" required/>
          </div>
          <div class="form-group">
            <label>Address: </label>
            <input type="text" class="form-control txt-address" name="address" required/>
          </div>
          <div class="form-group">
            <label>Phone Number: </label>
            <input type="text" class="form-control txt-phone" name="phone" required/>
          </div>
          <div class="form-group">
            <label>Role: </label>
            <select class="form-control sel-role" name="role">
              <option value="1">Admin</option>
              <option value="3">Kasir</option>
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

var id,nama,address,phone,full,role;

$("#tbl").on('click','.btn-edit',function(){
  id = $(this).val();
  nama = $(this).data('username');
  address= $(this).data('address');
  role= $(this).data('role');
  phone= $(this).data('phone');
  full= $(this).data('fullname');
});

$('#edit').on('show.bs.modal',function(){
  $(".txtid").val(id);
  $(".txt-username").val(nama);
  $(".txt-address").val(address);
  $(".sel-role").val(role);
  $(".txt-phone").val(phone);
  $(".txt-fullname").val(full);
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
