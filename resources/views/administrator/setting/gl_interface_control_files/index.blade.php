@extends('administrator.master')
@section('title', __('GL Interface Control Files'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('GL Interface Control Files') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('GL Interface Management') }}</a></li>
            <li class="active">{{ __('Control Files List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Control Files List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                        <a href="{{ route('gl_interface_control_files.create') }}" class="btn btn-primary">{{ __('Add Control File') }}</a>
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
                                    <th>{{ __('Control Setup Name') }}</th>
                                    <th>{{ __('GL Code Account Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($controlFiles as $controlFile)
                                    <tr>
                                        <td>{{ $controlFile->control_setup_name }}</td>
                                        <td>{{ $controlFile->gl_name }}</td>
                                        <td>
                                            <a href="{{ route('gl_interface_control_files.edit', $controlFile->id) }}" class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                            <form action="{{ route('gl_interface_control_files.destroy', $controlFile->id) }}" method="POST" style="display:inline;">
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
