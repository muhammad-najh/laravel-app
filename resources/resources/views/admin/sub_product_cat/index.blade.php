@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('product_category') }}</h1>
    <a href="{{ route('admin_product_cat_create_sub') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-plus"></i> {{ __('Add Item') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dtable">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mySubProductsCat as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                       
                        <td>
                            {{ $product->name_en }}
                        </td>
                       
                        <td>
                          <a href="{{ route('admin_product_cat_destroy_sub',$product->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ __('Are you sure?') }}')"><i class="fas fa-trash"></i></a>
                          <a href="{{ route('admin_product_cat_edit_sub',$product->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection