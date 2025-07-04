@extends('administrator.master')
@section('title', __('GL Code List'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('GL Code List') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('GL Code Management') }}</a></li>
            <li class="active">{{ __('GL Code List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('GL Code List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <a href="{{ route('gl_codes.create') }}" class="btn btn-primary">{{ __('Add GL Code') }}</a>
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
                                    <th>{{ __('GL Code') }}</th>
                                    <th>{{ __('GL Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($glCodes as $glCode)
                                    <tr>
                                        <td>{{ $glCode->gl_code }}</td>
                                        <td>{{ $glCode->gl_name }}</td>
                                        <td>{{ $glCode->status == 1 ? __('Active') : __('Inactive') }}</td>
                                        <td>
                                            <a href="{{ route('gl_codes.edit', $glCode->id) }}" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('gl_codes.destroy', $glCode->id) }}" method="POST" style="display:inline;">
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
