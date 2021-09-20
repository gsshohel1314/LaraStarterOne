@extends('layouts.backend.app')
@push('css')
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
                <i class="pe-7s-user icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Profile</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form id="profileForm" action="{{ route('app.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="row">
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Profile Image</h5>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="dropify form-control @error('image') is-invalid @enderror" data-default-file="{{ Auth::user()->getFirstMediaUrl('image') ?? '' }}">
        
                                @error('image')
                                    <span class="text-danger" image="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">User Info</h5>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required>
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <button type="button" class="btn btn-danger" onClick="resetForm('profileForm')">
                                <i class="fas fa-redo"></i>
                                <span>Reset</span>
                            </button>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        // dropify for image
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush