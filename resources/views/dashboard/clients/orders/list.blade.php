@extends('layouts.dashboard.app')
@section('titile', __('site.orders'))
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <h2>
            @lang('site.orders') <span class="badge">{{ $orders->count() }}</span>
        </h2>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-users"></i>@lang('site.clients')</a></li>
            <li class="active">@lang('site.orders')</li>
        </ol>
    </section>
    <section class="content">
        {{-- Previous orers --}}
        <div class="box box-primary">
            @if ($client->orders()->count() > 0)
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            @lang('site.previous_orders')
                            <small class="badge">{{ $orders->count() }}</small>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @foreach ($orders as $order)
                            <div class="panel-group">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h2 class="panel-title">
                                            <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                        </h2><!-- /.panel-title -->
                                    </div><!-- /.panel-heading -->
                                    <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @if ($order->products()->count() > 0)
                                                <table class="table">
                                                    <tr>
                                                        <th>@lang('site.product')</th>
                                                        <th>@lang('site.quantity')</th>
                                                        <th>@lang('site.price')</th>
                                                        <th>@lang('site.sale_type')</th>
                                                    </tr>
                                                    @foreach ($order->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                        <td>{{ number_format($product->getPriceByQuantity($product->pivot->quantity),2) }}</td>
                                                        <td>{{ $product->sale_type == 'normal' ? __('site.normal_price') : __('site.collect_price') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            @else
                                                <h2>@lang('site.no_data_found')</h2>
                                            @endif
                                        </div>
                                    </div><!-- /.penal-collapse -->
                                </div><!-- /.panel-info -->
                            </div><!-- /.panel-group -->
                        @endforeach
                    </div>
                </div>
                @else
                <h2>@lang('site.no_data_found')</h2>
            @endif
        </div><!-- ./privous orders-->
    </section>
</div>
@endsection
