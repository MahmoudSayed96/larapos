{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Blank Page</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        {{--<!-- Bootstrap 3.3.7 -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">

        @if (app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE-rtl.min.css') }}">
            <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">

            <style>
                body, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Cairo', sans-serif !important;
                }
            </style>
        @else
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
            <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE.min.css') }}">
        @endif

        <style>
            .mr-2{
                margin-right: 5px;
            }

            .loader {
                border: 5px solid #f3f3f3;
                border-radius: 50%;
                border-top: 5px solid #367FA9;
                width: 60px;
                height: 60px;
                -webkit-animation: spin 1s linear infinite; /* Safari */
                animation: spin 1s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                }
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }

        </style>
        {{--<!-- jQuery 3 -->--}}
        <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>

        {{--noty--}}
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
        <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>

        {{--morris--}}
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/morris/morris.css') }}">

        {{--<!-- iCheck -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck/all.css') }}">

        {{--<!-- sweetalert -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweetalert/sweetalert.css') }}">

        {{--html in  ie--}}
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="javascript:;"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    {{-- Email --}}
                    <div class="form-group has-feedback row">
                        <input type="email" class="form-control" name="email" placeholder="@lang('site.email')">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Password --}}
                    <div class="form-group has-feedback row">
                        <input type="password" class="form-control" name="password" placeholder="@lang('site.password')">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Remember Me --}}
                    <div class="form-group">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> @lang('site.remember_me')
                            </label>
                        </div>
                    </div>
                    {{-- Signin --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            <i class="fa fa-sign-in"></i> @lang('site.sign_in')
                        </button>
                    </div>
                </form> <!-- ./login form -->

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        {{--<!-- Bootstrap 3.3.7 -->--}}
        <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>

        {{--icheck--}}
        <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
                });
            });
        </script>
    </body>
</html>
