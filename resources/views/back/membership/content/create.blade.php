@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.membership-content.index') }}">Membership Content</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>Add Content Section</span>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-plus me-2"></i>Add New Content Section
                </div>
                <div class="admin-card-body">
                    <form action="{{ route('admin.membership-content.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-heading me-1"></i>Section Name *
                                </label>
                                <input type="text" class="form-control admin-form-control"
                                       name="section_name" value="{{ old('section_name') }}" required>
                                <small class="form-text text-muted">Display name shown in admin panel</small>
                                @error('section_name')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-sort me-1"></i>Order
                                </label>
                                <input type="number" class="form-control admin-form-control"
                                       name="order" value="{{ old('order', 0) }}" required>
                                @error('order')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-key me-1"></i>Section Key *
                            </label>
                            <input type="text" class="form-control admin-form-control"
                                   name="section_key" value="{{ old('section_key') }}" required>
                            <small class="form-text text-muted">Unique identifier used in templates (e.g., hero_title, benefits_content)</small>
                            @error('section_key')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-list me-1"></i>Content Type *
                            </label>
                            <select name="content_type" class="form-control admin-form-control" id="contentType" required>
                                <option value="">Select Type</option>
                                <option value="text" {{ old('content_type') == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="textarea" {{ old('content_type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                <option value="rich_text" {{ old('content_type') == 'rich_text' ? 'selected' : '' }}>Rich Text</option>
                                <option value="image" {{ old('content_type') == 'image' ? 'selected' : '' }}>Image</option>
                            </select>
                            @error('content_type')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="contentField">
                            <label class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Content
                            </label>
                            <input type="text" class="form-control admin-form-control"
                                   name="content" value="{{ old('content') }}" id="contentInput">
                            @error('content')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-info-circle me-1"></i>Description
                            </label>
                            <textarea name="description" class="form-control admin-form-control"
                                      rows="2">{{ old('description') }}</textarea>
                            <small class="form-text text-muted">Helper text for admin reference</small>
                            @error('description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label">Active</label>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>Create Content Section
                            </button>
                            <a href="{{ route('admin.membership-content.index') }}" class="btn btn-admin-outline">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        document.getElementById('contentType').addEventListener('change', function() {
            const contentField = document.getElementById('contentField');
            const contentInput = document.getElementById('contentInput');
            const type = this.value;

            // Remove existing content input
            contentInput.remove();

            let newInput;
            if (type === 'textarea') {
                newInput = document.createElement('textarea');
                newInput.className = 'form-control admin-form-control';
                newInput.name = 'content';
                newInput.id = 'contentInput';
                newInput.rows = 4;
            } else if (type === 'rich_text') {
                newInput = document.createElement('textarea');
                newInput.className = 'form-control admin-form-control summernote';
                newInput.name = 'content';
                newInput.id = 'contentInput';
                newInput.rows = 6;
            } else {
                newInput = document.createElement('input');
                newInput.type = type === 'image' ? 'url' : 'text';
                newInput.className = 'form-control admin-form-control';
                newInput.name = 'content';
                newInput.id = 'contentInput';
                if (type === 'image') {
                    newInput.placeholder = 'Image URL or path';
                }
            }

            contentField.querySelector('label').after(newInput);

            // Initialize Summernote for rich text
            if (type === 'rich_text') {
                $(newInput).summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'help']]
                    ]
                });
            }
        });

        // Auto-generate section key from section name
        document.querySelector('input[name="section_name"]').addEventListener('input', function() {
            const sectionKey = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')
                .replace(/\s+/g, '_');
            document.querySelector('input[name="section_key"]').value = sectionKey;
        });
    </script>
@endsection
