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
                <form action="{{ route('dashboard.users.update',$user->id) }}" method="post">
                    @csrf
                    @method('put')

                    {{-- First Name --}}
                    <div class="form-group">
                        <label for="first_name">@lang('site.first_name')</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                    </div>
                    {{-- Last Name --}}
                    <div class="form-group">
                        <label for="last_name">@lang('site.last_name')</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                    </div>
                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">@lang('site.email')</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
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
                                        <label for="{{ $map.'_'. $model }}"><input type="checkbox" name="permissions[]" id="{{ $map.'_'. $model }}" {{ $user->hasPermission($map.'_'. $model)? 'checked':'' }} value="{{ $map.'_'. $model }}"> @lang('site.'.$map)</label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div>

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