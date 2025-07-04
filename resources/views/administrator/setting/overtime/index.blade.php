@extends('administrator.master')
@section('title', __('Overtime Details'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('Overtime Details') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('HRM') }}</a></li>
            <li><a href="{{ url('/hrm/overtime') }}">{{ __('Overtime') }}</a></li>
            <li class="active">{{ __('Details') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Details of Overtime') }}</h3>
            </div>
            <div class="box-body">
                <a href="{{ url('/setting/overtime') }}" class="btn btn-primary btn-flat">
                    <i class="fa fa-arrow-left"></i> {{ __('Back') }}
                </a>
                <hr>
                <table id="example1" id="example1" class="table table-bordered table-striped">
                    <tbody id="myTable">
                        @if(isset($overtimes) && !empty($overtimes))
                            @foreach($overtimes as $overtime)
                            <tr>
                                <td>{{ __('Code') }}</td>
                                <td>{{ $overtime->code }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Name') }}</td>
                                <td>{{ $overtime->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Fixed Amount') }}</td>
                                <td>{{ $overtime->fixed_amount }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Date Added') }}</td>
                                <td>{{ date("D d F Y h:ia", strtotime($overtime->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Last Updated') }}</td>
                                <td>{{ date("D d F Y h:ia", strtotime($overtime->updated_at)) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Publication Status') }}</td>
                                <td>
                                    @if ($overtime->status == 1)
                                        <a href="{{ url('/setting/overtime/unpublished/' . $overtime->id) }}" class="btn btn-success btn-flat">
                                            <i class="fa fa-arrow-down"></i> {{ __('Published') }}
                                        </a>
                                    @else
                                        <a href="{{ url('/setting/overtime/published/' . $overtime->id) }}" class="btn btn-warning btn-flat">
                                            <i class="fa fa-arrow-up"></i> {{ __('Unpublished') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"> There is no data available! </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
