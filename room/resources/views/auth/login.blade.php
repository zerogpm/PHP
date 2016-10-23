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
    <p class="login-box-msg">Login to start your session
    @if(session('status'))
    <br><span class="text-success"><i class="glyphicon glyphicon-ok-circle"></i> {{ session('status') }}</span> 
    @endif
    </p>

    <form role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
    <a href="{{ url('/register') }}" class="text-center">Register a new account</a>

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