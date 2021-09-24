@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/select2/select2.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-keypad icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Manage Stock</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form id="manageStockForm" action="{{ route('app.manage.stock.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Stock Info</h5>
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select name="product_id" id="product_id" class="js-example-basic-single form-control productname @error('product_id') is-invalid @enderror" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
        
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" required>
        
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label >Current Quantity</label>
                                <input type="number" name="" value="00" class="form-control prod_quantity" readonly>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Update Quantity</label>
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required>
        
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Stock Type</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="in">IN</option>
                                    <option value="out">OUT</option>
                                </select>
        
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-danger" onClick="resetForm('manageStockForm')">
                                <i class="fas fa-redo"></i>
                                <span>Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-arrow-circle-up"></i>
                                    Create
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.productname',function () {
            var prod_id=$(this).val();
            // console.log("prod_id");

            var a=$(this).parent().parent();
            // console.log("a");

            $.ajax({
                type:'get',
                url:'{!!URL::to('app/findProductQuantity')!!}',
                data:{'id':prod_id},
                dataType:'json',//return data will be json
                success:function(data){
                    // console.log("success");
                    a.find('.prod_quantity').val(data.quantity);
                },
                error:function(){

                }
            });
        });
    });
</script>
@endpush