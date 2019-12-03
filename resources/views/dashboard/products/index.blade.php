@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.products') <span class="badge">{{ $products->total() }}</span>
            </h2>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom:20px">@lang('site.products')</h3>
                    {{-- Search form --}}
                    <form action="{{ route('dashboard.products.index') }}" method="get">
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
                                    @if (auth()->user()->hasPermission('create_products'))
                                        <a href="{{ route('dashboard.products.create') }}" class="btn btn-success">
                                            <i class="fa fa-plus"></i> @lang('site.add')
                                        </a>
                                    @else
                                        <a href="javascript:;" class="btn btn-success disabled">
                                            <i class="fa fa-plus"></i> @lang('site.add')
                                        </a>
                                    @endif
                                </div>
                            </div>
                    </form><!-- ./search form -->

                </div><!-- ./box-header -->
                <div class="box-body">
                    @if ($products->count()>0)
                    <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.description')</th>
                                    <th>@lang('site.category')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.purchase_price')</th>
                                    <th>@lang('site.sale_price')</th>
                                    <th>@lang('site.profit_percent') %</th>
                                    <th>@lang('site.stock')</th>
                                    <th>@lang('site.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index=>$product)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{!! $product->description !!}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <img src="{{ $product->image_path }}" class="img-thumbnail" width="50" height="50" alt="">
                                        </td>
                                        <td>{{ $product->purchase_price }}</td>
                                        <td>{{ $product->sale_price }}</td>
                                        <td>{{ $product->profit_percent }} %</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('update_products'))
                                                <a href="{{ route('dashboard.products.edit',$product->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i> @lang('site.edit')
                                                </a>
                                            @else
                                                <a href="javascript:;" class="btn btn-default btn-sm disabled">
                                                    <i class="fa fa-pencil"></i> @lang('site.edit')
                                                </a>
                                            @endif
                                            @if (auth()->user()->hasPermission('delete_products'))
                                                <form action="{{ route('dashboard.products.destroy',$product->id) }}" style="display:inline-block" method="post">                                            @csrf
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- ./table -->

                        {{-- Pagination --}}
                        {{ $products->appends(request()->query())->links() }}
                    @else
                        <h2 class="text-center">@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- ./box-body -->
            </div><!-- ./box -->
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
