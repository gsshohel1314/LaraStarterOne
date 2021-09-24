@extends('layouts.backend.app')
@push('css')
    <style>
        table.view-table-custom tr th:first-child{
            width: 26%;
            text-align: right;
            font-weight: 600px;
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
            <div>Product <code>({{ $product->name }})</code> </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.product.edit', $product->id) }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-edit"></i>
                Edit
            </a>
            <a href="{{ route('app.product.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-7">
                <div class="main-card mb-3 card">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0 view-table-custom">
                            <tr>
                                <th scope="row">Product Name:</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Category:</th>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Cost Price(TK):</th>
                                <td>{{ $product->cost_price }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Retail Price(TK):</th>
                                <td>{{ $product->retail_price }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description:</th>
                                <td>{!! $product->description !!}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status:</th>
                                <td>
                                    @if ($product->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Last Modified At:</th>
                                <td>{{ $product->updated_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Created At:</th>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        
            <div class="col-md-5">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <img height="180px" width="327px" src="{{ $product->getFirstMediaUrl('image') != null ? $product->getFirstMediaUrl('image') : config('app.placeholderImage').'160.png' }}"  alt="User Image" style="border: 5px solid gray">
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Product Stock</h5>
                        <table class="table table-hover mb-0 view-table-custom">
                            <tr>
                                <th scope="row" style="width: 45%;">Current Quantity</th>
                                <th style="width: 2%;">:</th>
                                <td>{{ isset($stock->quantity) ? $stock->quantity : 0 }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection