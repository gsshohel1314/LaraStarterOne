@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Menu Builder ({{ $menuId->name }})</div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.menus.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>

            <a href="{{ route('app.menus.item.create', $menuId->id) }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                Create Menu Item
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">How to use:</h5>
                <p>You can output a menu anywhere on your site by calling <code>menu('name')</code></p>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body menu-builder">
                <h5 class="card-title">Drag and drop the menu Items below to re-arrange them.</h5>
                <div class="dd">
                    <ol>
                        @forelse ($menuId->menuItems as $item)
                            <li>
                                <span>{{ $item->title }}</span>
                            </li>
                        @empty
                        <div class="text-center">
                            <strong>No menu item found</strong>
                        </div>
                        @endforelse
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection