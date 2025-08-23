@extends('admin.layouts.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('PDF For Selected Service') }}</h1>
    <div>
        <a href="{{ route('admin_service_index') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-backward"></i> {{ __('Back to Service') }}</a>
        <a href="" class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#pdf_add_modal"><i class="fas fa-plus"></i> {{ __('ADD PDF') }}</a>
        
        <!-- Modal for Adding PDF -->
        <div class="modal fade" id="pdf_add_modal" tabindex="-1" aria-labelledby="pdfAddModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="pdfAddModalLabel">{{ __('Add PDF') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin_service_pdf_store', $service->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="pdf" class="form-label">{{ __('PDF File') }}*</label>
                                <input type="file" name="pdf" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="pdf" class="form-label">{{ __('name') }}*</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal for Adding PDF -->
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dtable">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('PDF') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0; @endphp
                    @foreach($pdfs as $pdf)
                    @php $i++; @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ asset('public/uploads/pdf/' . $pdf->pdf) }}" target="_blank">{{ $pdf->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin_service_pdf_destroy', $pdf->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('{{ __('Are you sure?') }}')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Modal for Editing PDF -->
                    <div class="modal fade" id="pdf_edit_modal_{{ $i }}" tabindex="-1" aria-labelledby="pdfEditModalLabel_{{ $i }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="pdfEditModalLabel_{{ $i }}">{{ __('Edit PDF') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin_service_pdf_update', $pdf->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="pdf_name" class="form-label">{{ __('PDF Name') }}*</label>
                                            <input type="text" name="pdf_name" class="form-control" value="{{ $pdf->filename }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pdf_file" class="form-label">{{ __('Upload New PDF (optional)') }}</label>
                                            <input type="file" name="pdf_file" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Update') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal for Editing PDF -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
