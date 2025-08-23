@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Edit product') }}</h1>
    <a href="{{ route('admin_product_index') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-bars"></i> {{ __('All Items') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin_product_update',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Name EN') }} *</label>
                        <input type="text" name="name_en" class="form-control" value="{{ $product->name_en }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Name AR') }} *</label>
                        <input type="text" name="name_ar" class="form-control" value="{{ $product->name_ar }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Name KRD') }} *</label>
                        <input type="text" name="name_krd" class="form-control" value="{{ $product->name_krd }}">
                    </div>
                </div>
            
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Short Description EN') }} *</label>
                <textarea name="short_description_en" class="form-control h_100" cols="30" rows="10">{{ $product->short_description_en }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Short Description AR') }} *</label>
                <textarea name="short_description_ar" class="form-control h_100" cols="30" rows="10">{{ $product->short_description_ar }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Short Description KRD') }} *</label>
                <textarea name="short_description_krd" class="form-control h_100" cols="30" rows="10">{{ $product->short_description_krd }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Description EN') }} * </label>
                <textarea name="description_en" class="form-control editor" cols="30" rows="10">{{ $product->description_en }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Description AR') }} * </label>
                <textarea name="description_ar" class="form-control editor" cols="30" rows="10">{{ $product->description_ar }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">{{ __('Description KRD') }} * </label>
                <textarea name="description_krd" class="form-control editor" cols="30" rows="10">{{ $product->description_krd }}</textarea>
            </div>
            <div class="row">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Existing Icon') }}</label>
                        <div class="photo-container">
                            <a href="{{ asset('uploads/'.$product->icon) }}" class="magnific"><img src="{{ asset('uploads/'.$product->icon) }}" alt=""></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Change Icon') }}</label>
                        <div><input type="file" name="icon"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{$product->phone}}">
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">{{ __('Category') }}</label>
                        <select id="category" name="category" class="form-select">
                            <option value="{{$product->category}}">{{ $selcted }}</option>
                            @foreach($products_category as $category)
                                @foreach($category['subcategories'] as $subcategory)
                                    <option value="{{ $subcategory['id'] }}">{{ $subcategory['name_en'] }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Existing Photo') }}</label>
                        <div class="photo-container">
                            <a href="{{ asset('uploads/'.$product->photo) }}" class="magnific"><img src="{{ asset('uploads/'.$product->photo) }}" alt=""></a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">{{ __('Change Photo') }}</label>
                        <div><input type="file" name="photo"></div>
                    </div>
                </div>
            
           
            </div>
            <button type="submit" class="btn btn-success mb-50 btn-common">{{ __('Update') }}</button>
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