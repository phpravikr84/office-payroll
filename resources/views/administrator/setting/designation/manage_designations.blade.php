@extends('administrator.master')
@section('title', __('Designations'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('DESIGNATIONS') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li class="active">{{ __('Designations') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage designations') }}</h3>
            </div>
            <div class="box-body">
                
                <div  class="col-md-6">
                    <a href="{{ url('/setting/designations/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ __('Add designation') }}</a>
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
                    <table  id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL#') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation Description') }}</th>
                                <th class="text-center">{{ __('Added By') }}</th>
                                <th class="text-center">{{ __('Added') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php ($sl = 1)
                            @foreach($designations as $designation)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $designation['designation'] }}</td>
                                <td>{{ $designation['department'] }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($designation['designation_description'], 65) }}</td>
                                <td>{{ $designation['name'] }}</td>
                                <td class="text-center">{{ date("d F Y", strtotime($designation['created_at'])) }}</td>
                                <td class="text-center">
                                    @if ($designation['publication_status'] == 1)
                                    <span class="label label-success">{{ __('Published') }}</span>
                                @else
                                <span class="label label-warning">{{ __('Unpublished') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/setting/designations/edit/' . $designation['id']) }}"><i class="fas fa-edit"></i></a>
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