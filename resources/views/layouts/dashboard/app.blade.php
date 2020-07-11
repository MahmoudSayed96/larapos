<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{config('app.name')}} | @yield('title',__('site.dashboard'))</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--<!-- Bootstrap 3.3.7 -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">

        @if (app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
            <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">

            <style>
                body, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Cairo', sans-serif !important;
                }
            </style>
        @else
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
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
        <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

        {{--noty--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
        <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

        {{--morris--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">

        {{--<!-- iCheck -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">

        {{--<!-- datatables -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/datatables/dataTables.bootstrap.css') }}">

        {{--<!-- select2 -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/select2/select2.min.css') }}">

        {{--<!-- sweetalert -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/sweetalert/sweetalert.css') }}">

        {{--html in  ie--}}
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        {{-- Styles --}}
        @stack('styles')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard.welcome') }}" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{ config('app.name')}}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ auth()->user()->image_path }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
                                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                {{-- Logout form --}}
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-sign-out"></i> @lang('site.sign_out')
                                    </button>
                                </form>
                                {{-- ./Logout form --}}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    @include('layouts.dashboard._aside')

    @yield('content')

    @include('partials._session')

    <footer class="main-footer">
        <strong> &copy; <span id="year"></span>
            <a href="{{ route('dashboard.welcome') }}">{{ config('app.name') }}</a>.</strong> @lang('site.copyright')
    </footer>

    </div><!-- end of wrapper -->

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

    {{--icheck--}}
    <script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

    {{--<!-- FastClick -->--}}
    <script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

    {{--<!-- AdminLTE App -->--}}
    <script src="{{ asset('dashboard_files/js/adminlte.min.js') }}"></script>

    {{--ckeditor standard--}}
    <script src="{{ asset('dashboard_files/plugins/ckeditor/ckeditor.js') }}"></script>

    {{--jquery number--}}
    <script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>

    {{--print this--}}
    <script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>

    {{--morris --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('dashboard_files/plugins/morris/morris.min.js') }}"></script>

    {{-- Datatables --}}
    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('dashboard_files/plugins/datatables/jquery.dataTables-ar.js') }}"></script>
    @else
        <script src="{{ asset('dashboard_files/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    @endif
        <script src="{{ asset('dashboard_files/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('dashboard_files/plugins/select2/select2.full.min.js') }}"></script>

    {{-- sweetalert --}}
    <script src="{{ asset('dashboard_files/plugins/sweetalert/sweetalert.min.js') }}"></script>

    {{--custom js--}}
    <script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>
    <script src="{{ asset('dashboard_files/js/custom/order.js') }}"></script>
    <script src="{{ asset('dashboard_files/js/custom/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            // iCheck
            $(function () {
                $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
                });
            });//end of icheck

            // sweetalert delete btn
            $('.delete').click(function(e){
                e.preventDefault();

                var that = $(this);
                swal({
                        title: "@lang('site.are_you_sure')",
                        text: "@lang('site.confirm_delete')",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "@lang('site.yes')",
                        cancelButtonText: "@lang('site.cancel')",
                        closeOnConfirm: false
                    },
                    function(){
                        // yes button
                        // submite the nearest form
                        that.closest('form').submit();
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                });
            });// end of sweetalert

            // Ckeditor config
            CKEDITOR.config.language="{{ app()->getLocale() }}";

            //Initialize Select2 Elements
            $(".select2").select2();

            // Copyright year.
            $('#year').text(new Date().getFullYear());
        });//end of ready
    </script>

    @stack('scripts')
    </body>
</html>
