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
                <i class="pe-7s-config icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Appearance Setting</div>
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

        <form action="{{ route('app.setting.appearance.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="site_logo">Logo (Only Image are allowed, Size: 97 x 23) <code>(key: site_logo)</code></label>
                        <input type="file" name="site_logo" id="site_logo" class="dropify form-control @error('site_logo') is-invalid @enderror" data-default-file="{{ setting('site_logo') != null ? asset('storage/'.setting('site_logo')) : ''}}">

                        @error('site_logo')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="site_favicon">Favicon (Only Image are allowed, Size: 33 x 33) <code>(key: site_favicon)</code></label>
                        <input type="file" name="site_favicon" id="site_favicon" class="dropify form-control @error('site_favicon') is-invalid @enderror" data-default-file="{{ setting('site_favicon') != null ? asset('storage/'.setting('site_favicon')) : ''}}">

                        @error('site_favicon')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    // dropify for image
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@endpush