@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>User <code>({{ $user->name }})</code> </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('app.user.edit', $user->id) }}" class="btn-shadow mr-3 btn btn-primary">
                <i class="fa fa-edit"></i>
                Edit
            </a>
            <a href="{{ route('app.user.index') }}" class="btn-shadow mr-3 btn btn-danger">
                <i class="fa fa-arrow-circle-left"></i>
                Back to list
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <img src="{{ $user->getFirstMediaUrl('image') != null ? $user->getFirstMediaUrl('image') : config('app.placeholderImage').'160.png' }}" class="img-fluid img-thumbnail" alt="User Image">
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="main-card mb-3 card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <tr>
                        <th scope="row">Name:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Role:</th>
                        <td>
                            @if ($user->role)
                                <span class="badge badge-info">{{ $user->role->name }}</span>
                            @else
                                <span class="badge badge-danger">No role found.</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Status:</th>
                        <td>
                            @if ($user->status == true)
                                <span class="badge badge-info">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Last Modified At:</th>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Joined At:</th>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection