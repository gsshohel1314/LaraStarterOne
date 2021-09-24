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
                <i class="pe-7s-keypad icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>{{ isset($product) ? 'Edit' : 'Create' }} Product</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.product.index') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form id="productForm" action="{{ isset($product) ? route('app.product.update', $product->id) : route('app.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($product)
                @method('PUT') 
            @endisset
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Product Info</h5>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="js-example-basic-single form-control @error('category') is-invalid @enderror" required>
                                    <option value="">Select Product Category</option>
                                    @foreach ($categories as $key=>$category)
                                        <option value="{{ $category->id }}" @isset($product) {{ $product->category->id == $category->id ? 'selected' : '' }} @endisset>{{ $category->name }}</option>
                                    @endforeach
                                </select>
        
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name ?? old('name') }}" required>
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" >{{ $product->description ?? old('description') }}</textarea>
        
                                @error('description')
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
                            <h5 class="card-title">Select image and status</h5>
                            <div class="form-group">
                                <label for="cost_price">Cost Price</label>
                                <input id="cost_price" type="number" class="form-control @error('cost_price') is-invalid @enderror" name="cost_price" value="{{ $product->cost_price ?? old('cost_price') }}" required>
        
                                @error('cost_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="retail_price">Retail Price</label>
                                <input id="retail_price" type="number" class="form-control @error('retail_price') is-invalid @enderror" name="retail_price" value="{{ $product->retail_price ?? old('retail_price') }}" required>
        
                                @error('retail_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image (Only Image are allowed)</label>
                                <input type="file" name="image" id="image" class="dropify form-control @error('image') is-invalid @enderror" data-default-file="{{ isset($product) ? $product->getFirstMediaUrl('image') : ''}}" {{ !isset($product) ? 'required' : '' }}>
        
                                @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($product) {{ $product->status == true ? 'checked' : '' }} @endisset>
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>

                                @error('status')
                                    <span class="invalid-feedback" image="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-danger" onClick="resetForm('productForm')">
                                <i class="fas fa-redo"></i>
                                <span>Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary">
                                @isset($product)
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
    {{-- tinymce texteditor --}}
    <script src="https://cdn.tiny.cloud/1/hnw6vxzbuyy2zto6dc5lerqrny6rk6wot6ln9wh39mo3jvpo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_advtab: true,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            importcss_append: true,
            height: 300,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });
    </script>
@endpush