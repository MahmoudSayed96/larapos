@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.clients')
            </h2>

            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-clients"></i> @lang('site.clients')</a></li>
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
                    <form action="{{ route('dashboard.clients.store') }}" method="post">
                        @csrf
                        @method('post')
                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        {{-- Phone --}}
                        @for ($i = 0; $i < 2; $i++)
                        <div class="form-group">
                                <label>@lang('site.phone')</label>
                                <input type="text" name="phone[]" class="form-control">
                            </div>
                        @endfor

                        {{-- Address --}}
                        <div class="form-group">
                            <label for="address">@lang('site.address')</label>
                            <textarea name="address" id="address" class="form-control ckeditor" required>{{ old('address') }}</textarea>
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
