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
                {{-- <li><a href="{{ route('dashboard.clients.orders.index') }}"><i class="fa fa-clients"></i> @lang('site.clients')</a></li> --}}
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
                                <h3 class="box-title">@lang('site.orders')</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                @if ($order)
                                    @foreach ($orders as $category)
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
                                                                                class="btn btn-success btn-sm add-product-btn"
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
                    {{-- Create Order --}}
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('site.orders')</h3>
                            </div>
                            <!-- /.box-header -->
                            <form action="{{ route('dashboard.clients.orders.store',$client->id) }}" method="post">
                                @csrf
                                @method('post')
                                @include('partials._errors')
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@lang('site.product')</th>
                                            <th>@lang('site.quantity')</th>
                                            <th>@lang('site.price')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="order-list"></tbody>
                                </table><!-- ./tabel-->
                                <h3>
                                    @lang('site.total'):<stron class="total-price">0</stron>
                                </h3>
                                <button type="submit" id="add_order_form_btn" class="btn btn-primary btn-block disabled">
                                    <i class="fa fa-plus fa-lg"></i> @lang('site.edit_order')
                                </button>
                            </form><!-- ./form -->
                        </div><!-- /.box -->
                    </div>
                </div><!-- ./box-body -->
            </div><!-- ./box -->
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
