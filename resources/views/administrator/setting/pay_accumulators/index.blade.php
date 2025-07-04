@extends('administrator.master')
@section('title', __('Pay Accumulator List'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Pay Accumulator List') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Pay Accumulator Management') }}</a></li>
            <li class="active">{{ __('Pay Accumulator List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Pay Accumulator List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <a href="{{ route('pay_accumulators.create') }}" class="btn btn-primary">{{ __('Add Pay Accumulator') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Pay Accumulator Code') }}</th>
                                    <th>{{ __('Pay Accumulator Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payAccumulators as $payAccumulator)
                                    <tr>
                                        <td>{{ $payAccumulator->pay_accumulator_code }}</td>
                                        <td>{{ $payAccumulator->pay_accumulator_name }}</td>
                                        <td>{{ $payAccumulator->status == 1 ? __('Active') : __('Inactive') }}</td>
                                        <td>
                                            <a href="{{ route('pay_accumulators.edit', $payAccumulator->id) }}" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('pay_accumulators.destroy', $payAccumulator->id) }}" method="POST" style="display:inline;">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
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
