@extends('administrator.master')
@section('title', __('Bank Details'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('BANK DETAILS') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li><a href="{{ url('/setting/bank_details') }}">{{ __('Bank Details') }}</a></li>
            <li class="active">{{ __('Details') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Details of bank detail') }}</h3>
            </div>
            <div class="box-body">
                <a href="{{ url('/setting/bank_details') }}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i>{{ __('Back') }} </a>
                <hr>
                <table id="example1" id="example1" class="table table-bordered table-striped">
                    <tbody id="myTable">
                        @if($bankDetails)
                            @foreach($bankDetails as $bankDetail)
                            <tr>
                                <td>{{ __('Bank Detail Code') }}</td>
                                <td>{{ $bankDetail->bank_detail_code }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Bank Detail Name') }}</td>
                                <td>{{ $bankDetail->bank_detail_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('BSB Number') }}</td>
                                <td>{{ $bankDetail->bsb_number }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Bank Type') }}</td>
                                <td>{{ $bankDetail->bank_type }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Bank Address') }}</td>
                                <td>{{ $bankDetail->bank_address }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Bank Phone') }}</td>
                                <td>{{ $bankDetail->bank_phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Employment Account Number') }}</td>
                                <td>{{ $bankDetail->employment_account_number }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Account Suffix') }}</td>
                                <td>{{ $bankDetail->account_suffix }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Publication Status') }}</td>
                                <td>
                                    @if ($bankDetail->status == 1)
                                    <div class="btn-group">
                                        <a href="{{ url('/setting/bank_details/unpublished/' . $bankDetail->id)}}" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Unpublished">
                                            <i class="fa fa-arrow-down"></i>
                                            <span class="hidden-sm hidden-xs"> {{ __('Published') }}</span>
                                        </a>
                                    </div>
                                    @else
                                    <div class="btn-group">
                                        <a href="{{ url('/setting/bank_details/published/' . $bankDetail->id)}}" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Published">
                                            <i class="fa fa-arrow-up"></i>
                                            <span class="hidden-sm hidden-xs"> {{ __('Unpublished') }}</span>
                                        </a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Bank Details Available !</td>
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
