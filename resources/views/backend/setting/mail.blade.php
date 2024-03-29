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
            <div>Mail Setting</div>
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

        <form id="mailForm" action="{{ route('app.setting.mail.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mail_mailer">Mail Mailer <code>(key: mail_mailer)</code></label>
                                <input id="mail_mailer" type="text" class="form-control @error('mail_mailer') is-invalid @enderror" name="mail_mailer" value="{{ setting('mail_mailer') ?? old('mail_mailer') }}" placeholder="ex: smtp" required>
        
                                @error('mail_mailer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="mail_encryption">Mail Encryption <code>(key: mail_encryption)</code></label>
                                <input id="mail_encryption" type="text" class="form-control @error('mail_encryption') is-invalid @enderror" name="mail_encryption" value="{{ setting('mail_encryption') ?? old('mail_encryption') }}" placeholder="ex: tls" required>
        
                                @error('mail_encryption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mail_host">Mail Host <code>(key: mail_host)</code></label>
                                <input id="mail_host" type="text" class="form-control @error('mail_host') is-invalid @enderror" name="mail_host" value="{{ setting('mail_host') ?? old('mail_host') }}" placeholder="ex: smtp.mailtrap.io" required>
        
                                @error('mail_host')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="mail_port">Mail Port <code>(key: mail_port)</code></label>
                                <input id="mail_port" type="text" class="form-control @error('mail_port') is-invalid @enderror" name="mail_port" value="{{ setting('mail_port') ?? old('mail_port') }}" placeholder="ex: 2525" required>
        
                                @error('mail_port')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mail_username">Mail Username <code>(key: mail_username)</code></label>
                                <input id="mail_username" type="text" class="form-control @error('mail_username') is-invalid @enderror" name="mail_username" value="{{ setting('mail_username') ?? old('mail_username') }}" placeholder="Username" required>
        
                                @error('mail_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="mail_password">Mail Password <code>(key: mail_password)</code></label>
                                <input id="mail_password" type="password" class="form-control @error('mail_password') is-invalid @enderror" name="mail_password" value="{{ setting('mail_password') ?? old('mail_password') }}" placeholder="Password" required>
        
                                @error('mail_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mail_from_address">Mail From Address <code>(key: mail_from_address)</code></label>
                                <input id="mail_from_address" type="email" class="form-control @error('mail_from_address') is-invalid @enderror" name="mail_from_address" value="{{ setting('mail_from_address') ?? old('mail_from_address') }}" placeholder="From Address" required>
        
                                @error('mail_from_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="mail_from_name">Mail From Name <code>(key: mail_from_name)</code></label>
                                <input id="mail_from_name" type="text" class="form-control @error('mail_from_name') is-invalid @enderror" name="mail_from_name" value="{{ setting('mail_from_name') ?? old('mail_from_name') }}" placeholder="Form Name" required>
        
                                @error('mail_from_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" onClick="resetForm('mailForm')">
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