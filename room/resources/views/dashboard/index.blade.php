@extends('layouts.backend')

@section('css')
  <link rel="stylesheet" href="{{ url('/') }}/css/skins/_all-skins.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/daterangepicker/daterangepicker.css">
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
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    @if(\Auth::user()->hasRole('admin'))
    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bed"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Room</span>
              <span class="info-box-number">{{ \App\Room::all()->groupBy('id')->count() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Booking<br>this month</span>
              <span class="info-box-number">
                {{ \App\Booking::where('start_date', '>=', \Carbon\Carbon::now()->startOfMonth())->get()->count() }}
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total User</span>
              <span class="info-box-number">{{ \App\User::all()->count() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active User</span>
              <span class="info-box-number">{{ \App\User::where('verified', 1)->get()->count() }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12 hidden-xs">
          <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">{{ \App\User::orderBy('created_at','desc')->take(10)->get()->count() }} Latest Registered User</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
              <?php $now = \Carbon\Carbon::now('Asia/Kuala_Lumpur');?>
              @foreach(\App\User::orderBy('created_at','desc')->take(10)->get() as $user)
                <li style="width:10%">
                  <img src="{{ Gravatar::get($user->email, ['size' => 128]) }}" alt="User Image">
                  <a class="users-list-name" href="{{ url('/dashboard/user/profile/' . $user->id) }}">{{ $user->name }}</a>
                  <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                </li>
              @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ url('/dashboard/users') }}" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      @if( count($latestBooking) > 0 )
      <div class="row">
        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $latestBooking->count() }} Active Booking</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th style="width:100px">#</th>
                    <th>Room Name</th>
                    <th style="width:150px">Booked By</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @foreach($latestBooking as $booking)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ \App\Room::where('id',$booking->room_id)->first()->name }}</td>
                    <td>{{ \App\User::find($booking->user_id)->name }}</td>
                    <td>{{ $booking->start_date->format('j M Y, H:i') }}</td>
                    <td>{{ $booking->end_date->format('j M Y, H:i') }}</td>
                    <td>
                      {{ $booking->duration }}
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @endif

    </section>
    <!-- /.content -->
    @else
    <section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Search for available rooms:</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form id="search" action="{{ url('/dashboard/booking/search') }}" method="POST">
        {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <!-- Date and time range -->
              <div class="form-group">
                <label>Select date and time range:</label>

                <div class="input-group">
                  <input type="text" class="form-control pull-right" name="reservationTime" id="reservationTime">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label>Number of pax</label>
                <select class="form-control" style="width: 100%;" name="pax">
                  <option value="">Please select one</option>
                  @foreach(\DB::table('rooms')->select('pax')->orderBy('pax')->groupBy('pax')->get() as $room)
                  <option>{{ $room->pax }}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <div id="loading" class="text-center">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
      </div>

      <div id="result" class="row"></div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">My ({{ $latestBooking->count() }}) Active Booking</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              @if( count($latestBooking) > 0 )
                <table class="table no-margin" id="booking-table">
                  <thead>
                  <tr>
                    <th style="width:100px">#</th>
                    <th>Room Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th style="text-align:center">Duration</th>
                    <th style="width:100px; text-align:center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @foreach($latestBooking as $booking)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ \App\Room::where('id',$booking->room_id)->first()->name }}</td>
                    <td>{{ $booking->start_date->format('j F Y, g:i a') }}</td>
                    <td>{{ $booking->end_date->format('j F Y, g:i a') }}</td>
                    <td style="text-align:center">
                      {{ $booking->duration }}
                    </td>
                    <td>
                      <button class="btn btn-xs btn-danger" 
                        data-name="{{ \App\Room::where('id',$booking->room_id)->first()->name }}"
                        data-remote="{{ url('/dashboard/booking/' . $booking->id) }}"
                        data-method="DELETE"
                      ><i class="glyphicon glyphicon-trash"></i> Cancel this?</button>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              @else

              <h2>No booking yet!</h2>

              @endif
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section><!-- /.content -->
    @endif
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')

</div>
<!-- ./wrapper -->
@endsection

@section('js')
<script src="{{ url('/') }}/plugins/daterangepicker/moment.min.js"></script>
<script src="{{ url('/') }}/plugins/daterangepicker/daterangepicker.js"></script>
<script>
$(function() {
    
    $('#loading').hide(); // hide spinner

    // Date range picker with time picker
    $('#reservationTime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 15,
        timePicker24Hour: true,
        minDate: moment().format('DD/MM/YYYY HH'),
        opens: 'right',
        locale: {
            format: 'DD/MM/YYYY HH:mm:ss'
        }
    });

    // Ajax search form
    $('#search').submit(function(e) { // catch the form's submit event
      
      e.preventDefault(); // prevent form submitting
      
      $('#result').html(''); // reset resut div
      $('#loading').show(); // show spinner

      $.ajax({ // create an AJAX call...
        global: true,
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: $(this).attr('action'), // the file to call
        success: function(data) { // on success..
          $("#loading").hide(); // hide spinner
          $('#result').html(data); // update the DIV
        },
        error: function(data) {
          $('#loading').hide(); // hide spinner
          
          errorsHtml = '<div class="col-md-12"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-exclamation-circle"></i> Error!</h4><ol>';

          $.each(data.responseJSON, function(key, value) {
            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
          });
          
          errorsHtml += '</ol></div></div>';

          $('#result').html(errorsHtml); // update the DIV
        } // end error

      }); // end ajax

    }); // end search submit

     $('#booking-table').on('click', 'button', function(e) {
      e.preventDefault();

      var button = $(this);
      var url = $(this).data('remote');
      var roomName = $(this).data('name');
      var token = $('meta[name="csrf-token"]').attr('content');

      if(confirm('Are you sure to cancel ' + roomName + '?'))
      {
        $.ajax({
          url: url,
          type: 'POST',
          data: {'_token' : token, '_method' : 'DELETE'},
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