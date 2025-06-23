@extends('administrator.master')
@section('title', __('Pay Location List'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Pay Location List') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Pay Location Management') }}</a></li>
            <li class="active">{{ __('Pay Location List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Pay Location List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <a href="{{ route('pay_locations.create') }}" class="btn btn-primary">{{ __('Add Pay Location') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Location Code') }}</th>
                                    <th>{{ __('Location Name') }}</th>
                                    <th>{{ __('Publication Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payLocations as $payLocation)
                                    <tr>
                                        <td>{{ $payLocation->payroll_location_code }}</td>
                                        <td>{{ $payLocation->payroll_location_name }}</td>
                                        <td>{{ $payLocation->status == 1 ? __('Published') : __('Unpublished') }}</td>
                                        <td>
                                            <a href="{{ route('pay_locations.edit', $payLocation->id) }}" class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                            <form action="{{ route('pay_locations.destroy', $payLocation->id) }}" method="POST" style="display:inline;">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                            </form>
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
</div>
@endsection
