@extends('back.layout')
@section('head-title')
    <a href="#">Registration Form</a>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('toolbar')
    <a href="{{ route('registration') }}" class="btn btn-success" target="_blank">
        <i class="fas fa-eye me-2"></i>Preview Form
    </a>
@endsection
@section('content')

    <div class="row">
        <!-- Form Details Section -->
        <div class="col-md-7 mb-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-edit me-2"></i>Edit Form Details
                </div>
                <div class="admin-card-body">
                    <form action="{{ route('admin.admin_form_update', $form->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-heading me-1"></i>Title *
                                </label>
                                <input type="text" class="form-control admin-form-control" name="title"
                                    value="{{ old('title', $form->title) }}" required>
                                @error('title')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="admin-form-label">
                                    <i class="fas fa-calendar me-1"></i>Year
                                </label>
                                <input type="text" class="form-control admin-form-control" name="year"
                                    value="{{ old('year', $form->year) }}">
                                @error('year')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Description
                            </label>
                            <textarea name="description" class="form-control admin-form-control" id="description" rows="5">{{ old('description', $form->description) }}</textarea>
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
                                    <option value="1"
                                        {{ old('is_active', $form->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0"
                                        {{ old('is_active', $form->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-save me-2"></i>Update Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Field and Fields List Section -->
        <div class="col-md-5">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-plus me-2"></i>Add New Field
                </div>
                <div class="admin-card-body">
                    <form action="{{ route('admin.admin_form_add_field', $form->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="admin-form-label">Field Type *</label>
                            <select name="type" class="form-control admin-form-control" id="fieldType" required>
                                <option value="">Select Type</option>
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="email">Email</option>
                                <option value="number">Number</option>
                                <option value="date">Date</option>
                                <option value="select">Dropdown</option>
                                <option value="radio">Radio Button</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="file">File Upload</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Label *</label>
                            <input type="text" class="form-control admin-form-control" name="label" required>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Field Name *</label>
                            <input type="text" class="form-control admin-form-control" name="name" required>
                            <small class="form-text text-muted">Use lowercase letters and underscores only</small>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Placeholder</label>
                            <input type="text" class="form-control admin-form-control" name="placeholder">
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Help Text</label>
                            <input type="text" class="form-control admin-form-control" name="help_text">
                        </div>

                        <div class="mb-3" id="optionsField" style="display: none;">
                            <label class="admin-form-label">Options (one per line)</label>
                            <textarea name="options" class="form-control admin-form-control" rows="3"
                                placeholder="Option 1&#10;Option 2&#10;Option 3"></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_required" value="1">
                            <label class="form-check-label">Required Field</label>
                        </div>

                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="fas fa-plus me-2"></i>Add Field
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form Fields List -->
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-list me-2"></i>Form Fields
                    <span class="badge bg-info ms-2">{{ $form->fields->count() }} fields</span>
                </div>
                <div class="admin-card-body">
                    @if ($form->fields->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="60">Order</th>
                                        <th>Label</th>
                                        <th width="100">Type</th>
                                        <th width="120">Name</th>
                                        <th width="80">Required</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable-fields">
                                    @foreach ($form->fields->sortBy('order') as $field)
                                        <tr data-field-id="{{ $field->id }}">
                                            <td>{{ $field->order }}</td>
                                            <td>{{ $field->label }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($field->type) }}</span>
                                            </td>
                                            <td><code>{{ $field->name }}</code></td>
                                            <td>
                                                @if ($field->is_required)
                                                    <span class="badge bg-danger">Required</span>
                                                @else
                                                    <span class="badge bg-secondary">Optional</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-admin-outline"
                                                    onclick="editField({{ $field->id }})" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="{{ route('admin.admin_form_delete_field', [$form->id, $field->id]) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-list-alt fa-3x text-muted mb-3"></i>
                            <h5>No fields added yet</h5>
                            <p class="text-muted">Add your first field using the form on the left.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
            integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
            integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/upload/trumbowyg.upload.min.js"
            integrity="sha512-0Ax7SrxNwOb0s4mFVC5Vvn1wC6ts8ysma0OyNsXEXjygtnirRYF9Eg5Z1FPfXyoVRpsslvY/AQgoBY9u4sZKSw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/fontsize/trumbowyg.fontsize.min.js"
            integrity="sha512-eFYo+lmyjqGLpIB5b2puc/HeJieqGVD+b8rviIck2DLUVuBP1ltRVjo9ccmOkZ3GfJxWqEehmoKnyqgQwxCR+g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {

                $('#description').trumbowyg({
                    autogrow: true,
                    btns: [
                        ['undo', 'redo'],
                        ['fontsize'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['link'],
                        ['upload'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                    ],
                });

            });
        </script>
@endsection
