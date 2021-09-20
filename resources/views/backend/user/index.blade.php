@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Users</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.user.create') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create User
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
                            <th>Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Joined At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td class="text-center text-muted">{{ $key + 1 }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" height="40" class="rounded-circle" 
                                                    src="{{ $user->getFirstMediaUrl('image') != null ? $user->getFirstMediaUrl('image') : config('app.placeholderImage').'160.png' }}" alt="User Image">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"> {{ $user->name }} </div>
                                                <div class="widget-subheading opacity-7">
                                                    @if ($user->role)
                                                        <span class="badge badge-info">{{ $user->role->name }}</span>
                                                    @else
                                                        <span class="badge badge-danger">No role found.</span>    
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>

                                <td class="text-center">
                                    <a href="{{ route('app.user.show', $user->id) }}"class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                        <span>Show</span>
                                    </a>

                                    <a href="{{ route('app.user.edit', $user->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deleteData({{ $user->id }})"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('app.user.destroy', $user->id) }}" style="display: none;">
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
    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endpush