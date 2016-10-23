@extends('layouts.backend')

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/datatables/dataTables.bootstrap.css">
  <!-- Skin -->
  <link rel="stylesheet" href="{{ url('/') }}/css/skins/_all-skins.min.css">
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
        <li class="active">Booking Management</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      @include('layouts.status')
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header clearfix">
              <h3 class="box-title">View all booking record</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover" id="booking-table">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Room Name</th>
                      @if(\Auth::user()->hasRole('admin'))
                      <th>Booked By</th>
                      @endif
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Duration</th>
                      <th style="width:95px">Action / Status</th>
                    </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
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
<script src="{{ url('/') }}/plugins/daterangepicker/moment.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
<script>
$(function() {
    
    $('#booking-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: "{!! url('/datatables/all-room-booking') !!}",
        columns: [
            { data: 'DT_Row_Index', name: 'index', orderable: false, searchable: false},
            { data: 'room.name', name: 'room.name' },
            @if(\Auth::user()->hasRole('admin'))
            { data: 'user.name', name: 'user.name' },
            @endif
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date' },
            { data: 'duration', name : 'duration'},
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#booking-table').on('click', 'button', function(e) {
      e.preventDefault();

      var button = $(this);
      var url = $(this).data('remote');
      var roomName = $(this).data('name');
      var token = $('meta[name="csrf-token"]').attr('content');
      var method = $(this).data('method');

      if(confirm('Are you sure to cancel ' + roomName + '?'))
      {
        $.ajax({
          url: url,
          type: 'POST',
          data: {'_token' : token, '_method' : method},
          success: function (data) {
            button.text('Cancelled');
            button.removeClass('btn-danger').addClass('btn-success');
          },
          error: function(data) {
            alert(data.responseText);
          }
        });
      }

    }); // end onclick
});
</script>
@endsection