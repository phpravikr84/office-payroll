@extends('administrator.master')
@section('title', __('Personal Events'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('PERSONAL EVENT') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li class="active">{{ __('Personal Events') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Manage Personal Events') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <a href="{{ url('/setting/personal-events/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>{{ __('Add personal event') }} </a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div  class="col-4 mb-4">
                        <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                    </div>
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
                    <div class="col-12 table-responsive">
                        <table  id="example1" class="table table-bordered table-striped">
                            <tbody id="myTable">
                                <tr>
                                    <th>{{ __('SL#') }}</th>
                                    <th>{{ __('Personal Event') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('End Date') }}</th>
                                    <th>{{ __('Personal Event Description') }}</th>
                                    <th class="text-center">{{ __('Added By') }}</th>
                                    <th class="text-center">{{ __('Added') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($sl = 1)
                                @foreach($personal_events as $personal_event)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $personal_event['personal_event'] }}</td>
                                    <td class="text-center">{{ date("d F Y", strtotime($personal_event['start_date'])) }}</td>
                                    <td class="text-center">{{ date("d F Y", strtotime($personal_event['end_date'])) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($personal_event['personal_event_description'], 65) }}</td>
                                    <td class="text-center">{{ $personal_event['name'] }}</td>
                                    <td class="text-center">{{ date("d F Y", strtotime($personal_event['created_at'])) }}</td>
                                    <td class="text-center">
                                        @if ($personal_event['publication_status'] == 1)
                                        <span class="label label-success">{{ __('Published') }}</span>
                                    @else
                                    <span class="label label-warning">{{ __('Unpublished') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                    <a href="{{ url('/setting/personal-events/edit/' . $personal_event['id']) }}"><i class="icon fa fa-edit"></i> <i class="fas fa-edit"></i></a>
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
