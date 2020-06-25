@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.products') <span class="badge">{{ $products->total() }}</span>
            </h2>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.show_products')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom:20px">@lang('site.products')</h3>
                    {{-- Search form --}}
                    <form action="{{ route('dashboard.products.list') }}" method="get">
                        <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="@lang('site.search')">
                                </div>
                                <div class="col-md-4">
                                    {{-- Search by category --}}
                                    <div class="form-group">
                                        <select class="form-control" id="search_by" name="category_id">
                                            <option value="">@lang('site.all_categories')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id==request()->category_id ? 'selected':''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>{{-- ./form group --}}
                                </div> {{-- ./end col --}}
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i> @lang('site.search')
                                    </button>
                                </div>
                            </div>
                    </form><!-- ./search form -->

                </div><!-- ./box-header -->
                <div class="box-body">
                    @if ($products->count() > 0)
                        @foreach ($products->chunk(4) as $productsArray)
                            <div class="row">
                                @foreach ($productsArray as $product)
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="image-box" style="max-height: 300px">
                                                    <img src="{{ $product->image_path }}" class="img-responsive" alt="{{ $product->name }}">
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
                                                        <strong>@lang('site.description'): </strong> <span style="">{!! $product->description !!}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        {{-- Pagination --}}
                        {{ $products->appends(request()->query())->links() }}
                    @else
                    <h2 class="text-center">@lang('site.no_data_found')</h2>
                    @endif
                </div>
            </div>
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#search_by').on('change',function(){
                var categoryId=$(this).val();
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
