@extends('administrator.master')
@section('title', __('Edit Holidays'))

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
			<li><a href="{{ url('/setting/holidays') }}">{{ __('Holiays') }}</a></li>
			<li class="active"><i class="fas fa-edit"></i></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- SELECT2 EXAMPLE -->
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">{{ __('Edit Holidays') }}</h3>
			</div>
			<!-- /.box-header -->
			<form action="{{ url('/setting/holidays/update/' . $holidays['id']) }}" method="post" name="holidays_edit_form">
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
							<p class="text-yellow">{{ __('Enter holidays details. All field are required. ') }}</p>
							@endif
						</div>
						<!-- /.Notification Box -->

						<div class="col-md-6">
							<label for="holiday_name">{{ __('Event Name ') }}<span class="text-danger">*</span></label>
							<div class="form-group{{ $errors->has('holiday_name') ? ' has-error' : '' }} has-feedback">
								<input type="text" name="holiday_name" value="{{ $holidays['holiday_name'] }}" id="holiday_name" class="form-control">
								@if ($errors->has('holiday_name'))
								<span class="help-block">
									<strong>{{ $errors->first('holiday_name') }}</strong>
								</span>
								@endif
							</div>
							<!-- /.form-group -->

							<label for="date">{{ __('Date') }} <span class="text-danger">*</span></label>
							<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }} has-feedback">
								<input type="text" name="date" id="datepicker" class="form-control" value="{{ $holidays['date'] }}">
								@if ($errors->has('date'))
								<span class="help-block">
									<strong>{{ $errors->first('date') }}</strong>
								</span>
								@endif
							</div>
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
							<label for="description">{{ __('Description') }}  <span class="text-danger">*</span></label>
							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} has-feedback">
								<textarea class="form-control" rows="8" name="description" id="description">{{ $holidays['description'] }}</textarea>
								@if ($errors->has('leave_category'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
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
					<a href="{{ url('setting/holidays') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> {{ __('Cancel') }}</a>
					<button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Update Holiday List') }}</button>
				</div>
			</form>
		</div>
		<!-- /.box -->


	</section>
	<!-- /.content -->
</div>
<script type="text/javascript">
	document.forms['holidays_edit_form'].elements['publication_status'].value = "{{ $holidays['publication_status'] }}";
</script>
@endsection
