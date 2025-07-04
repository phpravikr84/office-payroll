@extends('administrator.master')
@section('title', __('Branch List'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Branch List') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Branch Management') }}</a></li>
            <li class="active">{{ __('Branch List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Branch List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                        <a href="{{ route('branches.create') }}" class="btn btn-primary">{{ __('Add Branch') }}</a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">{{ $message }}</div>
                @endif
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Branch Code') }}</th>
                            <th>{{ __('Branch Name') }}</th>
                            <th>{{ __('Branch Address') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $branch->branch_code }}</td>
                                <td>{{ $branch->branch_name }}</td>
                                <td>{{ $branch->branch_address }}</td>
                                <td>
                                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline;">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <div>
        </div>
    </section>
</div>
@endsection
