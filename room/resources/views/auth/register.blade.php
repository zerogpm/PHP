@extends('layouts.backend')

@section('css')
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/iCheck/square/blue.css">
@endsection

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="{{ url('/') }}"><b>LARAVEL</b> Room Booking</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership
    @if(session('status'))
    <br>{{ session('status') }}
    @endif
    </p>

    <form role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
      <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="name" placeholder="Full name" value="{{ old('name') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck{{ $errors->has('terms') ? ' has-error' : '' }}">
            <label>
              <input type="checkbox" name="terms"> I agree to the <a href="http://blog.pisyek.com/disclaimer/">terms</a>
            </label>
            @if ($errors->has('terms'))
            <span class="help-block">
                <strong>{{ $errors->first('terms') }}</strong>
            </span>
        @endif
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection

@section('js')
<!-- iCheck -->
<script src="./plugins/iCheck/icheck.min.js"></script>
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