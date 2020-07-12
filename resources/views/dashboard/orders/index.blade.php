@extends('layouts.dashboard.app')
@push('styles')
    <style>
        .loading{
            display:none;
            flex-direction: column;
            align-items:center;
            justinfy-content:center;
        }
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid #00a9ff;
            border-color: #00a9ff transparent #00a9ff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h2>
            @lang('site.orders') <span class="badge">{{ $orders->total() }}</span>
        </h2>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li class="active">@lang('site.orders')</li>
        </ol>
    </section><!-- ./content-header -->

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-bottom:20px">@lang('site.orders')</h3>
                        {{-- Search form --}}
                        <form action="{{ route('dashboard.orders.index') }}" method="get">
                            <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="@lang('site.search')">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa fa-search"></i> @lang('site.search')
                                        </button>
                                    </div>
                                </div>
                        </form><!-- ./search form -->
                    </div><!-- ./box-header -->
                    <div class="box-body">
                        @if ($orders->count()>0)
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.status')</th>
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.products')</th>
                                        <th>@lang('site.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $index=>$order)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{ number_format($order->total_price,2) }}</td>
                                            <td>
                                                @if ($order->is_printed == 1)
                                                    @lang('site.printed')
                                                @else
                                                    @lang('site.no_printed')
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-info btn-sm order-products"
                                                    data-url="{{ route('dashboard.orders.products',$order->id) }}"
                                                    data-method="get"
                                                    >
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>
                                            </td>
                                            <td>
                                                @if ($order->is_printed == 0)
                                                    @if (auth()->user()->hasPermission('update_orders'))
                                                        <a href="{{ route('dashboard.clients.orders.edit',[$order->client->id,$order->id]) }}" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-edit"></i> @lang('site.edit')
                                                        </a>
                                                    @else
                                                        <a href="javascript:;" class="btn btn-default btn-sm disabled">
                                                            <i class="fa fa-pencil"></i> @lang('site.edit')
                                                        </a>
                                                    @endif
                                                    @if (auth()->user()->hasPermission('delete_orders'))
                                                        <form action="{{ route('dashboard.orders.destroy',$order->id) }}" style="display:inline-block" method="post">                                            @csrf
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm delete">
                                                                <i class="fa fa-trash"></i> @lang('site.delete')
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="submit" class="btn btn-danger btn-sm disabled">
                                                            <i class="fa fa-trash"></i> @lang('site.delete')
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- ./table -->

                            {{-- Pagination --}}
                            {{ $orders->appends(request()->query())->links() }}
                        @else
                            <h2 class="text-center">@lang('site.no_data_found')</h2>
                        @endif
                    </div><!-- ./box-body -->
                </div>
            </div>
            {{-- Products --}}
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('site.show_products')</h3>
                    </div>
                    <div class="box-body">
                        {{-- loading --}}
                        <div class="loading">
                            <div class="lds-dual-ring"></div>
                        </div><!-- ./loading -->
                        <div class="order-products-list">
                        </div><!-- ./order products list-->
                    </div><!-- ./box-body -->
                    <!-- /.box-header -->
                </div><!-- /.box -->
            </div>
        </div><!-- ./row -->
    </section><!-- ./content -->

</div><!-- ./content wrapper -->

@endsection
