@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.footer-links.index') }}">Footer Links</a>
    <a href="#">Edit</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-edit me-2"></i>Edit Footer Link
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.footer-links.update', $link->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>Link Title
                    </label>
                    <input type="text" name="title" id="title" class="form-control admin-form-control"
                           value="{{ old('title', $link->title) }}" placeholder="Enter link title" required>
                    @error('title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="url" class="admin-form-label">
                        <i class="fas fa-link me-1"></i>Link URL
                    </label>
                    <input type="url" name="url" id="url" class="form-control admin-form-control"
                           value="{{ old('url', $link->url) }}" placeholder="https://example.com" required>
                    @error('url')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="order" class="admin-form-label">
                        <i class="fas fa-sort-numeric-up me-1"></i>Display Order
                    </label>
                    <input type="number" name="order" id="order" class="form-control admin-form-control"
                           value="{{ old('order', $link->order) }}" min="0" required>
                    @error('order')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>Lower numbers appear first
                    </small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="is_active" class="admin-form-label">
                        <i class="fas fa-toggle-on me-1"></i>Status
                    </label>
                    <select name="is_active" id="is_active" class="form-select admin-form-control" required>
                        <option value="1" {{ old('is_active', $link->is_active) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $link->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Update Footer Link
                </button>
                <a href="{{ route('admin.footer-links.index') }}" class="btn btn-admin-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
