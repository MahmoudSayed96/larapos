{{-- Search form --}}
<form action="{{ route($route,$route_params) }}" method="get">
    <div class="row">
            <div class="col-md-4">
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
            <div class="col-md-4">
                <button type="submit" class="btn btn-info">
                    <i class="fa fa-search"></i> @lang('site.search')
                </button>
                @if ($add_btn)
                    @if (auth()->user()->hasPermission($permission))
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> @lang('site.add')
                    </a>
                    @else
                        <a href="javascript:;" class="btn btn-success disabled">
                            <i class="fa fa-plus"></i> @lang('site.add')
                        </a>
                    @endif
                @endif
            </div>
        </div>
</form><!-- ./search form -->
