@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Home Objectives</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-bullseye me-2"></i>Home Objectives Settings
    </div>
    <div class="admin-card-body">
        @if(session('message'))
            <div class="admin-alert admin-alert-success mb-3">
                <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.setting.home-objectives') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="section_title" class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>Section Title
                    </label>
                    <input type="text" name="section_title" id="section_title" class="form-control admin-form-control"
                           value="{{ old('section_title', $data->section_title ?? 'Our Objectives') }}" placeholder="Enter section title">
                    @error('section_title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="section_subtitle" class="admin-form-label">
                        <i class="fas fa-text-height me-1"></i>Section Subtitle
                    </label>
                    <input type="text" name="section_subtitle" id="section_subtitle" class="form-control admin-form-control"
                           value="{{ old('section_subtitle', $data->section_subtitle ?? 'What we aim to achieve') }}" placeholder="Enter subtitle">
                    @error('section_subtitle')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Objectives -->
            <div class="mb-4">
                <label class="admin-form-label">
                    <i class="fas fa-list me-1"></i>Objectives
                </label>
                <div id="objectives-container">
                    @if(isset($data->objectives) && count($data->objectives) > 0)
                        @foreach($data->objectives as $index => $objective)
                            <div class="objective-item admin-card mb-3">
                                <div class="admin-card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <i class="fas fa-bullseye me-2"></i>Objective {{ $index + 1 }}
                                    </h6>
                                    <button type="button" class="btn btn-sm btn-admin-danger remove-objective">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="admin-card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="admin-form-label">Title</label>
                                            <input type="text" name="objectives[{{ $index }}][title]" class="form-control admin-form-control"
                                                   value="{{ $objective->title ?? '' }}" placeholder="Objective Title">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="admin-form-label">Icon (Font Awesome)</label>
                                            <input type="text" name="objectives[{{ $index }}][icon]" class="form-control admin-form-control"
                                                   value="{{ $objective->icon ?? 'fas fa-bullseye-arrow' }}" placeholder="fas fa-bullseye-arrow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="objective-item admin-card mb-3">
                            <div class="admin-card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-bullseye me-2"></i>Objective 1
                                </h6>
                                <button type="button" class="btn btn-sm btn-admin-danger remove-objective">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="admin-card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="admin-form-label">Title</label>
                                        <input type="text" name="objectives[0][title]" class="form-control admin-form-control"
                                               placeholder="Objective Title">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="admin-form-label">Icon (Font Awesome)</label>
                                        <input type="text" name="objectives[0][icon]" class="form-control admin-form-control"
                                               value="fas fa-bullseye-arrow" placeholder="fas fa-bullseye-arrow">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" id="add-objective" class="btn btn-admin-secondary">
                    <i class="fas fa-plus me-1"></i> Add Another Objective
                </button>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
                               {{ old('is_active', $data->is_active ?? 1) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label admin-form-label">
                            <i class="fas fa-eye me-1"></i>Show on Homepage
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Save Objectives Settings
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let objectiveIndex = {{ isset($data->objectives) ? count($data->objectives) : 1 }};

    // Add new objective
    document.getElementById('add-objective').addEventListener('click', function() {
        const container = document.getElementById('objectives-container');
        const newObjective = document.createElement('div');
        newObjective.className = 'objective-item admin-card mb-3';
        newObjective.innerHTML = `
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-bullseye me-2"></i>Objective ${objectiveIndex + 1}
                </h6>
                <button type="button" class="btn btn-sm btn-admin-danger remove-objective">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="admin-card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="admin-form-label">Title</label>
                        <input type="text" name="objectives[${objectiveIndex}][title]" class="form-control admin-form-control"
                               placeholder="Objective Title">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="admin-form-label">Icon (Font Awesome)</label>
                        <input type="text" name="objectives[${objectiveIndex}][icon]" class="form-control admin-form-control"
                               value="fas fa-bullseye-arrow" placeholder="fas fa-bullseye-arrow">
                    </div>
                </div>
            </div>
        `;
        container.appendChild(newObjective);
        objectiveIndex++;
    });

    // Remove objective
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-objective')) {
            const objectiveItem = e.target.closest('.objective-item');
            if (document.querySelectorAll('.objective-item').length > 1) {
                objectiveItem.remove();
                // Update numbering
                document.querySelectorAll('.objective-item').forEach((item, index) => {
                    const header = item.querySelector('.admin-card-header h6');
                    header.innerHTML = `<i class="fas fa-bullseye me-2"></i>Objective ${index + 1}`;
                });
            } else {
                alert('At least one objective is required.');
            }
        }
    });
});
</script>
@endsection
