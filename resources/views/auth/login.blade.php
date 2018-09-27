@extends('layouts.app')

@section('content')
<style>
.container {
                position: absolute;
                top: 10%;
                bottom: 25%;
                left: 15%;
                right: 0;
                
                justify-content: space-around;
                align-items: center;
                flex-wrap: wrap;
            }
</style>
<div id="login">
        <div class="container" >
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form method="POST" action="{{ route('login') }}" id="login-form" class="form" method="post">
                            @csrf                        
                            <div style="text-align: center; margin-top:10%;"><h1><u>LOGIN<u></h1></div>
                            <div class="form-group">
                                <label for="email" class="text-info">{{ __('email:') }}</label><br>                                
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">{{ __('Password:') }}</label><br>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                   <div style="text-align: center;"><input class="form-check-input" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div style="text-align: center;"><button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button></div>
                                </div>

                            </div>

                            <div class="form-group row mb-0">

                                <div class="col-md-8 offset-md-2">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a> 
                                    /
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
