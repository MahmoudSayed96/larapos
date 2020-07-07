@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.edit_order')
            </h2>

            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-clients"></i> @lang('site.clients')</a></li>
                <li><a href="{{ route('dashboard.clients.orders.index',$client->id) }}"><i class="fa fa-clients"></i> @lang('site.orders')</a></li>
                <li class="active">@lang('site.edit_order')</li>
            </ol>
        </section>

        <!-- main content-->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    {{-- Catgories --}}
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('site.categories')</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                @if ($categories->count() > 0)
                                    @foreach ($categories as $category)
                                        <div class="panel-group">

                                            <div class="panel panel-info">

                                                <div class="panel-heading">
                                                    <h2 class="panel-title">
                                                        <a data-toggle="collapse" href="#{{ str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
                                                    </h2><!-- /.panel-title -->
                                                </div><!-- /.panel-heading -->

                                                <div id="{{ str_replace(' ','_',$category->name) }}" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        @if ($category->products()->count() > 0)
                                                        <table class="table table-hover table-bordered">
                                                                <tr>
                                                                    <th>@lang('site.name')</th>
                                                                    <th>@lang('site.stock')</th>
                                                                    <th>@lang('site.price')</th>
                                                                    <th>@lang('site.add')</th>
                                                                </tr>
                                                                @foreach ($category->products as $product)
                                                                    <tr>
                                                                        <td>{{ $product->name }}</td>
                                                                        <td>{{ $product->stock }}</td>
                                                                        <td>{{ number_format($product->sale_price ,2) }}</td>
                                                                        <td>
                                                                            <a href=""
                                                                                id="product_{{ $product->id }}"
                                                                                data-id="{{ $product->id }}"
                                                                                data-name="{{ $product->name }}"
                                                                                data-price="{{ $product->sale_price }}"
                                                                                class="btn {{ in_array($product->id,$order->products->pluck('id')->toArray())? 'btn-default disabled':'btn-success' }} btn-sm add-product-btn"
                                                                            >
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
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
                                @else
                                    <h2>@lang('site.no_data_found')</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Edit Order --}}
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('site.orders')</h3>
                            </div>
                            <!-- /.box-header -->
                            <form action="{{ route('dashboard.clients.orders.update',['client'=>$client->id,'order'=>$order->id]) }}" method="post">
                                @csrf
                                @method('put')
                                @include('partials._errors')
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="order-list">
                                        @foreach ($order->products as $product)
                                        <tr id="row_{{$product->id}}">
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    <input type="number" name="products[{{$product->id}}][quantity]" data-price="{{ number_format($product->sale_price,2) }}" class="form-control input-sm product-quantity"  min="1" max="{{ $product->stock }}" value="{{ $product->pivot->quantity }}">
                                                    <small style="display:block"></small>
                                                </td>
                                                <td class="product-price">{{number_format($product->sale_price * $product->pivot->quantity,2) }}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm remove-product-btn" data-id="{{ $product->id }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- ./tabel-->
                                <h3>
                                    @lang('site.total'):<stron class="total-price">{{ $order->total_price }}</stron>
                                </h3>
                                <button type="submit" id="add_order_form_btn" class="btn btn-primary btn-block">
                                    <i class="fa fa-edit fa-lg"></i> @lang('site.edit_order')
                                </button>
                            </form><!-- ./form -->
                        </div><!-- /.box -->
                        {{-- Previous orers --}}
                        <div class="box box-primary">
                            @if ($client->orders()->count() > 0)
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">
                                            @lang('site.previous_orders')
                                            <small class="badge">{{ $orders->total() }}</small>
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
                                                                </tr>
                                                                @foreach ($order->products as $product)
                                                                    <tr>
                                                                        <td>{{ $product->name }}</td>
                                                                        <td>{{ $product->pivot->quantity }}</td>
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
                                @else
                                    <h2>@lang('site.no_data_found')</h2>
                                @endif
                                </div>
                            </div>
                        </div><!-- ./privous orders-->
                    </div>
                </div><!-- ./box-body -->
            </div><!-- ./box -->
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
