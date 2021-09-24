@extends('layouts.backend.app')
@push('css')

@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($category) ? 'Edit' : 'Create' }} Category</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.category.index') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form id="categoryForm" action="{{ isset($category) ? route('app.category.update', $category->id) : route('app.category.store') }}" method="POST">
            @csrf
            @isset($category)
                @method('PUT') 
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Category Info</h5>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name ?? old('name') }}" required autofocus>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Select status</h5>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($category) {{ $category->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>

                                @error('status')
                                    <span class="invalid-feedback" image="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-danger" onClick="resetForm('categoryForm')">
                                <i class="fas fa-redo"></i>
                                <span>Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary">
                                @isset($category)
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
    
@endpush