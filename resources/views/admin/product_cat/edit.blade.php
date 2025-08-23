@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Product Category') }}</h1>
    <a href="{{ route('admin_product_cat_index') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-bars"></i> {{ __('All Items') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin_product_cat_update',$category->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Name En') }}*</label>
                <input type="text" name="name_en" class="form-control" value="{{ $category->name_en }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Name AR') }}*</label>
                <input type="text" name="name_ar" class="form-control" value="{{ $category->name_ar }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Name KRD') }}*</label>
                <input type="text" name="name_krd" class="form-control" value="{{ $category->name_krd }}">
            </div>

            <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="{{ $category->url }}">
                    </div>
            <button type="submit" class="btn btn-success mb-50 btn-common">{{ __('Update') }}</button>
        </form>
    </div>
</div>
@endsection