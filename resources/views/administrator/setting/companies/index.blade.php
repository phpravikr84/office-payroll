@extends('administrator.master')
@section('title', __('Company Management'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Company Management') }}</h1>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Companies') }}</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="box-body">
                <table id="example1" id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Trading Name</th>
                            <th>Contact Person</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->trading_name }}</td>
                            <td>{{ $company->contact_person }}</td>
                            <td>
                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
