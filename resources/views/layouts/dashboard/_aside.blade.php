<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i><span>@lang('site.dashboard')</span></a></li>
            {{-- Categories --}}
            @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-area-chart"></i><span>@lang('site.categories')</span></a></li>
            @endif

            {{-- Products --}}
            @if (auth()->user()->hasPermission('read_products'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-shopping-basket"></i><span>@lang('site.products')</span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('dashboard.products.list') }}"><i class="fa fa-list"></i><span>@lang('site.show_products')</span></a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.products.index') }}"><i class="fa fa-th"></i><span>@lang('site.add_product')</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Clients --}}
            @if (auth()->user()->hasPermission('read_clients'))
            <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-user"></i><span>@lang('site.clients')</span></a></li>
            @endif

            {{-- Orders --}}
            @if (auth()->user()->hasPermission('read_orders'))
            <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-shopping-cart"></i><span>@lang('site.orders')</span></a></li>
            @endif

            {{-- Users --}}
            @if (auth()->user()->hasPermission('read_users'))
            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif

            {{-- Stocks --}}
            @if (auth()->user()->hasPermission('read_stock'))
                <li><a href="{{ route('dashboard.stock.index') }}"><i class="fa fa-shopping-bag "></i><span>@lang('site.stock')</span></a></li>
            @endif

            {{-- Reports --}}
            @if (auth()->user()->hasPermission('read_sales'))
                <li><a href="{{ route('dashboard.reports.sales') }}"><i class="fa fa-file"></i><span>@lang('site.sales')</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
