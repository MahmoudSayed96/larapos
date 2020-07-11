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
                    <div class="col-sm-12 col-md-12" style="margin-bottom: 10px;">
                        {{-- Edit Order --}}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('site.orders')</h3>
                            </div>
                            <h2>@lang('site.bill')</h2>
                            <!-- Client-info -->
                            <div class="client-info">
                                <ul class="list-unstyled">
                                    <li>@lang('site.date'): <strong dir="ltr">{{$order->created_at->toDateTimeString()}}</strong></li>
                                    <li>@lang('site.client_name'): <strong>{{$order->client->name}}</strong></li>
                                    <li>@lang('site.bill_no'): <strong>{{$order->id}}</strong></li>
                                </ul>
                            </div>
                            <!-- ./Client-info -->
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
                    </div>
                    {{-- Catgories --}}
                    <div class="col-sm-12 col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('site.products')</h3>
                                @include('dashboard.includes._search',[
                                    'route'=>'dashboard.clients.orders.edit',
                                    'route_params' => ['client'=>$client->id,'order'=>$order->id],
                                    'permission'=>'edit_orders',
                                    'add_btn' => false
                                    ])
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                @if ($products->count() > 0)
                                    @foreach ($products->chunk(4) as $productsArray)
                                        <div class="row">
                                            @foreach ($productsArray as $product)
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="image-box" style="max-height: 300px">
                                                                <img src="{{ $product->image_path }}" style="min-height:300px;width:100%" class="img-responsive" alt="{{ $product->name }}">
                                                            </div>
                                                            <hr>
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>@lang('site.category'): </strong> <span style="">{{ $product->category->name }}</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>@lang('site.product'): </strong> <span style="">{{ $product->name }}</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>@lang('site.price'): </strong> <span style="">{{ $product->sale_price }}</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>@lang('site.price'): <span class="selected-price"></span></strong>
                                                                    <select class="select-price form-control">
                                                                        <option>@lang('site.select_price')</option>
                                                                        <option value="{{ $product->sale_price }}" data-product="{{ $product->id }}" data-sale="normal" data-url="{{ route('dashboard.products.sale_type',$product->id) }}">@lang('site.sale_price')</option>
                                                                        <option value="{{ $product->collect_price }}" data-product="{{ $product->id }}" data-sale="collect" data-url="{{ route('dashboard.products.sale_type',$product->id) }}">@lang('site.collect_price')</option>
                                                                    </select>
                                                                </li>
                                                            </ul>
                                                            @if($product->stock > 0)
                                                            <a href=""
                                                                id="product_{{ $product->id }}"
                                                                data-id="{{ $product->id }}"
                                                                data-name="{{ $product->name }}"
                                                                data-price="{{ $product->sale_price }}"
                                                                class="btn {{ in_array($product->id,$order->products->pluck('id')->toArray())? 'btn-default disabled':'btn-success' }} btn-sm add-product-btn"
                                                            >
                                                                <i class="fa fa-plus"></i> @lang('site.add_to_bill')
                                                            </a>
                                                            @else
                                                                <button class="btn btn-danger btn-block">@lang('site.no_quantity')</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <div class="text-center">
                                        {{-- Pagination --}}
                                        {{ $products->appends(request()->query())->links() }}
                                    </div>
                                @else
                                    <h2 class="text-center">@lang('site.no_data_found')</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- ./box-body -->
            </div><!-- ./box -->
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection

@push('scripts')
    <script>
        // Datatables
        $(function () {
            $(".products-table").DataTable();
        });
    </script>
@endpush
