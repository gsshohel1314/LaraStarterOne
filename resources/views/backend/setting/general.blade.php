@extends('layouts.backend.app')
@push('css')

@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-config icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>General Setting</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        @include('backend.setting.sidebar')
    </div>

    <div class="col-9">
        {{-- How to use callout --}}
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">How to use:</h5>
                <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code></p>
            </div>
        </div>

        <form id="generalForm" action="{{ route('app.setting.general.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="site_title">Site Title <code>(key: site_title)</code></label>
                        <input id="site_title" type="text" class="form-control @error('site_title') is-invalid @enderror" name="site_title" value="{{ setting('site_title') ?? old('site_title') }}" required>

                        @error('site_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="site_description">Site Description <code>(key: site_description)</code></label>
                        <textarea name="site_description" id="site_description" class="form-control @error('site_description') is-invalid @enderror">{{ setting('site_description') ?? old('site_description') }}</textarea>

                        @error('site_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="site_address">Site Address <code>(key: site_address)</code></label>
                        <textarea name="site_address" id="site_address" class="form-control @error('site_address') is-invalid @enderror">{{ setting('site_address') ?? old('site_address') }}</textarea>

                        @error('site_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="button" class="btn btn-danger" onClick="resetForm('generalForm')">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
    
@endpush