@extends('layouts.backend')

@section('css')
  <link rel="stylesheet" href="{{ url('/') }}/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<!-- Site wrapper -->
<div class="wrapper">

  @include('layouts.header')

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  @include('layouts.sidemenu')

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Room
        <small>Management</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Room Management</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      @include('layouts.status')
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            @if( \Auth::user()->hasRole('admin') )
            <div class="box-header clearfix">
              <a href="{{ url('/dashboard/rooms/create') }}" class="btn btn-sm btn-primary pull-left">
                <i class="fa fa-plus"></i> Add New Room</a>
            </div>
            @endif
            <div class="box-body">
              <table class="table table-bordered table-hover" id="rooms-table">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Room Name</th>
                      <th>Capacity (Pax)</th>
                      <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
            @if( \Auth::user()->hasRole('admin') )
            <div class="box-footer clearfix">
              <a href="{{ url('/dashboard/rooms/create') }}" class="btn btn-sm btn-primary pull-left">
                <i class="fa fa-plus"></i> Add New Room</a>
            </div>
            @endif
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')

</div>
<!-- ./wrapper -->
@endsection

@section('js')
<script src="{{ url('/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(function() {
    $('#rooms-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: "{!! url('/datatables/rooms') !!}",
        columns: [
            { data: 'DT_Row_Index', name: 'index', orderable: false, searchable: false},
            { data: 'name', name: 'name' },
            { data: 'pax', name: 'pax' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [
          {
            "className": "text-center",
            "targets": [2,3],
          }
        ],
        order: [ 1, "asc" ]
    });

    $('#rooms-table').DataTable().on('click', '.btn-danger[data-remote]', function (e) {
      e.preventDefault();
      
      var url = $(this).data('remote');
      var roomName = $(this).data('name');
      var token = $('meta[name="csrf-token"]').attr('content');

      if(confirm('Are you sure to delete ' + roomName + '?'))
      {
        $.ajax({
          url: url,
          type: 'POST',
          data: {'_method' : 'DELETE', '_token' : token},
          success: function () {
            $('#rooms-table').DataTable().draw();
            alert(roomName + ' was deleted!');            
          }
        });
      }
    });
});
</script>
@endsection