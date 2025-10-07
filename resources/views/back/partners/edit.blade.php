@extends('back.layout')
@section('head-title')
    <a href="{{route('admin.partners.index')}}">Partners</a>
    <a href="#">Edit</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.partners.index')}}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-edit me-2"></i>Edit Partner
        </div>
        <div class="admin-card-body">
            <form action="{{route('admin.partners.edit',['partner'=>$partner->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="admin-form-label">
                            <i class="fas fa-building me-1"></i>Partner Name
                        </label>
                        <input type="text" class="form-control admin-form-control" id="name" name="name" placeholder="Enter partner name" value="{{$partner->name}}" required>
                        @error('name')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="link" class="admin-form-label">
                            <i class="fas fa-link me-1"></i>Website Link (Optional)
                        </label>
                        <input type="url" class="form-control admin-form-control" id="link" name="link" placeholder="https://example.com" value="{{$partner->link}}">
                        @error('link')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="image" class="admin-form-label">
                            <i class="fas fa-image me-1"></i>Partner Logo/Image
                        </label>
                        <input type="file" class="form-control dropify" name="image" id="image" accept="image/*" data-default-file="{{asset($partner->image)}}">
                        @error('image')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sort_order" class="admin-form-label">
                            <i class="fas fa-sort me-1"></i>Sort Order
                        </label>
                        <input type="number" class="form-control admin-form-control" id="sort_order" name="sort_order" value="{{$partner->sort_order}}" min="0">
                        @error('sort_order')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="fas fa-save me-2"></i>Update Partner
                    </button>
                    <a href="{{route('admin.partners.index')}}" class="btn btn-admin-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection