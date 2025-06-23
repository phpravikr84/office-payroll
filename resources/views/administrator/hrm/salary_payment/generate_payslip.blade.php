@extends('administrator.master')
@section('title', __('Generate Payslip'))

@section('main_content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ __('GENERATE PAYSLIP') }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
      <li><a>{{ __('Salary') }}</a></li>
      <li class="active">{{ __('Generate Payslip') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('Generate Payslip') }}</h3>
      </div>
      <div class="box-body">
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
        <div class="col-md-12">
          <form class="form-horizontal" action="{{ url('/hrm/generate-payslips/') }}" method="post">
            {{ csrf_field() }}
              <div class="form-group{{ $errors->has('salary_frm_date') ? ' has-error' : '' }}">
                <label for="salary_frm_date" class="col-sm-3 control-label">{{ __('Select From Date') }}</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="date" name="salary_frm_date" id="salary_frm_date" class="form-control pull-right" value="{{ old('salary_frm_date')}}" onchange="updateDate2()">
                  </div>
                    @if ($errors->has('salary_frm_date'))
                    <span class="help-block">
                      <strong>{{ $errors->first('salary_frm_date') }}</strong>
                    </span>
                    @endif
                </div>
              </div>
              <!-- /.end group -->
              <div class="form-group{{ $errors->has('salary_to_date') ? ' has-error' : '' }}">
                <label for="salary_to_date" class="col-sm-3 control-label">{{ __('Select To Date') }}</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="date" name="salary_to_date" id="salary_to_date" class="form-control pull-right" value="{{ old('salary_to_date')}}">
                  </div>
                    @if ($errors->has('salary_to_date'))
                    <span class="help-block">
                      <strong>{{ $errors->first('salary_to_date') }}</strong>
                    </span>
                    @endif
                </div>
              </div>
              <!-- /.end group -->
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i> {{ __('GO') }}</button>
                </div>
              </div>
              <!-- /.end group -->
            </form>
            <!-- /. end form -->
          </div>
          <!-- /. end col -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix"></div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
