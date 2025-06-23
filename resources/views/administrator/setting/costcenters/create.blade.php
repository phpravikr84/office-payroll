@extends('administrator.master')
@section('title', __('Add Cost Center'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Add Cost Center') }}</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('costcenters.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cost_center_code">{{ __('Cost Center Code') }}</label>
                        <input type="text" name="cost_center_code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="department_id">{{ __('Department') }}* <em>(Select control click or command click for multiple select)</em></label>
                        <select class="form-control" name="department_id[]" multiple required>
                            @if($departments)
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->department }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" class="form-control" required>
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Inactive') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
