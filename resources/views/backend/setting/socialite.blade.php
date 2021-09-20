@extends('layouts.backend.master')
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
            <div>Socialite Setting</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        @include('backend.setting.sidebar')
    </div>

    <div class="col-9">
        <form action="{{ route('backend.setting.socialite.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="main-card mb-3 card">
                <div class="card-body">
                    
                    <div class="form-group">
                        <label for="google_client_id">Google Client Id</label>
                        <input id="google_client_id" type="text" class="form-control @error('google_client_id') is-invalid @enderror" name="google_client_id" value="{{ setting('google_client_id') ?? old('google_client_id') }}" placeholder="Client Id">

                        @error('google_client_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="google_client_secret">Google Client Secret</label>
                        <input id="google_client_secret" type="text" class="form-control @error('google_client_secret') is-invalid @enderror" name="google_client_secret" value="{{ setting('google_client_secret') ?? old('google_client_secret') }}" placeholder="Client Secret">

                        @error('google_client_secret')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="github_client_id">Github Client Id</label>
                        <input id="github_client_id" type="text" class="form-control @error('github_client_id') is-invalid @enderror" name="github_client_id" value="{{ setting('github_client_id') ?? old('github_client_id') }}" placeholder="Client Id">

                        @error('github_client_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="github_client_secret">Github Client Secret</label>
                        <input id="github_client_secret" type="text" class="form-control @error('github_client_secret') is-invalid @enderror" name="github_client_secret" value="{{ setting('github_client_secret') ?? old('github_client_secret') }}" placeholder="Client Secret">

                        @error('github_client_secret')
                            <span class="invalid-feedback" role="alert">
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
    
@endpush