@extends('layouts.backend.app')
@push('css')
<style>
    /* first row delete button disable css */
    .disabled {
    pointer-events: none;
    cursor: default;
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
            <div>{{ isset($stock) ? 'Edit' : 'Create' }} Stock</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.stock.index') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form id="stockForm" action="{{ isset($stock) ? route('app.stock.update', $stock->id) : route('app.stock.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($stock)
                @method('PUT') 
            @endisset
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-warning"><i class="fa fa-info-circle"></i></a>
                                    </td>
                                    <td>
                                        <select name="category_id[]" class="form-control @error('category_id') is-invalid @enderror productcategory" id="prod_cat_id">
                                            <option>Select One</option>
                                            @foreach($categories as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="product_id[]" class="form-control @error('product_id') is-invalid @enderror productname">
                                            <option value="0" disabled="true" selected="true">Select One</option>
                                        </select>
                                        @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror                                      
                                    </td>
                                    <td>
                                        <input name="quantity[]" type="number" class="form-control @error('quantity') is-invalid @enderror" value=" ">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </td>
                                    <td>
                                        <a href="#" class="btn-Delete btn btn-danger disabled"><i class="fa fa-minus"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                    </td>
                                    <td>
                                        <a href="javascript:0" id="btn-add" class="btn btn-success"> <i class="fa fa-plus"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-danger" onClick="resetForm('stockForm')">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        @isset($stock)
                            <i class="fas fa-arrow-circle-up"></i>
                            Update
                        @else
                            <i class="fas fa-plus-circle"></i>
                            Create
                        @endisset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('js')
    <script>
        // This code not work in custom js because $foreach loop get data just add page.controller not send data in custom js page. 
        $('#btn-add').click(function() {
            $('#myTable').append(
                '<tr><td><a href="#" class="btn btn-warning"><i class="fa fa-info-circle"></i></a></td><td><select name="category_id[]" class="form-control @error('category_id') is-invalid @enderror productcategory" id="prod_cat_id"><option>Select One</option>@foreach($categories as $value)<option value="{{ $value->id }}">{{ $value->name }}</option>@endforeach</select>@error('category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><select name="product_id[]" class="form-control @error('product_id') is-invalid @enderror productname"><option value="0" disabled="true" selected="true">Select One</option></select>@error('product_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><input name="quantity[]" type="number" class="form-control @error('quantity') is-invalid @enderror" value=" ">@error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><a href="#" class="btn-Delete btn btn-danger disabled"><i class="fa fa-minus"></i></a></td></tr>'
            )
        });
    </script>

    <script>
        // table row add and remove
        $("#myTable").on('click', '.btn-Delete', function () {
            $(this).closest('tr').remove();
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
    
            $(document).on('change','.productcategory',function(){
                // console.log("changed");
    
                var cat_id=$(this).val();
                // console.log(cat_id);
                var a=$(this).parent().parent();
    
                var op=" ";
    
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('app/findProductName')!!}',
                    data:{'id':cat_id},
                    success:function(data){
                        // console.log('success');
                        // console.log(data);
                        // console.log(data.length);

                        op+='<option value="0" disabled="true" selected="true">Select One</option>';
                        for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                       }
    
                       a.find('.productname').html(" ");
                       a.find('.productname').append(op);
                    },
                    error:function(){
    
                    }
                });
            });
    
            // $(document).on('change','.productname',function () {
            //     var prod_id=$(this).val();
    
            //     var a=$(this).parent();
            //     console.log(prod_id);
            //     var op="";
            //     $.ajax({
            //         type:'get',
            //         url:'{!!URL::to('findPrice')!!}',
            //         data:{'id':prod_id},
            //         dataType:'json',//return data will be json
            //         success:function(data){
            //             console.log("price");
            //             console.log(data.price);
    
            //             // here price is coloumn name in products table data.coln name
    
            //             a.find('.prod_price').val(data.price);
    
            //         },
            //         error:function(){
    
            //         }
            //     });
    
    
            // });
    
        });
    </script>
@endpush