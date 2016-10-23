@extends('layouts.backend')

@section('css')
  <link rel="stylesheet" href="{{ url('/') }}/css/skins/_all-skins.min.css">
  <!-- Fullcalendar -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/fullcalendar/fullcalendar.min.css">
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
        <li><a href="{{ url('/dashboard/rooms') }}"><i class="fa fa-dashboard"></i> Room Management</a></li>
        <li class="active">{{ $room->name }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      @include('layouts.status')
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div id="calendar"></div>
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
<script src="{{ url('/') }}/plugins/fullcalendar/moment.min.js"></script>
<script src="{{ url('/') }}/plugins/fullcalendar/fullcalendar.min.js"></script>
<script>
$(function() {
  
  var base_url = '{{ url('/') }}';

  $('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: '{{ date('Y-m-d') }}',
      navLinks: false,
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: base_url + '/api/events-by-room-id/' + {{ $room->id }},
        error: function() {
          alert("cannot load json");
        }
      }
  });
});
</script>
@endsection