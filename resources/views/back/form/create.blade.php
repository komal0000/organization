@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.admin_form_index') }}">Forms</a>
    <a href="#">Create</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.admin_form_index') }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-plus me-2"></i>Create New Form
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.admin_form_store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>Title *
                    </label>
                    <input type="text" class="form-control admin-form-control" name="title" value="{{ old('title') }}" placeholder="Enter form title" required>
                    @error('title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="admin-form-label">
                        <i class="fas fa-calendar me-1"></i>Year
                    </label>
                    <input type="text" class="form-control admin-form-control" name="year" value="{{ old('year', date('Y')) }}" placeholder="Enter year">
                    @error('year')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="admin-form-label">
                    <i class="fas fa-align-left me-1"></i>Description
                </label>
                <textarea name="description" class="form-control admin-form-control" rows="3" placeholder="Enter form description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="admin-form-label">
                        <i class="fas fa-toggle-on me-1"></i>Status
                    </label>
                    <select name="is_active" class="form-control admin-form-control">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Create Form
                </button>
                <a href="{{ route('admin.admin_form_index') }}" class="btn btn-admin-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
