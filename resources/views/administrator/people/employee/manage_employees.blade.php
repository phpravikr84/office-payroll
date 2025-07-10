@extends('administrator.master')
@section('title', __('Employee'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('Employee') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Employee') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Employee') }}</h3>
            </div>
            <div class="row box-body">
                <div class="col-md-6 text-end mb-3">
                    <a href="{{ url('/people/employees/manage') }}" class="btn btn-primary btn-flat">
                        <i class="fa fa-plus"></i> {{ __(' Add') }}
                    </a>
                    <button type="button" class="tip btn btn-primary btn-flat ms-2" title="Print" data-original-title="Label Printer" onclick="printDiv('printable_area')">
                        <i class="fa fa-print"></i>
                        <span class="hidden-sm hidden-xs"> {{ __('Print') }}</span>
                    </button>
                </div>

                    
                    <!-- <div  class="col-md-6">
                        <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                    </div> -->

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
        <div id="printable_area" class="col-md-12 table-responsive">
               <table  id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __(' SL#') }}</th>
                            <th>{{ __(' ID') }}</th>
                            <th>{{ __(' Name') }}</th>
                            <th>{{ __(' Designation') }}</th>
                            <th>{{ __(' Contact No') }}</th>
                            <th class="text-center">{{ __('Added') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>EMPID{{ $employee['employee_id'] }}</td>
                            <td>{{ $employee['name'] }}</td>
                            <td>{{ $employee['designation'] }}</td>
                            <td>{{ $employee['contact_no_one'] }}</td>
                            <td class="text-center">{{ date("d F Y", strtotime($employee['created_at'])) }}</td>
                           
                            <td class="text-center">
                               <a href="{{ url('/people/employees/edit/' . $employee['id']) }}" class="tip btn btn-warning tip btn-flat" title="" data-original-title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('/people/employees/delete/' . $employee['id']) }}" class="tip btn btn-danger btn-flat" data-toggle="tooltip" data-original-title="Click to delete" onclick="return confirm('Are you sure to delete this ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
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