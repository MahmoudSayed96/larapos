@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.categories') <span class="badge">{{ $categories->total() }}</span>
            </h2>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.categories')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom:20px">@lang('site.categories')</h3>
                    {{-- Search form --}}
                    <form action="{{ route('dashboard.categories.index') }}" method="get">
                        <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" value="{{ request()->search }}" placeholder="@lang('site.search')">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i> @lang('site.search')
                                    </button>
                                    @if (auth()->user()->hasPermission('create_categories'))
                                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success">
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
                    @if ($categories->count()>0)
                    <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.products_count')</th>
                                    <th>@lang('site.related_products')</th>
                                    <th>@lang('site.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index=>$category)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <span class="badge">{{ $category->products()->count() }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.products.index',['category_id'=>$category->id])}}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i> @lang('site.read')
                                            </a>
                                        </td>
                                        <td>
                                            @if (auth()->user()->hasPermission('update_categories'))
                                                <a href="{{ route('dashboard.categories.edit',$category->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> @lang('site.edit')
                                                </a>
                                            @else
                                                <a href="javascript:;" class="btn btn-default btn-sm disabled">
                                                    <i class="fa fa-pencil"></i> @lang('site.edit')
                                                </a>
                                            @endif
                                            @if (auth()->user()->hasPermission('delete_categories'))
                                                <form action="{{ route('dashboard.categories.destroy',$category->id) }}" style="display:inline-block" method="post">                                            @csrf
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
                        {{ $categories->appends(request()->query())->links() }}
                    @else
                        <h2 class="text-center">@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- ./box-body -->
            </div><!-- ./box -->
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
