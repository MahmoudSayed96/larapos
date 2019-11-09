<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("dashboard/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasPermission('read_users'))
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-users"></i><span>@lang('site.categories')</span></a></li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
