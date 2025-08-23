@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Add Partner') }}</h1>
    <a href="{{ route('admin_partner_index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
        <i class="fas fa-arrow-left"></i> {{ __('Back to Partners') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin_partner_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="logo">{{ __('Logo') }}</label>
                <input type="file" class="form-control-file" id="logo" name="logo" required>
                @if ($errors->has('logo'))
                    <small class="text-danger">{{ $errors->first('logo') }}</small>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Save Partner') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
