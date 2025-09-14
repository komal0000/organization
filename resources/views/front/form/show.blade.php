@extends('front.layout')

@section('title', ' - ' . $form->title)

@section('css')
<style>
/* Google Forms Style */
.google-form {
    max-width: 760px;
    margin: 40px auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 8px 8px 0 0;
    text-align: center;
}

.form-header h1 {
    font-size: 2rem;
    font-weight: 300;
    margin: 0 0 10px 0;
}

.form-header p {
    opacity: 0.9;
    margin: 0;
    font-size: 1rem;
}

.form-content {
    padding: 0;
}

.form-description {
    padding: 24px;
    background: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
    margin: 0;
    font-size: 14px;
    line-height: 1.5;
}

.question-block {
    padding: 24px;
    border-bottom: 1px solid #e0e0e0;
    background: white;
}

.question-block:last-of-type {
    border-bottom: none;
}

.question-label {
    font-size: 16px;
    font-weight: 400;
    color: #202124;
    margin-bottom: 8px;
    display: block;
}

.required-asterisk {
    color: #d93025;
    margin-left: 4px;
}

.form-input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #dadce0;
    padding: 8px 0;
    font-size: 16px;
    background: transparent;
    transition: border-color 0.2s;
    outline: none;
}

.form-input:focus {
    border-bottom: 2px solid #1a73e8;
}

.form-input::placeholder {
    color: #5f6368;
    font-style: italic;
}

.form-textarea {
    width: 100%;
    border: 1px solid #dadce0;
    border-radius: 4px;
    padding: 12px;
    font-size: 16px;
    resize: vertical;
    min-height: 100px;
    outline: none;
    transition: border-color 0.2s;
}

.form-textarea:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 0 1px #1a73e8;
}

.form-select {
    width: 100%;
    border: 1px solid #dadce0;
    border-radius: 4px;
    padding: 12px;
    font-size: 16px;
    outline: none;
    background: white;
    transition: border-color 0.2s;
}

.form-select:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 0 1px #1a73e8;
}

.radio-group, .checkbox-group {
    margin-top: 12px;
}

.radio-item, .checkbox-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    padding: 8px 0;
}

.radio-item input, .checkbox-item input {
    margin-right: 12px;
    accent-color: #1a73e8;
}

.radio-item label, .checkbox-item label {
    margin: 0;
    font-weight: normal;
    cursor: pointer;
    flex: 1;
}

.file-upload {
    border: 2px dashed #dadce0;
    border-radius: 4px;
    padding: 24px;
    text-align: center;
    transition: border-color 0.2s;
}

.file-upload:hover {
    border-color: #1a73e8;
}

.file-upload input[type="file"] {
    display: none;
}

.file-upload-label {
    cursor: pointer;
    color: #1a73e8;
    font-weight: 500;
}

.help-text {
    font-size: 12px;
    color: #5f6368;
    margin-top: 8px;
}

.form-actions {
    padding: 24px;
    background: #f8f9fa;
    border-radius: 0 0 8px 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.submit-btn {
    background: #1a73e8;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.submit-btn:hover {
    background: #1557b0;
}

.clear-btn {
    background: none;
    color: #1a73e8;
    border: none;
    padding: 12px 24px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.clear-btn:hover {
    background: #f1f3f4;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    border-radius: 4px;
    padding: 12px 16px;
    margin: 16px 24px;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
    padding: 12px 16px;
    margin: 16px 24px;
}

.invalid-feedback {
    color: #d93025;
    font-size: 12px;
    margin-top: 4px;
}

@media (max-width: 768px) {
    .google-form {
        margin: 20px 16px;
    }

    .form-header {
        padding: 24px 16px;
    }

    .form-header h1 {
        font-size: 1.5rem;
    }

    .question-block {
        padding: 16px;
    }

    .form-actions {
        padding: 16px;
        flex-direction: column;
        gap: 12px;
    }
}
</style>
@endsection

@section('content')
<div class="google-form">
    <!-- Form Header -->
    <div class="form-header">
        <h1>{{ $form->title }}</h1>
        @if($form->year)
            <p>{{ $form->year }}</p>
        @endif
    </div>

    <!-- Form Content -->
    <div class="form-content">
        @if($form->description)
            <div class="form-description">
                {!! $form->description !!}
            </div>
        @endif

        @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-danger">
                <strong>Please correct the following errors:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="registrationForm" action="{{ route('forms.submit', $form->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach($form->fields as $field)
                <div class="question-block">
                    <label for="{{ $field->name }}" class="question-label">
                        {{ $field->label }}
                        @if($field->is_required)
                            <span class="required-asterisk">*</span>
                        @endif
                    </label>

                    @switch($field->type)
                        @case('text')
                        @case('email')
                        @case('number')
                        @case('date')
                            <input
                                type="{{ $field->type }}"
                                name="{{ $field->name }}"
                                id="{{ $field->name }}"
                                class="form-input @error($field->name) is-invalid @enderror"
                                value="{{ old($field->name) }}"
                                {{ $field->is_required ? 'required' : '' }}
                                @if($field->placeholder) placeholder="{{ $field->placeholder }}" @endif
                            >
                            @break

                        @case('textarea')
                            <textarea
                                name="{{ $field->name }}"
                                id="{{ $field->name }}"
                                class="form-textarea @error($field->name) is-invalid @enderror"
                                {{ $field->is_required ? 'required' : '' }}
                                @if($field->placeholder) placeholder="{{ $field->placeholder }}" @endif
                            >{{ old($field->name) }}</textarea>
                            @break

                        @case('select')
                            <select
                                name="{{ $field->name }}"
                                id="{{ $field->name }}"
                                class="form-select @error($field->name) is-invalid @enderror"
                                {{ $field->is_required ? 'required' : '' }}
                            >
                                <option value="">Choose an option</option>
                                @if($field->options)
                                    @foreach($field->options as $option)
                                        <option value="{{ $option }}" {{ old($field->name) == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @break

                        @case('radio')
                            @if($field->options)
                                <div class="radio-group">
                                    @foreach($field->options as $option)
                                        <div class="radio-item">
                                            <input
                                                type="radio"
                                                name="{{ $field->name }}"
                                                id="{{ $field->name }}_{{ $loop->index }}"
                                                value="{{ $option }}"
                                                {{ old($field->name) == $option ? 'checked' : '' }}
                                                {{ $field->is_required ? 'required' : '' }}
                                            >
                                            <label for="{{ $field->name }}_{{ $loop->index }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @break

                        @case('checkbox')
                            @if($field->options)
                                <div class="checkbox-group">
                                    @foreach($field->options as $option)
                                        <div class="checkbox-item">
                                            <input
                                                type="checkbox"
                                                name="{{ $field->name }}[]"
                                                id="{{ $field->name }}_{{ $loop->index }}"
                                                value="{{ $option }}"
                                                {{ is_array(old($field->name)) && in_array($option, old($field->name)) ? 'checked' : '' }}
                                            >
                                            <label for="{{ $field->name }}_{{ $loop->index }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @break

                        @case('file')
                            <div class="file-upload">
                                <input
                                    type="file"
                                    name="{{ $field->name }}"
                                    id="{{ $field->name }}"
                                    {{ $field->is_required ? 'required' : '' }}
                                >
                                <label for="{{ $field->name }}" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>
                                    Choose file or drag it here
                                </label>
                            </div>
                            @break
                    @endswitch

                    @if($field->help_text)
                        <div class="help-text">{{ $field->help_text }}</div>
                    @endif

                    @error($field->name)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="clear-btn" onclick="clearForm()">
                    Clear form
                </button>
                <button type="submit" class="submit-btn">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function clearForm() {
    if (confirm('Are you sure you want to clear all form data?')) {
        document.getElementById('registrationForm').reset();

        // Clear any validation errors
        document.querySelectorAll('.is-invalid').forEach(function(element) {
            element.classList.remove('is-invalid');
        });

        // Clear error messages
        document.querySelectorAll('.invalid-feedback').forEach(function(element) {
            element.style.display = 'none';
        });

        // Show confirmation
        alert('Form cleared successfully!');
    }
}

// File upload enhancement
document.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('change', function() {
        const label = this.nextElementSibling;
        if (this.files.length > 0) {
            label.innerHTML = '<i class="fas fa-check me-2"></i>' + this.files[0].name;
            label.style.color = '#34a853';
        } else {
            label.innerHTML = '<i class="fas fa-cloud-upload-alt me-2"></i>Choose file or drag it here';
            label.style.color = '#1a73e8';
        }
    });
});

// Enhanced form validation
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    let isValid = true;

    // Check required fields
    this.querySelectorAll('[required]').forEach(function(field) {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
    }
});
</script>
@endsection
