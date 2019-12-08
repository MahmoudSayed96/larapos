@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.products')
            </h2>

            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-products"></i> @lang('site.products')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <!-- main content-->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    @include('partials._errors')
                    <!-- Form -->
                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        {{-- Categories --}}
                        <div class="form-group">
                            <div class="form-group">
                                <label for="all_categories">@lang('site.category_id')</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id==old('category_id') ? 'selected':''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Name --}}
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label for="{{ $locale }}[name]">@lang('site.'.$locale.'.name')</label>
                                <input type="text" class="form-control" id="{{ $locale }}[name]" name="{{ $locale }}[name]" value="{{ old($locale.'.name') }}" required>
                            </div>
                            {{-- Description --}}
                            <div class="form-group">
                                <label for="{{ $locale }}[description]">@lang('site.'.$locale.'.description')</label>
                                <textarea class="form-control ckeditor" id="{{ $locale }}[description]" name="{{ $locale }}[description]" required>{{ old($locale.'.description') }}</textarea>
                            </div>
                        @endforeach
                        {{-- Image --}}
                        <div class="form-group">
                            <label for="image">@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image">
                        </div>
                        {{-- Show default user Image --}}
                        <div class="form-group">
                            <img src="{{ asset('uploads/images/products/default.png') }}" style="width:100px;" class="img-thumbnail img-preview" alt="product image">
                        </div>
                        {{-- Puschase Price --}}
                        <div class="form-group">
                            <label for="purchase_price">@lang('site.purchase_price')</label>
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" class="form-control" placeholder="0.0" required>
                        </div>
                        {{-- Sale Price --}}
                        <div class="form-group">
                            <label for="sale_price">@lang('site.sale_price')</label>
                            <input type="number" step="0.01" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" class="form-control" placeholder="0.0" required>
                        </div>
                        {{-- Stock --}}
                        <div class="form-group">
                            <label for="stock">@lang('site.stock')</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> @lang('site.add')
                            </button>
                        </div>
                    </form><!-- ./Form -->
                </div><!-- ./box-body -->
            </div><!-- ./box -->
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
