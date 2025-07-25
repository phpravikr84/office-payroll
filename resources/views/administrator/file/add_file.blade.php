@extends('administrator.master')
@section('title', __('Add File'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('FILES') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }} </a></li>
            <li><a href="{{ url('/files/' . $folder_id) }}"> {{ __('Files') }}</a></li>
            <li class="active"> {{ __('Add file') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"> {{ __('Add File') }}</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('/files/store/'.$folder_id) }}" method="post" name="file_name_add_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">

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
                            @else
                            <p class="text-yellow">{{ __('Enter file details. All field are required. ') }}</p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="caption">{{ __('Caption') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="caption" id="caption" class="form-control" value="{{ old('caption') }}" placeholder="{{ __('Enter caption..') }}">
                                @if ($errors->has('caption'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('caption') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="file_name">{{ __('Chose File') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('file_name') ? ' has-error' : '' }} has-feedback">
                                <input type="file" name="file_name" id="file_name" class="form-control" value="{{ old('file_name') }}" placeholder="{{ __('Enter client name..') }}">
                                @if ($errors->has('file_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="publication_status">{{ __('Publication Status') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('publication_status') ? ' has-error' : '' }} has-feedback">
                                <select name="publication_status" id="publication_status" class="form-control">
                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                    <option value="1">{{ __('Published') }}</option>
                                    <option value="0">{{ __('Unpublished') }}</option>
                                </select>
                                @if ($errors->has('publication_status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('publication_status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('/files/' . $folder_id) }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> {{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-success btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add file') }}</button>
            </div>
        </form>
    </div>
    <!-- /.box -->


</section>
<!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['file_name_add_form'].elements['publication_status'].value = "{{ old('publication_status') }}";
</script>
@endsection
