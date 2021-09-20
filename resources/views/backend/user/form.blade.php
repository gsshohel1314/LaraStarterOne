@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/select2/select2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<style>
    .dropify-wrapper .dropify-message p {
        font-size: initial;
    }
</style>
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($user) ? 'Edit' : 'Create' }} User</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.user.index') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form id="userForm" action="{{ isset($user) ? route('app.user.update', $user->id) : route('app.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($user)
                @method('PUT') 
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">User Info</h5>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" required autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required>
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            @if (!isset($user))
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" {{ !isset($user) ? 'required' : '' }}>
            
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input id="confirm_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" {{ !isset($user) ? 'required' : '' }}>
            
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Select role, image and status</h5>
                            <div class="form-group">
                                <label for="role">User Role</label>
                                <select name="role" id="role" class="js-example-basic-single form-control @error('role') is-invalid @enderror" required>
                                    <option value="">Select User Role</option>
                                    @foreach ($roles as $key=>$role)
                                        <option value="{{ $role->id }}" @isset($user) {{ $user->role->id == $role->id ? 'selected' : '' }} @endisset>{{ $role->name }}</option>
                                    @endforeach
                                </select>
        
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image (Only Image are allowed)</label>
                                <input type="file" name="image" id="image" class="dropify form-control @error('image') is-invalid @enderror" data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('image') : ''}}" {{ !isset($user) ? 'required' : '' }}>
        
                                @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>

                                @error('status')
                                    <span class="invalid-feedback" image="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-danger" onClick="resetForm('userForm')">
                                <i class="fas fa-redo"></i>
                                <span>Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary">
                                @isset($user)
                                    <i class="fas fa-arrow-circle-up"></i>
                                    Update
                                @else
                                    <i class="fas fa-plus-circle"></i>
                                    Create
                                @endisset
                            </button>
                        </div>    
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('backend/assets/select2/select2.min.js') }}"></script>
    <script>
        // select2
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        // dropify for image
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush