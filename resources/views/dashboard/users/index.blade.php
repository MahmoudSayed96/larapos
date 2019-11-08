@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.users')
            </h2>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.users')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom:20px">@lang('site.users')</h3>
                    {{-- Search form --}}
                    <form action="{{ route('dashboard.users.index') }}" method="get">
                        <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" placeholder="@lang('site.search')">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i> @lang('site.search')
                                    </button>
                                    @if (auth()->user()->hasPermission('create_users'))
                                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">
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
                    @if ($users->count()>0)
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.first_name')</th>
                                    <th>@lang('site.last_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index=>$user)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('update_users'))
                                                <a href="{{ route('dashboard.users.edit',$user->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i> @lang('site.edit')
                                                </a>
                                            @else
                                                <a href="javascript:;" class="btn btn-default btn-sm disabled">
                                                    <i class="fa fa-pencil"></i> @lang('site.edit')
                                                </a>
                                            @endif
                                            @if (auth()->user()->hasPermission('delete_users'))
                                                <form action="{{ route('dashboard.users.destroy',$user->id) }}" style="display:inline-block" method="post">                                            @csrf
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">
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
                    @else
                        <h2 class="text-center">@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- ./box-body -->
            </div><!-- ./box -->
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
