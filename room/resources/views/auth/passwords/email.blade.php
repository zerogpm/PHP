@extends('layouts.backend')

@section('css')
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/iCheck/square/blue.css">
@endsection

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>LARAVEL</b> Room Booking</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset Password
    @if(session('status'))
    <br><span class="text-success"><i class="glyphicon glyphicon-ok-circle"></i> {{ session('status') }}</span> 
    @endif
    </p>

    <form role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}

      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <a href="{{ url('/login') }}">I remember my password</a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

@section('js')
<!-- iCheck -->
<script src="{{ url('/') }}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@endsection