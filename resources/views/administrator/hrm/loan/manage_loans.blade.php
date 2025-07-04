@extends('administrator.master')
@section('title', __('Manage Credit'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('Credit/Loan') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
            <li><a>{{ __('Credit') }}</a></li>
            <li class="active">{{ __('Manage Credit') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Credit') }}</h3>
            </div>
            <div class="box-body">
                <div  class="col-md-6">
                    <a href="{{ url('/hrm/loans/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>{{ __(' Add loan') }}</a>
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
                <div  class="col-md-12 table-responsive">
                    <table id="example1" id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL#') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Loan Name') }}</th>
                                <th>{{ __('Loan Amount') }}</th>
                                <th>{{ __('Number of Inst.') }}</th>
                                <th>{{ __('Remaining Inst.') }}</th>
                                <th>{{ __('Loan Status') }}</th>
                                <th>{{ __('Date Added') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php ($sl = 1) @endphp

                            @foreach($loans as $loan)
                                @php
                                switch($loan['loan_status']) {
                                    case 1:
                                        $status = 'Active';
                                        break;
                                    case 2:
                                        $status = 'On Hold';
                                        break;
                                    case 3:
                                        $status = 'Close';
                                        break;
                                    default:
                                        $status = '';
                                        break;
                                }
                                @endphp
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $loan['name'] }}</td>
                                <td>{{ $loan['designation'] }}</td>
                                <td>{{ $loan['loanCode'] }} - {{ $loan['loanName'] }}</td>
                                <td>{{ $loan['loan_amount'] }}</td>
                                <td>{{ $loan['number_of_installments'] }}</td>
                                <td>{{ $loan['remaining_installments']!=0 || $loan['remaining_installments'] ? $loan['remaining_installments'] : $loan['number_of_installments'] }}</td>
                                <td>{{ $status }}</td>
                                <td>{{ date("d F Y", strtotime($loan['created_at'])) }}</td>
                                <td class="text-center">
                                   <a href="{{ url('/hrm/loans/edit/' . $loan['id']) }}"><i class="icon fa fa-edit"></i> <i class="fas fa-edit"></i></a> 
                                   <a href="{{ url('/hrm/loan_payments/manual_repayment/' . $loan['id']) }}"><i class="icon fa fa-edit"></i> {{ __('Manual Repayment') }}</a>
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