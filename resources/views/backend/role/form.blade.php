@extends('layouts.backend.app')
@push('css')

@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($role) ? 'Edit' : 'Create' }} Roles</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.role.index') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <form id="roleForm" action="{{ isset($role) ? route('app.role.update', $role->id) : route('app.role.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($role)
                    @method('PUT') 
                @endisset
                <div class="card-body">
                    <h5 class="card-title">Manage Roles</h5>
                    <div class="form-group">
                        <label for="name"> Role Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" required autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <br>
                        <strong class="text-uppercase badge badge-warning">Manage permissions for role</strong>
                        
                        @error('permissions')
                            <p class="p-1">
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="select-all">
                            <label for="select-all" class="custom-control-label">Select All</label>
                        </div>
                    </div>

                    @forelse ($modules->chunk(3) as $key=>$chunks)
                        <div class="form-row">
                            @foreach ($chunks as $key=>$module)
                                <div class="col">
                                    <h5>Module: {{ $module->name }}</h5>
                                    @foreach ($module->permissions as $key=>$permission)
                                        <div class="mb-3 ml-4">
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input"             
                                                    id="permission-{{ $permission->id }}" 
                                                    name="permissions[]" 
                                                    value="{{ $permission->id }}"

                                                    @isset($role)
                                                        @foreach ($role->permissions as $rolePermission)
                                                            {{ $permission->id == $rolePermission->id ? 'checked' : '' }}
                                                        @endforeach
                                                    @endisset
                                                >
                                                <label for="permission-{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="row">
                            <div class="col text-center">
                                <strong>No modules found :(</strong>
                            </div>
                        </div>
                    @endforelse
                    
                    <button type="button" class="btn btn-danger" onClick="resetForm('roleForm')">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>

                    <button type="submit" class="btn btn-primary">
                        @isset($role)
                            <i class="fas fa-arrow-circle-up"></i>
                            Update
                        @else
                            <i class="fas fa-plus-circle"></i>
                            Create
                        @endisset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $('#select-all').click(function (event){
            if(this.checked){
                $(':checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $(':checkbox').each(function(){
                    this.checked = false;
                });
            }
        });
    </script>
@endpush