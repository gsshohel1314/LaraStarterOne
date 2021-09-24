@extends('layouts.backend.app')
@push('css')
<link href="{{ asset('backend/assets/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-diskette icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Categories</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.category.create') }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create Category
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
                            <th class="text-center">Date</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Stock Type</th>
                    </thead>
                    <tbody>
                        @foreach ($stockHistory as $key => $history)
                            <tr>
                                <td class="text-center text-muted">{{ $key + 1 }}</td>
                                <td class="text-center"><code>{{ $history->date }}</code></td>
                                <td class="text-center">{{ $history->product->name }}</td>
                                <td class="text-center">{{ $history->quantity }}</td>
                                <td class="text-center">{{ $history->status }}</td>
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