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
    <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                    <img src="{{ asset("dashboard/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                    Support Team
                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                                </li>
                                <!-- end message -->
                                <li>
                                <a href="#">
                                    <div class="pull-left">
                                    <img src="{{ asset("dashboard/img/user3-128x128.jpg") }}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                    AdminLTE Design Team
                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <div class="pull-left">
                                    <img src="{{ asset("dashboard/img/user4-128x128.jpg") }}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                    Developers
                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <div class="pull-left">
                                    <img src="{{ asset("dashboard/img/user3-128x128.jpg") }}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                    Sales Department
                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <div class="pull-left">
                                    <img src="{{ asset("dashboard/img/user4-128x128.jpg") }}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                    Reviewers
                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                    page and may cause design problems
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                </a>
                                </li>
                                <li>
                                <a href="#">
                                    <i class="fa fa-user text-red"></i> You changed your username
                                </a>
                                </li>
                            </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            {{-- <span class="label label-danger">9</span> --}}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul class="menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset("dashboard/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                            <img src="{{ asset("dashboard/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">

                            <p>
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                <small>Member since Nov. 2012</small>
                            </p>
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
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    @include('layouts.dashboard._aside')

    @yield('content')

    @include('partials._session')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016
            <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    </div><!-- end of wrapper -->

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>

    {{--icheck--}}
    <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>

    {{--<!-- FastClick -->--}}
    <script src="{{ asset('dashboard/js/fastclick.js') }}"></script>

    {{--<!-- AdminLTE App -->--}}
    <script src="{{ asset('dashboard/js/adminlte.min.js') }}"></script>

    {{--ckeditor standard--}}
    <script src="{{ asset('dashboard/plugins/ckeditor/ckeditor.js') }}"></script>

    {{--jquery number--}}
    <script src="{{ asset('dashboard/js/jquery.number.min.js') }}"></script>

    {{--print this--}}
    <script src="{{ asset('dashboard/js/printThis.js') }}"></script>

    {{--morris --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('dashboard/plugins/morris/morris.min.js') }}"></script>

    {{--custom js--}}
    <script src="{{ asset('dashboard/js/custom/image_preview.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom/order.js') }}"></script>

    {{-- sweetalert --}}
    <script src="{{ asset('dashboard/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>

        // iCheck
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
            });
        });

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
        });

        // image preview
        $(".image").change(function() {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>

    @stack('scripts')
    </body>
</html>
