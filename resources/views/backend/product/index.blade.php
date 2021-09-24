@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-keypad icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Products</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.product.create') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create Product
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="table-responsive">
                <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Cost Price</th>
                            <th class="text-center">Retail Price</th>
                            {{-- <th class="text-center">Description</th> --}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Joined At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td class="text-center text-muted">{{ $key + 1 }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" height="40" class="rounded-circle" 
                                                    src="{{ $product->getFirstMediaUrl('image') != null ? $product->getFirstMediaUrl('image') : config('app.placeholderImage').'160.png' }}" alt="Product Image">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"> {{ $product->name }} </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $product->cost_price }}</td>
                                <td class="text-center">{{ $product->retail_price }}</td>
                                {{-- <td class="text-center">{{ Str::limit($product->description, 20) }}</td> --}}
                                <td class="text-center">
                                    @if ($product->status == true)
                                        <span class="badge badge-info">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $product->created_at->diffForHumans() }}</td>

                                <td class="text-center">
                                    <a href="{{ route('app.product.show', $product->id) }}"class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                        <span>Show</span>
                                    </a>

                                    <a href="{{ route('app.product.edit', $product->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deleteData({{ $product->id }})"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Delete</span>
                                    </button>
                                    <form id="delete-form-{{ $product->id }}" method="POST" action="{{ route('app.product.destroy', $product->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('backend/assets/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endpush