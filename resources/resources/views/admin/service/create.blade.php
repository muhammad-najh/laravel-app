@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Create Service') }}</h1>
    <a href="{{ route('admin_service_index') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
        <i class="fas fa-bars"></i> {{ __('All Items') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin_service_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name EN') }} *</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name AR') }} *</label>
                        <input type="text" id="name" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name KRD') }} *</label>
                        <input type="text" id="name" name="name_krd" class="form-control" value="{{ old('name_krd') }}">
                    </div>
                </div>
                <div class="col-md-4">
                  
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category" class="form-label">{{ __('Category') }}</label>
                        <select id="category" name="category" class="form-select">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach($services_category as $category)
                                @foreach($category['subcategories'] as $subcategory)
                                    <option value="{{ $subcategory['id'] }}">{{ $subcategory['name_en'] }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="short_description" class="form-label">{{ __('Short Description EN') }} *</label>
                <textarea id="short_description" name="short_description" class="form-control h_100" cols="30" rows="10">{{ old('short_description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="short_description" class="form-label">{{ __('Short Description AR') }} *</label>
                <textarea id="short_description" name="short_description_ar" class="form-control h_100" cols="30" rows="10">{{ old('short_description_ar') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="short_description" class="form-label">{{ __('Short Description KRD') }} *</label>
                <textarea id="short_description" name="short_description_krd" class="form-control h_100" cols="30" rows="10">{{ old('short_description_krd') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description EN') }} *</label>
                <textarea id="description" name="description" class="form-control editor" cols="30" rows="10">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description AR') }} *</label>
                <textarea id="description" name="description_ar" class="form-control editor" cols="30" rows="10">{{ old('description_ar') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description KRD') }} *</label>
                <textarea id="description" name="description_krd" class="form-control editor" cols="30" rows="10">{{ old('description_krd') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
           
                    <div class="mb-3">
                        <label for="icon" class="form-label">{{ __('icon') }} *</label>
                        <div><input type="file" id="icon" name="icon"></div>
                    </div>
         
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="photo" class="form-label">{{ __('Photo') }} *</label>
                        <div><input type="file" id="photo" name="photo"></div>
                    </div>
                </div>
                
            
            <button type="submit" class="btn btn-success mb-50 btn-common">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
<script>
    window.onload = function () {
        document.getElementById('iconSelect').addEventListener('change', function () {
            var selectedValue = this.value;
            var previewElement = document.getElementById('iconPreview');
            previewElement.innerHTML = '<i class="icon ' + selectedValue + '"></i>';
        });
    };
</script>
@endsection
