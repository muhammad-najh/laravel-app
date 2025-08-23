@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Contacts') }}</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dtable">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Subject') }}</th>
                        <th>{{ __('Message') }}</th>
                        <th>{{ __('DateTime') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>
                            <div style="max-height: 100px; overflow-y: auto; border: 1px solid #ddd; padding: 5px;">
                                {{ $contact->message }}
                            </div>
                        </td>
                        <td>{{ $contact->datetime }}</td>
                       
                        <td>
                          <a href="{{ route('admin_contact_us_destroy', $contact->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ __('Are you sure?') }}')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
