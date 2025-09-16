@extends('back.layout')
@section('head-title')
    <a href="#">Registration Form</a>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
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

    <!-- Edit Field Modal -->
    <div class="modal fade" id="editFieldModal" tabindex="-1" aria-labelledby="editFieldModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFieldModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Field
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editFieldForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="admin-form-label">Field Type *</label>
                            <select name="type" class="form-control admin-form-control" id="editFieldType" required>
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
                            <input type="text" class="form-control admin-form-control" name="label" id="editFieldLabel" required>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Field Name *</label>
                            <input type="text" class="form-control admin-form-control" name="name" id="editFieldName" required>
                            <small class="form-text text-muted">Use lowercase letters and underscores only</small>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Placeholder</label>
                            <input type="text" class="form-control admin-form-control" name="placeholder" id="editFieldPlaceholder">
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Help Text</label>
                            <input type="text" class="form-control admin-form-control" name="help_text" id="editFieldHelpText">
                        </div>

                        <div class="mb-3" id="editOptionsField" style="display: none;">
                            <label class="admin-form-label">Options (one per line)</label>
                            <textarea name="options" class="form-control admin-form-control" rows="3" id="editFieldOptions"
                                placeholder="Option 1&#10;Option 2&#10;Option 3"></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="is_required" value="1" id="editFieldRequired">
                            <label class="form-check-label">Required Field</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fas fa-save me-2"></i>Update Field
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
            integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
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

                // Show/hide options field based on field type
                $('#fieldType').change(function() {
                    const selectedType = $(this).val();
                    if (selectedType === 'select' || selectedType === 'radio' || selectedType === 'checkbox') {
                        $('#optionsField').show();
                    } else {
                        $('#optionsField').hide();
                    }
                });

                // Initialize sortable for field ordering
                if ($("#sortable-fields").length) {
                    $("#sortable-fields").sortable({
                        handle: "td:first-child",
                        update: function(event, ui) {
                            updateFieldOrder();
                        }
                    });
                }

            });

            // Function to edit field (opens a modal with AJAX data loading)
            function editField(fieldId) {
                // Fetch field data via AJAX
                $.ajax({
                    url: '{{ route("admin.admin_form_edit_field", [$form->id, "FIELD_ID"]) }}'.replace('FIELD_ID', fieldId),
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            const field = response.field;

                            // Set form action URL
                            $('#editFieldForm').attr('action', '{{ route("admin.admin_form_update_field", [$form->id, "FIELD_ID"]) }}'.replace('FIELD_ID', fieldId));

                            // Populate modal fields
                            $('#editFieldType').val(field.type);
                            $('#editFieldLabel').val(field.label);
                            $('#editFieldName').val(field.name);
                            $('#editFieldPlaceholder').val(field.placeholder || '');
                            $('#editFieldHelpText').val(field.help_text || '');
                            $('#editFieldOptions').val(field.options || '');
                            $('#editFieldRequired').prop('checked', field.is_required);

                            // Show/hide options field based on type
                            if (field.type === 'select' || field.type === 'radio' || field.type === 'checkbox') {
                                $('#editOptionsField').show();
                            } else {
                                $('#editOptionsField').hide();
                            }

                            // Show modal
                            new bootstrap.Modal(document.getElementById('editFieldModal')).show();
                        }
                    },
                    error: function() {
                        alert('Error loading field data. Please try again.');
                    }
                });
            }

            // Function to update field order via AJAX (simplified without route dependency)
            function updateFieldOrder() {
                const fieldIds = [];
                $('#sortable-fields tr').each(function(index) {
                    const fieldId = $(this).data('field-id');
                    if (fieldId) {
                        fieldIds.push({
                            id: fieldId,
                            order: index + 1
                        });
                    }
                });

                // For now, just update the visual order numbers
                // You can implement the backend route later if needed
                $('#sortable-fields tr').each(function(index) {
                    $(this).find('td:first-child').text(index + 1);
                });

                console.log('Field order updated:', fieldIds);
            }

            // Handle edit field type change in modal
            $(document).on('change', '#editFieldType', function() {
                const selectedType = $(this).val();
                if (selectedType === 'select' || selectedType === 'radio' || selectedType === 'checkbox') {
                    $('#editOptionsField').show();
                } else {
                    $('#editOptionsField').hide();
                }
            });

            // Handle form submission for editing field
            $('#editFieldForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Close modal
                        bootstrap.Modal.getInstance(document.getElementById('editFieldModal')).hide();

                        // Show success message
                        alert('Field updated successfully!');

                        // Reload page to show updated field
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Handle validation errors
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Validation errors:\n';
                            for (const field in errors) {
                                errorMessage += '- ' + errors[field][0] + '\n';
                            }
                            alert(errorMessage);
                        } else {
                            alert('Error updating field. Please try again.');
                        }
                    }
                });
            });
        </script>
@endsection
