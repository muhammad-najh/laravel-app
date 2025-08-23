@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Partners') }}</h1>
    <a href="{{ route('admin_partner_create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> {{ __('Add Partner') }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dtable">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Logo') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partners as $partner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="photo-container-small">
                                <a href="{{ asset('uploads/'.$partner->logo) }}" class="magnific">
                                    <img src="{{ asset('uploads/'.$partner->logo) }}" alt="" style="max-width: 100px;">
                                </a>
                            </div>
                        </td>
                        <td>
                         
                            <a href="{{ route('admin_partner_destroy', $partner->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ __('Are you sure?') }}')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
