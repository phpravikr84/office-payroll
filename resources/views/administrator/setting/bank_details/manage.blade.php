@extends('administrator.master')
@section('title', __('Bank Details List'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('BANK DETAILS') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li class="active">{{ __('Bank Details') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Manage bank details') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                        <a href="{{ url('/setting/bank_details/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ __('Add bank details') }}</a>
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
                            <thead>
                                <tr>
                                    <th>{{ __('SL#') }}</th>
                                    <th>{{ __('Bank Detail Code') }}</th>
                                    <th>{{ __('Bank Detail Name') }}</th>
                                    <th class="text-center">{{ __('BSB Number') }}</th>
                                    <th class="text-center">{{ __('Bank Type') }}</th>
                                    <th class="text-center">{{ __('Bank Address') }}</th>
                                    <th class="text-center">{{ __('Bank Phone') }}</th>
                                    <th class="text-center">{{ __('Created On') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @php ($sl = 1)
                                @foreach($bankDetails as $bankDetail)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $bankDetail->bank_detail_code }}</td>
                                    <td>{{ $bankDetail->bank_detail_name }}</td>
                                    <td class="text-center">{{ $bankDetail->bsb_number }}</td>
                                    <td class="text-center">{{ $bankDetail->bank_type }}</td>
                                    <td class="text-center">{{ $bankDetail->bank_address }}</td>
                                    <td class="text-center">{{ $bankDetail->bank_phone }}</td>
                                    <td class="text-center">{{ date("d F Y", strtotime($bankDetail->created_at)) }}</td>
                                    <td class="text-center">
                                    @if ($bankDetail->status == 1)
                                        <a href="{{ url('/setting/bank_details/unpublished/' . $bankDetail->id)}}" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Unpublished">
                                            <span class="label">{{ __('Published') }}</span>
                                        </a>
                                    @else
                                    <a href="{{ url('/setting/bank_details/published/' . $bankDetail->id)}}" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Published">
                                        <span class="label">{{ __('Unpublished') }}</span>
                                    </a>
                                    @endif
                                    </td>
                                    <td class="text-center">
                                    <a href="{{ url('/setting/bank_details/edit/' . $bankDetail->id) }}"><i class="icon fa fa-edit"></i> <i class="fas fa-edit"></i></a>
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