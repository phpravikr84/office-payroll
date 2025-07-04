@extends('administrator.master')
@section('title', __('Manage Deductiones'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('DEDUCTION') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __(' Dashboard') }} </a></li>
            <li><a>{{ __('Deduction') }}</a></li>
            <li class="active">{{ __('Manage Deductiones') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Deductiones') }}</h3>
            </div>
            <div class="box-body">
                
                <div class="col-md-6">
                    <a href="{{ url('/hrm/deductions/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ __('Add deduction') }}</a>
                </div>
                <div  class="col-md-6">
                    <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                </div>

                <!-- Notification Box -->
                <div class="col-md-12">
                    @if (!empty(Session::get('message')))
                    <div class="alert alert-success alert-dismissible" id="notification_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                    </div>
                    @elseif (!empty(Session::get('exception')))
                    <div class="alert alert-warning alert-dismissible" id="notification_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                    </div>
                    @endif
                </div>
                <!-- /.Notification Box -->
                <div class="col-md-12 table-responsive">
                    <table id="example1" id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL#') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Deduction Name') }}</th>
                                <th>{{ __('Deduction Month') }}</th>
                                <th>{{ __('Deduction Amount') }}</th>
                                <th>{{ __('Date Added') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php ($sl = 1)
                            @foreach($deductions as $deduction)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $deduction['name'] }}</td>
                                <td>{{ $deduction['designation'] }}</td>
                                <td>{{ $deduction['deduction_name'] }}</td>
                                <td>{{ date("F Y", strtotime($deduction['deduction_month'])) }}</td>
                                <td>{{ $deduction['deduction_amount'] }}</td>
                                <td>{{ date("d F Y", strtotime($deduction['created_at'])) }}</td>
                                <td class="text-center">
                                <a href="{{ url('/hrm/deductions/edit/' . $deduction['id']) }}"><i class="icon fa fa-edit"></i> <i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection