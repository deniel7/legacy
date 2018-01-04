@extends('layouts.detail')
@section('content')
<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="col-xs-8">
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session.</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/user-login') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
                    <input type="username" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
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
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                        <a href="{{ url('/register') }}">Register</a>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
        </div>
        </div>
    </section>
    @stop