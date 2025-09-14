@extends('back.layout')
@section('head-title')
    <a href="{{route('admin.slider.index')}}">Sliders</a>
    <a href="#">Add</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.slider.index')}}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-plus me-2"></i>Add New Slider
        </div>
        <div class="admin-card-body">
            <form action="{{route('admin.slider.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="admin-form-label">
                            <i class="fas fa-heading me-1"></i>Title
                        </label>
                        <input type="text" class="form-control admin-form-control" id="title" name="title" placeholder="Enter slider title" >
                        @error('title')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="link" class="admin-form-label">
                            <i class="fas fa-link me-1"></i>Link (Optional)
                        </label>
                        <input type="url" class="form-control admin-form-control" id="link" name="link" placeholder="https://example.com">
                        @error('link')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="image" class="admin-form-label">
                            <i class="fas fa-desktop me-1"></i>Desktop Image
                        </label>
                        <input type="file" class="form-control dropify" name="image" id="image" required accept="image/*">
                        @error('image')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="mobile_image" class="admin-form-label">
                            <i class="fas fa-mobile-alt me-1"></i>Mobile Image
                        </label>
                        <input type="file" class="form-control dropify" name="mobile_image" id="mobile_image" required accept="image/*">
                        @error('mobile_image')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="subtitle" class="admin-form-label">
                        <i class="fas fa-align-left me-1"></i>Subtitle
                    </label>
                    <textarea class="form-control admin-form-control" id="subtitle" name="subtitle" rows="3" placeholder="Enter slider subtitle"></textarea>
                    @error('subtitle')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="fas fa-save me-2"></i>Save Slider
                    </button>
                    <a href="{{route('admin.slider.index')}}" class="btn btn-admin-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
