@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h2>
                @lang('site.sales')
            </h2>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.sales')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom:20px">@lang('site.sales')</h3>

                </div><!-- ./box-header -->
                <div class="box-body">
                    <div class="box-body">
                        <div id="products_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="sales" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="products_info">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="products" rowspan="1" colspan="1" aria-sort="ascending" aria-label="@lang('site.date'): activate to sort column descending" style="width: 176px;">@lang('site.date')</th>
                                                <th class="sorting" tabindex="0" aria-controls="products" rowspan="1" colspan="1" aria-label="@lang('site.product'): activate to sort column ascending" style="width: 223px;">@lang('site.product')</th>
                                                <th class="sorting" tabindex="0" aria-controls="products" rowspan="1" colspan="1" aria-label="@lang('site.sales_quantity'): activate to sort column ascending" style="width: 152px;">@lang('site.sales_quantity')</th>
                                                <th class="sorting" tabindex="0" aria-controls="products" rowspan="1" colspan="1" aria-label="@lang('site.price'): activate to sort column ascending" style="width: 205px;">@lang('site.price')</th>
                                                <th class="sorting" tabindex="0" aria-controls="products" rowspan="1" colspan="1" aria-label="@lang('site.profit'): activate to sort column ascending" style="width: 152px;">@lang('site.profit')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($orders) && $orders->count() > 0)
                                                @foreach ($orders as $order)
                                                    @foreach ($order->products as $index => $product)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>Date</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->pivot->quantity }}</td>
                                                            <td>{{ number_format($product->sale_price * $product->pivot->quantity,2) }}</td>
                                                            <td>{{ number_format($product->profit,2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <h2 class="text-center">@lang('site.no_data_found')</h2>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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
            $("#sales").DataTable();
        });
    </script>
@endpush
