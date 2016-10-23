        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Available room for booking ({{ count($rooms) }})</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(count($rooms) > 0)
                <table class="table table-bordered" id="room-table">
                  <thead>
                    <tr>
                      <th style="width: 100px">#</th>
                      <th>Room Name</th>
                      <th class="text-center" style="width: 150px;">Capacity (Pax)</th>
                      <th class="text-center" style="width: 100px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @foreach($rooms as $room)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $room->name }}</td>
                    <td class="text-center">{{ $room->pax }}</td>
                    <td class="text-center">
                      <button class="btn btn-xs btn-primary" 
                      data-id="{{ $room->id }}" 
                      data-name="{{ $room->name }}" 
                      data-remote="{{ url('/dashboard/booking') }}" 
                      data-date="{{ $reservationTime }}">Book</button>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              @else

              <h2>No available room!</h2>

              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

<script>
$(function() {
  $('#room-table').on('click', '.btn-primary[data-remote]', function(e) {
    e.preventDefault();

    var button = $(this);
    var url = $(this).data('remote');
    var roomName = $(this).data('name');
    var token = $('meta[name="csrf-token"]').attr('content');
    var roomId = $(this).data('id');
    var date = $(this).data('date');

    if(confirm('Are you sure to book ' + roomName + '?'))
    {
      $.ajax({
        url: url,
        type: 'POST',
        data: {'_token' : token, 'room': roomId, 'reservationTime': date},
        success: function (data) {
          button.text('Booked');
          button.removeClass('btn-primary').addClass('btn-success');
        },
        error: function(data) {
          alert(data.responseText);
        }
      });
    }
  }); // end onclick
});
</script>