@extends('layouts.backend.master')
@push('css')
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-lock icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Profile Security</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form action="{{ route('backend.profile.password.update') }}" method="POST">
            @csrf
            @method('PUT') 
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Update Password</h5>

                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>
        
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')

@endpush