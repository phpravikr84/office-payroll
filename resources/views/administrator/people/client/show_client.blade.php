@extends('administrator.master')
@section('title', __('Client Types'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('CLIENTS') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
            <li><a>{{ __('People') }}</a></li>
            <li><a href="{{ url('/people/clients') }}">{{ __('Clients') }}</a></li>
            <li class="active">{{ __('Details') }}</li>
        </ol>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('Details of client') }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ url('/people/clients') }}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i>{{ __('Back') }} </a>
            <hr>
            <div id="printable_area">
                <table  id="example1" class="table table-bordered table-striped">
                    <tbody id="myTable">
                        <tr>
                            <td>{{ __('Name') }}</td>
                            <td>{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Email') }}</td>
                            <td>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Address') }}</td>
                            <td>{{ $client->present_address }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Contact No') }}</td>
                            <td>{{ $client->contact_no_one }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Contact No (Optional)') }}</td>
                            <td>{{ $client->contact_no_two }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Web') }}</td>
                            <td>{{ $client->web }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Gender') }}</td>
                            <td>
                                @if($client->gender == 'm')
                                <p>{{ __('Male') }}</p>
                                @else
                                <p>{{ __('Female') }}</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('Date of Birth') }}</td>
                            <td>
                                @if($client->date_of_birth != NULL)
                                {{ date("d F Y", strtotime($client->date_of_birth)) }}
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('Client Type') }}</td>
                            <td>{{ $client->client_type }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Created By') }}</td>
                            <td>{{ $created_by->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Date Added') }}</td>
                            <td>{{ date("D d F Y - h:ia", strtotime($client->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Last Updated') }}</td>
                            <td>{{ date("D d F Y - h:ia", strtotime($client->updated_at)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="btn-group btn-group-justified">
                @if ($client->activation_status == 1)
                <div class="btn-group">
                    <a href="{{ url('/people/clients/deactive/' . $client->id)}}" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Click to deactive">
                        <i class="fa fa-arrow-down"></i>
                        <span class="hidden-sm hidden-xs"> {{ __('Active') }}</span>
                    </a>
                </div>
                @else
                <div class="btn-group">
                    <a href="{{ url('/people/clients/active/' . $client->id)}}" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Click to active">
                        <i class="fa fa-arrow-up"></i>
                        <span class="hidden-sm hidden-xs"> {{ __('Deactive') }}</span>
                    </a>
                </div>
                @endif
                <div class="btn-group">
                    <button type="button" class="tip btn btn-primary btn-flat" title="Print" data-original-title="Label Printer" onclick="printDiv('printable_area')">
                        <i class="fa fa-print"></i>
                        <span class="hidden-sm hidden-xs"> {{ __('Print') }}</span>
                    </button>
                </div>
                <div class="btn-group">
                    <a href="{{ url('/people/clients/download-pdf/' . $client->id) }}" class="tip btn btn-primary btn-flat" title="" data-original-title="PDF">
                        <i class="fa fa-file-pdf-o"></i>
                        <span class="hidden-sm hidden-xs">{{ __('PDF') }} </span>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url('/people/clients/edit/' . $client->id) }}" class="tip btn btn-warning tip btn-flat" title="" data-original-title="Edit Product">
                        <i class="fa fa-edit"></i>
                        <span class="hidden-sm hidden-xs"> <i class="fas fa-edit"></i></span>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url('/people/clients/delete/' . $client->id) }}" class="tip btn btn-danger btn-flat" data-toggle="tooltip" data-original-title="Click to delete" onclick="return confirm('Are you sure to delete this ?');">
                        <i class="fa fa-arrow-up"></i>
                        <span class="hidden-sm hidden-xs"> <i class="fas fa-trash-alt"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
</div>
@endsection