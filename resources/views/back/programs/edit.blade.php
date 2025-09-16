@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.programs.index') }}">Programs</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>{{ isset($program) ? 'Edit Program' : 'Add New Program' }}</span>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.programs.index') }}" class="btn btn-admin-outline btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Back to Programs
        </a>
        @if(isset($program))
            <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-info btn-sm" target="_blank">
                <i class="fas fa-external-link-alt me-1"></i>View on Site
            </a>
        @endif
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.programs.update', $program) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <i class="fas fa-edit me-2"></i>Program Details
                    </div>
                    <div class="admin-card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="admin-form-label">Program Title *</label>
                            <input type="text" name="title" class="form-control admin-form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $program->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label class="admin-form-label">Short Description *</label>
                            <textarea name="short_description" class="form-control admin-form-control @error('short_description') is-invalid @enderror"
                                      rows="3" maxlength="500" required>{{ old('short_description', $program->short_description ?? '') }}</textarea>
                            <small class="text-muted">Maximum 500 characters. This will be shown in program listings.</small>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label class="admin-form-label">Program Content *</label>
                            <textarea name="content" id="content" class="form-control admin-form-control @error('content') is-invalid @enderror"
                                      rows="15">{{ old('content', $program->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="admin-card mt-3">
                    <div class="admin-card-header">
                        <i class="fas fa-search me-2"></i>SEO Settings
                    </div>
                    <div class="admin-card-body">
                        <!-- Meta Title -->
                        <div class="mb-3">
                            <label class="admin-form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control admin-form-control @error('meta_title') is-invalid @enderror"
                                   value="{{ old('meta_title', $program->meta_title ?? '') }}" maxlength="255">
                            <small class="text-muted">Leave empty to use program title. Maximum 255 characters.</small>
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Meta Description -->
                        <div class="mb-3">
                            <label class="admin-form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control admin-form-control @error('meta_description') is-invalid @enderror"
                                      rows="3" maxlength="500">{{ old('meta_description', $program->meta_description ?? '') }}</textarea>
                            <small class="text-muted">Leave empty to use short description. Maximum 500 characters.</small>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Publish Settings -->
                <div class="admin-card">
                    <div class="admin-card-header">
                        <i class="fas fa-cog me-2"></i>Publish Settings
                    </div>
                    <div class="admin-card-body">
                        <!-- Status -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                       {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <strong>Active</strong>
                                    <small class="d-block text-muted">Make this program visible on the website</small>
                                </label>
                            </div>
                        </div>

                        <!-- Featured -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured"
                                       {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <strong>Featured</strong>
                                    <small class="d-block text-muted">Show this program in featured sections</small>
                                </label>
                            </div>
                        </div>

                        <!-- Order -->
                        <div class="mb-3">
                            <label class="admin-form-label">Display Order *</label>
                            <input type="number" name="order" class="form-control admin-form-control @error('order') is-invalid @enderror"
                                   value="{{ old('order', $program->order ?? 0) }}" min="0" required>
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>{{ isset($program) ? 'Update Program' : 'Create Program' }}
                            </button>
                            @if(isset($program))
                                <a href="{{ route('admin.programs.show', $program) }}" class="btn btn-admin-outline">
                                    <i class="fas fa-eye me-2"></i>View Program
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="admin-card mt-3">
                    <div class="admin-card-header">
                        <i class="fas fa-image me-2"></i>Featured Image
                    </div>
                    <div class="admin-card-body">
                        <div class="mb-3">
                            <input type="file" name="featured_image" id="featured_image"
                                class="dropify @error('featured_image') is-invalid @enderror"
                                accept="image/*"
                                data-height="200"
                                data-max-file-size="5M"
                                data-allowed-file-extensions="jpg jpeg png gif"
                                @if(isset($program) && $program->featured_image)
                                    data-default-file="{{ asset('storage/' . $program->featured_image) }}"
                                @endif>
                            <small class="text-muted d-block mt-2">JPG, PNG, GIF. Maximum 5MB.</small>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('css')
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
          integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .admin-form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .admin-form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 12px;
        }

        .admin-form-control:focus {
            border-color: #f4891f;
            box-shadow: 0 0 0 0.2rem rgba(244, 137, 31, 0.25);
        }

        /* Dropify customization */
        .dropify-wrapper {
            border: 2px dashed #ddd;
            border-radius: 8px;
        }

        .dropify-wrapper:hover {
            border-color: #f4891f;
        }

        .dropify-wrapper .dropify-message p {
            color: #666;
            font-size: 14px;
        }
    </style>
@endsection

@section('js')
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <!-- Dropify JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzJMcp0sgusA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            let editorInstance;

            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#content'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ]
                })
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });

            // Initialize Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop an image here or click to select',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                }
            });

            // Form validation
            $('form').on('submit', function(e) {
                // Update the textarea with CKEditor content
                if (editorInstance) {
                    const content = editorInstance.getData();
                    $('#content').val(content);

                    // Check if content is empty
                    if (!content.trim()) {
                        e.preventDefault();
                        alert('Program content is required.');
                        editorInstance.editing.view.focus();
                        return false;
                    }
                }
            });
        });
    </script>
@endsection
