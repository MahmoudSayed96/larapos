@extends('layouts.dashboard.app')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h2>
                @lang('site.dashboard')
            </h2>

            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> @lang('site.dashboard')
                </li>
            </ol>
        </section>

        <section class="content">
            <h1>This is Dashboard</h1>
        </section><!-- ./content -->

    </div><!-- ./content wrapper -->

@endsection
