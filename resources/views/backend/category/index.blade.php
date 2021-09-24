@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Categories</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.category.create') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create Category
            </a>
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
                            <th class="text-center">Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td class="text-center text-muted">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">
                                    @if ($category->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $category->created_at->diffForHumans() }}</td>

                                <td class="text-center">
                                    <a href="{{ route('app.category.edit', $category->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deleteData({{ $category->id }})"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{ $category->id }}" method="POST" action="{{ route('app.category.destroy', $category->id) }}" style="display: none;">
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