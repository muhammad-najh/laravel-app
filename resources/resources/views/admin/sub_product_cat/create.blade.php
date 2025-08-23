@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Create Service') }}</h1>
    <a href="{{ route('admin_product_cat_index_sub') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
        <i class="fas fa-bars"></i> {{ __('All Items') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin_product_cat_store_sub') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name_en" class="form-label">{{ __('Name') }} *</label>
                        <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
                    </div>
                </div>
           
           
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url') }}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">{{ __('Category') }} *</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach($productCategories as $category)
                                <option name="product_id" value="{{ $category->id }}">{{ $category->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success mb-50 btn-common">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
@endsection
