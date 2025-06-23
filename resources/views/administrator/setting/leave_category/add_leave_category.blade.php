@extends('administrator.master')
@section('title', __('Leave Categorys'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('LEAVE CATEGORY') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li><a href="{{ url('/setting/leave_categories') }}">{{ __('Leave Categories') }}</a></li>
            <li class="active">{{ __('Add leave category') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Add leave category') }}</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('setting/leave_categories/store') }}" method="post" name="leave_category_add_form">
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
                                <p class="text-yellow">{{ __('Enter leave_category details. All field are required.') }} </p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="leave_category">{{ __('Category Name ') }}<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('leave_category') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="leave_category" id="leave_category" class="form-control" value="{{ old('leave_category') }}" placeholder="{{ __('Enter category name..') }}">
                                @if ($errors->has('leave_category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('leave_category') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                            <div class="col-md-6">
                                <label for="item">{{ __('Item') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="item" id="item" class="form-control" value="{{ old('item', isset($leave_category) ? $leave_category['item'] : '') }}" placeholder="{{ __('Enter item..') }}">
                                    @if ($errors->has('item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="qty">{{ __('Quantity') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }} has-feedback">
                                    <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty', isset($leave_category) ? $leave_category['qty'] : '') }}" placeholder="{{ __('Enter quantity..') }}">
                                    @if ($errors->has('qty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="remarks">{{ __('Remarks') }}</label>
                                <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }} has-feedback">
                                    <textarea name="remarks" id="remarks" class="form-control" placeholder="{{ __('Enter remarks..') }}">{{ old('remarks', isset($leave_category) ? $leave_category['remarks'] : '') }}</textarea>
                                    @if ($errors->has('remarks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="type_of_leave">{{ __('Type of Leave') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('type_of_leave') ? ' has-error' : '' }} has-feedback">
                                    <select name="type_of_leave" id="type_of_leave" class="form-control">
                                        <option value="" selected disabled>{{ __('Select type of leave') }}</option>
                                        <option value="carry_forward" {{ old('type_of_leave', isset($leave_category) ? $leave_category['type_of_leave'] : '') == 'carry_forward' ? 'selected' : '' }}>{{ __('Carry Forward') }}</option>
                                        <option value="paid" {{ old('type_of_leave', isset($leave_category) ? $leave_category['type_of_leave'] : '') == 'paid' ? 'selected' : '' }}>{{ __('Paid') }}</option>
                                    </select>
                                    @if ($errors->has('type_of_leave'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_of_leave') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="col-md-6">
                            <!-- /.form-group -->
                            <label for="publication_status">{{ __('Publication Status ') }}<span class="text-danger">*</span></label>
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
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <label for="leave_category_description">{{ __('Category Description') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('leave_category_description') ? ' has-error' : '' }} has-feedback">
                                <textarea class="form-control" rows="8" name="leave_category_description" id="leave_category_description" placeholder="{{ __('Enter client description..') }}">{{ old('leave_category_description') }}</textarea>
                                @if ($errors->has('leave_category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('leave_category_description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('/setting/leave_categories') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i>{{ __('Cancel') }} </a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i>{{ __('Add leave category') }} </button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['leave_category_add_form'].elements['publication_status'].value = "{{ old('publication_status') }}";
</script>
@endsection
