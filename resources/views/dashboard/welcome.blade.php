@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.dashboard')
            </h2>

            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> @lang('site.dashboard')
                </li>
            </ol>
        </section>
        {{-- Dashboard Statistics --}}
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- Orders -->
                    @if (auth()->user()->hasPermission('read_orders'))
                        <div class="small-box bg-aqua">
                            <div class="inner">
                            <h3>{{ $orders_count }}</h3>
                            <p>@lang('site.orders')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="{{ route('dashboard.orders.index') }}" class="small-box-footer">@lang('site.show') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    @endif
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- Products -->
                    @if (auth()->user()->hasPermission('read_products'))
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $products_count}}</h3>
                                <p>@lang('site.products')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-basket"></i>
                            </div>
                            <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.show') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    @endif
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    {{-- Categories --}}
                    @if (auth()->user()->hasPermission('read_categories'))
                        <div class="small-box bg-yellow">
                            <div class="inner">
                            <h3>{{ $categories_count }}</h3>
                            <p>@lang('site.categories')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.show') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    @endif
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- Users -->
                    @if (auth()->user()->hasPermission('read_users'))
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ $users_count }}</h3>
                                <p>@lang('site.users')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.show') <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    @endif
                </div>
                <!-- ./col -->
            </div>
        </section><!-- ./content -->
    </div><!-- ./content wrapper -->

@endsection
