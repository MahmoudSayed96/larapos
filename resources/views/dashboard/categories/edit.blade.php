@extends('layouts.dashboard.app')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h2>
            @lang('site.categories')
        </h2>

        <ol class="breadcrumb">
            <li class="active">
                <a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-categories"></i> @lang('site.categories')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <!-- main content-->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- /.box-header -->

            <div class="box-body">

                @include('partials._errors')

                <!-- Form -->
                <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post">
                    @csrf
                    @method('put')

                    {{-- Name --}}
                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="{{ $locale }}_name">@lang('site.'.$locale.'.name')</label>
                            <input type="text" class="form-control" id="{{ $locale }}_name" name="{{ $locale }}[name]" value="{{ $category->translate($locale)->name }}" required>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-edit"></i> @lang('site.edit')
                        </button>
                    </div>
                </form><!-- ./Form -->
            </div><!-- ./box-body -->
        </div><!-- ./box -->
    </section><!-- ./content -->

</div><!-- ./content wrapper -->

@endsection
