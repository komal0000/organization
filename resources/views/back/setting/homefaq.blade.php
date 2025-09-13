
@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Home FAQ</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-question-circle me-2"></i>Home FAQ Settings
    </div>
    <div class="admin-card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>FAQ Section Title
                    </label>
                    <input type="text" id="title" name="title" class="form-control admin-form-control" value="{{ old('title', $data->title ?? '') }}" placeholder="Enter FAQ section title">
                    @error('title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="subtitle" class="admin-form-label">
                        <i class="fas fa-text-height me-1"></i>FAQ Subtitle
                    </label>
                    <input type="text" id="subtitle" name="subtitle" class="form-control admin-form-control" value="{{ old('subtitle', $data->subtitle ?? '') }}" placeholder="Enter FAQ subtitle">
                    @error('subtitle')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="semi" class="admin-form-label">
                        <i class="fas fa-align-left me-1"></i>Description Text
                    </label>
                    <textarea id="semi" name="semi" class="form-control admin-form-control" rows="3" placeholder="Enter FAQ description text">{{ old('semi', $data->semi ?? '') }}</textarea>
                    @error('semi')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="bottom_text" class="admin-form-label">
                        <i class="fas fa-align-center me-1"></i>Bottom Text
                    </label>
                    <textarea id="bottom_text" name="bottom_text" class="form-control admin-form-control" rows="3" placeholder="Enter bottom text for FAQ section">{{ old('bottom_text', $data->bottom_text ?? '') }}</textarea>
                    @error('bottom_text')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Save FAQ Settings
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
