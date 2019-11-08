@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.users')
            </h2>

            <ol class="breadcrumb">
                <li class="active">
                    <a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i> @lang('site.users')</a></li>
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
                    <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        {{-- First Name --}}
                        <div class="form-group">
                            <label for="first_name">@lang('site.first_name')</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        {{-- Last Name --}}
                        <div class="form-group">
                            <label for="last_name">@lang('site.last_name')</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">@lang('site.email')</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        {{-- Image --}}
                        <div class="form-group">
                            <label for="image">@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image">
                        </div>
                        {{-- Show default user Image --}}
                        <div class="form-group">
                            <img src="{{ asset('uploads/images/users/default.png') }}" style="width:100px;" class="img-thumbnail img-preview" alt="default">
                        </div>
                        {{-- Password --}}
                        <div class="form-group">
                            <label for="password">@lang('site.password')</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        {{-- Password Confirmation --}}
                        <div class="form-group">
                            <label for="password_confirmation">@lang('site.password_confirmation')</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>

                        {{-- Permissions --}}
                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">

                                @php
                                    $models=['users','categories','products'];
                                    $maps=['create','read','update','delete'];
                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                    <li class="{{ $index==0 ? 'active': '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.'.$model)</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($models as $index=>$model)
                                        <div class="tab-pane {{ $index==0 ? 'active': '' }}" id="{{ $model }}">
                                            @foreach ($maps as $map)
                                            <label for="{{ $map.'_'. $model }}"><input type="checkbox" name="permissions[]" id="{{ $map.'_'. $model }}" value="{{ $map.'_'. $model }}"> @lang('site.'.$map)</label>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
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
