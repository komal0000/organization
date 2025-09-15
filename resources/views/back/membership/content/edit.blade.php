@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.membership-content.index') }}">Membership Content</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>Edit Content Section</span>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-edit me-2"></i>Edit Content Section: {{ $membershipContent->section_name }}
                </div>
                <div class="admin-card-body">
                    <form action="{{ route('admin.membership-content.update', $membershipContent) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-heading me-1"></i>Section Name *
                                </label>
                                <input type="text" class="form-control admin-form-control"
                                       name="section_name" value="{{ old('section_name', $membershipContent->section_name) }}" required>
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
                                       name="order" value="{{ old('order', $membershipContent->order) }}" required>
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
                                   name="section_key" value="{{ old('section_key', $membershipContent->section_key) }}" required>
                            <small class="form-text text-muted">Unique identifier used in templates</small>
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
                                <option value="text" {{ old('content_type', $membershipContent->content_type) == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="textarea" {{ old('content_type', $membershipContent->content_type) == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                <option value="rich_text" {{ old('content_type', $membershipContent->content_type) == 'rich_text' ? 'selected' : '' }}>Rich Text</option>
                                <option value="image" {{ old('content_type', $membershipContent->content_type) == 'image' ? 'selected' : '' }}>Image</option>
                            </select>
                            @error('content_type')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="contentField">
                            <label class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Content
                            </label>
                            @if($membershipContent->content_type == 'textarea')
                                <textarea name="content" class="form-control admin-form-control"
                                          id="contentInput" rows="4">{{ old('content', $membershipContent->content) }}</textarea>
                            @elseif($membershipContent->content_type == 'rich_text')
                                <textarea name="content" class="form-control admin-form-control summernote"
                                          id="contentInput" rows="6">{{ old('content', $membershipContent->content) }}</textarea>
                            @else
                                <input type="{{ $membershipContent->content_type == 'image' ? 'url' : 'text' }}"
                                       class="form-control admin-form-control"
                                       name="content" value="{{ old('content', $membershipContent->content) }}"
                                       id="contentInput"
                                       @if($membershipContent->content_type == 'image') placeholder="Image URL or path" @endif>
                            @endif
                            @error('content')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-info-circle me-1"></i>Description
                            </label>
                            <textarea name="description" class="form-control admin-form-control"
                                      rows="2">{{ old('description', $membershipContent->description) }}</textarea>
                            <small class="form-text text-muted">Helper text for admin reference</small>
                            @error('description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                   {{ old('is_active', $membershipContent->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label">Active</label>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>Update Content Section
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
        $(document).ready(function() {
            // Initialize Summernote if rich text
            if ($('#contentInput').hasClass('summernote')) {
                $('.summernote').summernote({
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

        document.getElementById('contentType').addEventListener('change', function() {
            const contentField = document.getElementById('contentField');
            const contentInput = document.getElementById('contentInput');
            const type = this.value;
            const currentValue = contentInput.value;

            // Remove existing content input
            if (contentInput.classList.contains('summernote')) {
                $(contentInput).summernote('destroy');
            }
            contentInput.remove();

            let newInput;
            if (type === 'textarea') {
                newInput = document.createElement('textarea');
                newInput.className = 'form-control admin-form-control';
                newInput.name = 'content';
                newInput.id = 'contentInput';
                newInput.rows = 4;
                newInput.value = currentValue;
            } else if (type === 'rich_text') {
                newInput = document.createElement('textarea');
                newInput.className = 'form-control admin-form-control summernote';
                newInput.name = 'content';
                newInput.id = 'contentInput';
                newInput.rows = 6;
                newInput.value = currentValue;
            } else {
                newInput = document.createElement('input');
                newInput.type = type === 'image' ? 'url' : 'text';
                newInput.className = 'form-control admin-form-control';
                newInput.name = 'content';
                newInput.id = 'contentInput';
                newInput.value = currentValue;
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
    </script>
@endsection
