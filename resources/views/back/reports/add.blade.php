@extends('back.layout')
@section('head-title')
    <a href="{{route('admin.reports.index')}}">Reports & Documents</a>
    <a href="#">Add</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.reports.index')}}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-plus me-2"></i>Add New Report/Document
        </div>
        <div class="admin-card-body">
            <form action="{{route('admin.reports.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="title" class="admin-form-label">
                            <i class="fas fa-heading me-1"></i>Report Title
                        </label>
                        <input type="text" class="form-control admin-form-control" id="title" name="title" placeholder="Enter report title" required>
                        @error('title')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sort_order" class="admin-form-label">
                            <i class="fas fa-sort me-1"></i>Sort Order
                        </label>
                        <input type="number" class="form-control admin-form-control" id="sort_order" name="sort_order" value="0" min="0">
                        @error('sort_order')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="admin-form-label">
                        <i class="fas fa-align-left me-1"></i>Description (Optional)
                    </label>
                    <textarea class="form-control admin-form-control" id="description" name="description" rows="3" placeholder="Enter report description (optional)"></textarea>
                    @error('description')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="document" class="admin-form-label">
                        <i class="fas fa-file me-1"></i>Document File
                    </label>
                    <input type="file" class="form-control dropify" name="document" id="document" required accept=".pdf,.doc,.docx">
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Accepted formats: PDF, DOC, DOCX | Maximum size: 10MB
                    </small>
                    @error('document')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="fas fa-save me-2"></i>Save Report
                    </button>
                    <a href="{{route('admin.reports.index')}}" class="btn btn-admin-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection