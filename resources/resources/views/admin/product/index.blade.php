@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('products') }}</h1>
    <a href="{{ route('admin_product_create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-plus"></i> {{ __('Add Item') }}</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dtable">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Icon') }}</th>
                        <th>{{ __('Name') }}</th>
                        <!-- <th>{{ __('Manage FAQ') }}</th> -->
                        <th>{{ __('Action') }}</th>
                        <th>{{ __('Manage PDF') }}</th> <!-- Added missing column header -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="photo-container-small">
                                <a href="{{ asset('uploads/'.$product->photo) }}" class="magnific"><img src="{{ asset('uploads/'.$product->photo) }}" alt=""></a>
                            </div>
                        </td>
                        
                        <td>
                            <div class="photo-container-small">
                                @if($product->icon == null)
                                    <img src="{{ asset('uploads/no_photo.png') }}" alt="">
                                @else
                                    <a href="{{ asset('uploads/'.$product->icon) }}" class="magnific"><img src="{{ asset('uploads/'.$product->icon) }}" alt=""></a>
                                @endif
                            </div>
                        </td>
                        <td>
                            {{ $product->name_en }}
                        </td>
                        <td>
                            <a href="{{ route('admin_product_edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin_product_destroy', $product->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ __('Are you sure?') }}')"><i class="fas fa-trash"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('admin_product_pdf', $product->id) }}" class="btn btn-success btn-sm rounded-pill pl_20 pr_20">{{ __('Manage PDF') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
