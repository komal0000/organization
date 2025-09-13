@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Meta Information</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-info-circle me-2"></i>Meta Information Settings
    </div>
    <div class="admin-card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="admin-form-label">
                        <i class="fas fa-building me-1"></i>Organization Name
                    </label>
                    <input type="text" name="title" class="form-control admin-form-control" value="{{$data->title??""}}" placeholder="Enter organization name" required>
                    @error('title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="description" class="admin-form-label">
                        <i class="fas fa-file-alt me-1"></i>Organization Description
                    </label>
                    <textarea name="description" class="form-control admin-form-control" rows="4" placeholder="Enter organization description" required>{!! $data->description??"" !!}</textarea>
                    @error('description')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="feature_image" class="admin-form-label">
                        <i class="fas fa-image me-1"></i>Feature Image
                    </label>
                    <input type="file" class="form-control dropify" name="feature_image" id="feature_image" accept="image/*"
                      @if(isset($data->feature_image))
                        data-default-file="{{asset($data->feature_image)}}"
                      @else
                        required
                      @endif>
                    @error('feature_image')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Save Meta Information
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')


@endsection
