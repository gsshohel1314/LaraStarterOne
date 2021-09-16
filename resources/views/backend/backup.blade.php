@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Backups</div>
        </div>
        <div class="page-title-actions">
            <button onclick="event.preventDefault();
            document.getElementById('clean-old-backup-form').submit();"
            type="button" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-trash"></i>
                Cleanup old Backup
            </button>
            <form id="clean-old-backup-form" method="POST" action="{{ route('app.backups.clean') }}" style="display: none">
                @csrf
                @method('DELETE')
            </form>
            
            <button onclick="event.preventDefault();
            document.getElementById('new-backup-form').submit();"
            type="button" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create New Backup
            </button>
            <form id="new-backup-form" method="POST" action="{{ route('app.backups.store') }}" style="display: none">
                @csrf
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">File Name</th>
                            <th class="text-center">Fiel Size</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $key => $backup)
                            <tr>
                                <td class="text-center text-muted">{{ $key + 1 }}</td>
                                <td class="text-center">
                                    <code>{{ $backup['file_name'] }}</code>
                                </td>
                                <td class="text-center">{{ $backup['file_size'] }}</td>
                                <td class="text-center">{{ $backup['created_at'] }}</td>
                                <td class="text-center">
                                    <a href="{{ route('app.backups.download', $backup['file_name']) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-download"></i>
                                        <span>Download</span>
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deleteData({{ $key }})"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{ $key }}" method="POST" action="{{ route('app.backups.destroy', $backup['file_name']) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('backend/assets/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endpush