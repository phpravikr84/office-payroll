@extends('administrator.master')
@section('title', __('Bank List'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Bank List') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Bank Management') }}</a></li>
            <li class="active">{{ __('Bank List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Bank List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <a href="{{ route('banks.create') }}" class="btn btn-primary">{{ __('Add Bank') }}</a>
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
                                    <th>{{ __('Bank Code') }}</th>
                                    <th>{{ __('Bank Name') }}</th>
                                    <th>{{ __('Publication Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banks as $bank)
                                    <tr>
                                        <td>{{ $bank->bank_code }}</td>
                                        <td>{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->status == 1 ? __('Published') : __('Unpublished') }}</td>
                                        <td>
                                            <a href="{{ route('banks.edit', $bank->id) }}" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" style="display:inline;">
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
