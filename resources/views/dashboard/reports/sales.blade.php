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
                    <h3 class="box-title" style="margin-bottom:20px">@lang('site.products')</h3>
                    {{-- Search form --}}
                    <form action="{{ route('dashboard.reports.sales') }}" method="get">
                        <div class="row">
                                <div class="col-md-4 hidden">
                                    <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="@lang('site.search')">
                                </div>
                                <div class="col-md-4">
                                    {{-- Search by category --}}
                                    <div class="form-group">
                                        <select class="form-control select2" id="search_by" name="category_id">
                                            <option value="">@lang('site.all_categories')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id==request()->category_id ? 'selected':''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>{{-- ./form group --}}
                                </div> {{-- ./end col --}}
                                <div class="col-md-4 hidden">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i> @lang('site.search')
                                    </button>
                                </div>
                            </div>
                    </form><!-- ./search form -->

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
                                                @php
                                                    $total_profit = 0;
                                                @endphp
                                                @foreach ($orders as $order)
                                                    @foreach ($order->products as $index => $product)
                                                        <tr>
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{ $order->created_at }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->pivot->quantity }}</td>
                                                            <td>{{ number_format($product->sale_price * $product->pivot->quantity,2) }}</td>
                                                            <td>{{ number_format($product->profit  * $product->pivot->quantity,2) }}</td>
                                                        </tr>
                                                        @php
                                                            $total_profit += ($product->profit  * $product->pivot->quantity);
                                                        @endphp
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <h2 class="text-center">@lang('site.no_data_found')</h2>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if (isset($orders) && $orders->count() > 0)
                                        <br>
                                        <div class="alert alert-success">
                                            <strong>@lang('site.total')</strong>
                                            <span>{{number_format($total_profit,2)}}</span>
                                        </div>
                                    @endif
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
            // Search category.
            $('#search_by').on('change',function(){
                var categoryId=$(this).val();
                $(this).closest('form').submit();
            });
            $("#sales").DataTable();
        });
    </script>
@endpush
