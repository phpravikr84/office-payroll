@extends('administrator.master')
@section('title', __('Departments'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('DEPARTMENT') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li class="active">{{ __('Departments') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row mb-3 mt-3">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{ __('Manage departments') }}</h3>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <a href="{{ url('/setting/departments/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ __('Add department') }}</a>
                    </div>
                </div>
                <div  class="col-4 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Notification Box -->
                <div class="col-12">
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
                <div  class="col-12 table-responsive">
                    <table  id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL#') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Department Description') }}</th>
                                <th class="text-center">{{ __('Added') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php ($sl = 1)
                            @foreach($departments as $department)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td><a href="{{ url('/setting/departments/details/' . $department['id']) }}">{{ $department['department'] }}</a></td>
                                <td>{{ $department['department_description'] }}</td>
                                <td class="text-center">{{ date("d F Y", strtotime($department['created_at'])) }}</td>
                                <td class="text-center">
                                    @if ($department['publication_status'] == 1)
                                   <span class="label label-success">{{ __('Published') }}</span>
                                @else
                                <span class="label label-warning">{{ __('Unpublished') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('/setting/departments/edit/' . $department['id']) }}"><i class="icon fa fa-edit"></i> <i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div>
    </div>
    </section>
    <!-- /.content -->
</div>
@endsection