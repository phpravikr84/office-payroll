@extends('administrator.master')
@section('title', __('Shift Lists'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('Manage Shift Lists') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li class="active">{{ __('Manage Shift Lists') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Shift Lists') }}</h3>
            </div>
            <div class="box-body">
                
                <div  class="col-md-6">
                    <a href="{{ url('/setting/shifts/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>{{ __(' Add Shift Lists') }}</a>
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
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL#') }}</th>
                                <th>{{ __('Shift Name') }}</th>
                                <th>{{ __('Check In') }}</th>
                                <th>{{ __('Check Out') }}</th>
                                <th>{{ __('Working Hrs') }}</th>
                                <!-- <th>{{ __('Half Day') }}</th> -->
                                <th class="text-center">{{ __('Create By') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                          @php ( $sl = 1 )
                          @foreach( $shifts as $shift )
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $shift['shift_name'] }}</td>
                                <td>{{ $shift['in_time'] }}</td>
                                <td>{{ $shift['out_time'] }}</td>
                                <td>{{ $shift['tot_working_hrs'] }}</td>
                                <!-- <td>{{ $shift['half_day_id'] }}</td> -->
                                <td>{{ $shift['created_by'] }}</td>
                                <td class="text-center">
                                  @if( $shift['publication_status'] == 1 )
                                    <span class="label label-success">{{ __('Active') }}</span>
                                @else
                                    <span class="label label-warning">{{ __('In-Active') }}</span>
                                @endif
                                </td>
                                <td class="text-center">
                                   <a href="{{ url('/setting/shifs/edit/' . $shift['id'] ) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
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
