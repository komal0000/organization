@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.essential-files.index') }}">Essential Files</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>Add New Essential File</span>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.essential-files.index') }}" class="btn btn-admin-outline btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Back to Essential Files
        </a>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.essential-files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <i class="fas fa-edit me-2"></i>Essential File Details
                    </div>
                    <div class="admin-card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="admin-form-label">File Title *</label>
                            <input type="text" name="title" class="form-control admin-form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Document Upload -->
                        <div class="mb-3">
                            <label class="admin-form-label">Document File *</label>
                            <input type="file" name="document" id="document"
                                class="dropify @error('document') is-invalid @enderror"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt"
                                data-height="200"
                                data-max-file-size="10M"
                                data-allowed-file-extensions="pdf doc docx xls xlsx ppt pptx txt"
                                required>
                            <small class="text-muted d-block mt-2">Accepted formats: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT. Maximum 10MB.</small>
                            @error('document')
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
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <strong>Active</strong>
                                    <small class="d-block text-muted">Make this file visible on the website</small>
                                </label>
                            </div>
                        </div>

                        <!-- Order -->
                        <div class="mb-3">
                            <label class="admin-form-label">Display Order *</label>
                            <input type="number" name="order" class="form-control admin-form-control @error('order') is-invalid @enderror"
                                   value="{{ old('order', 0) }}" min="0" required>
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>Create Essential File
                            </button>
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
    <!-- Dropify JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzJMcp0sgusA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            // Initialize Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a document here or click to select',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                }
            });
        });
    </script>
@endsection
