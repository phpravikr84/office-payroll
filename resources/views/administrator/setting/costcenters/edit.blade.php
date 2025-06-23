@extends('administrator.master')
@section('title', __('Edit Cost Center'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Cost Center') }}</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('costcenters.update', $costcenter->id) }}" method="POST">
                    {{ csrf_field() }}
                    <!-- {{ method_field('PUT') }} -->
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ $costcenter->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cost_center_code">{{ __('Cost Center Code') }}</label>
                        <input type="text" name="cost_center_code" class="form-control" value="{{ $costcenter->cost_center_code }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="department_id">{{ __('Department') }}* <em>(Select control click or command click for multiple select)</em></label>
                        <select class="form-control" name="department_id[]" multiple required>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" 
                                    @if(in_array($dept->id, $costcenter->departments->pluck('id')->toArray())) 
                                        selected 
                                    @endif>
                                    {{ $dept->department }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $costcenter->status ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="0" {{ !$costcenter->status ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
