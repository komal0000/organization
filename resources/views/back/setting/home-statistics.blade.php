@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Home Statistics</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-chart-line me-2"></i>Home Statistics Settings
    </div>
    <div class="admin-card-body">
        @if(session('message'))
            <div class="admin-alert admin-alert-success mb-3">
                <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.setting.home-statistics') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="section_title" class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>Section Title
                    </label>
                    <input type="text" name="section_title" id="section_title" class="form-control admin-form-control"
                           value="{{ old('section_title', $data->section_title ?? 'Our Impact') }}" placeholder="Enter section title">
                    @error('section_title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="section_subtitle" class="admin-form-label">
                        <i class="fas fa-text-height me-1"></i>Section Subtitle
                    </label>
                    <input type="text" name="section_subtitle" id="section_subtitle" class="form-control admin-form-control"
                           value="{{ old('section_subtitle', $data->section_subtitle ?? 'Making a difference together') }}" placeholder="Enter subtitle">
                    @error('section_subtitle')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Statistics -->
            <div class="mb-4">
                <label class="admin-form-label">
                    <i class="fas fa-chart-bar me-1"></i>Statistics Counters
                </label>
                <div id="statistics-container">
                    @if(isset($data->statistics) && count($data->statistics) > 0)
                        @foreach($data->statistics as $index => $statistic)
                            <div class="statistic-item admin-card mb-3">
                                <div class="admin-card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chart-line me-2"></i>Statistic {{ $index + 1 }}
                                    </h6>
                                    <button type="button" class="btn btn-sm btn-admin-danger remove-statistic">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="admin-card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="admin-form-label">Title</label>
                                            <input type="text" name="statistics[{{ $index }}][title]" class="form-control admin-form-control"
                                                   value="{{ $statistic->title ?? '' }}" placeholder="e.g., Volunteers">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="admin-form-label">Value</label>
                                            <input type="number" name="statistics[{{ $index }}][value]" class="form-control admin-form-control"
                                                   value="{{ $statistic->value ?? '' }}" placeholder="e.g., 150" min="0">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="admin-form-label">Icon (Font Awesome)</label>
                                            <input type="text" name="statistics[{{ $index }}][icon]" class="form-control admin-form-control"
                                                   value="{{ $statistic->icon ?? 'fas fa-chart-line' }}" placeholder="fas fa-chart-line">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="statistic-item admin-card mb-3">
                            <div class="admin-card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-chart-line me-2"></i>Statistic 1
                                </h6>
                                <button type="button" class="btn btn-sm btn-admin-danger remove-statistic">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="admin-card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Title</label>
                                        <input type="text" name="statistics[0][title]" class="form-control admin-form-control"
                                               placeholder="e.g., Volunteers" value="Volunteers">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Value</label>
                                        <input type="number" name="statistics[0][value]" class="form-control admin-form-control"
                                               placeholder="e.g., 150" value="150" min="0">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Icon (Font Awesome)</label>
                                        <input type="text" name="statistics[0][icon]" class="form-control admin-form-control"
                                               value="fas fa-users" placeholder="fas fa-users">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="statistic-item admin-card mb-3">
                            <div class="admin-card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-chart-line me-2"></i>Statistic 2
                                </h6>
                                <button type="button" class="btn btn-sm btn-admin-danger remove-statistic">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="admin-card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Title</label>
                                        <input type="text" name="statistics[1][title]" class="form-control admin-form-control"
                                               placeholder="e.g., Total Projects" value="Total Projects">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Value</label>
                                        <input type="number" name="statistics[1][value]" class="form-control admin-form-control"
                                               placeholder="e.g., 72" value="72" min="0">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Icon (Font Awesome)</label>
                                        <input type="text" name="statistics[1][icon]" class="form-control admin-form-control"
                                               value="fas fa-project-diagram" placeholder="fas fa-project-diagram">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="statistic-item admin-card mb-3">
                            <div class="admin-card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-chart-line me-2"></i>Statistic 3
                                </h6>
                                <button type="button" class="btn btn-sm btn-admin-danger remove-statistic">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="admin-card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Title</label>
                                        <input type="text" name="statistics[2][title]" class="form-control admin-form-control"
                                               placeholder="e.g., Completed Projects" value="Completed Projects">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Value</label>
                                        <input type="number" name="statistics[2][value]" class="form-control admin-form-control"
                                               placeholder="e.g., 64" value="64" min="0">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="admin-form-label">Icon (Font Awesome)</label>
                                        <input type="text" name="statistics[2][icon]" class="form-control admin-form-control"
                                               value="fas fa-check-circle" placeholder="fas fa-check-circle">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" id="add-statistic" class="btn btn-admin-secondary">
                    <i class="fas fa-plus me-1"></i> Add Another Statistic
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
                    <i class="fas fa-save me-2"></i>Save Statistics Settings
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
    let statisticIndex = {{ isset($data->statistics) ? count($data->statistics) : 3 }};

    // Add new statistic
    document.getElementById('add-statistic').addEventListener('click', function() {
        const container = document.getElementById('statistics-container');
        const newStatistic = document.createElement('div');
        newStatistic.className = 'statistic-item admin-card mb-3';
        newStatistic.innerHTML = `
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>Statistic ${statisticIndex + 1}
                </h6>
                <button type="button" class="btn btn-sm btn-admin-danger remove-statistic">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="admin-card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="admin-form-label">Title</label>
                        <input type="text" name="statistics[${statisticIndex}][title]" class="form-control admin-form-control"
                               placeholder="e.g., Volunteers">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="admin-form-label">Value</label>
                        <input type="number" name="statistics[${statisticIndex}][value]" class="form-control admin-form-control"
                               placeholder="e.g., 150" min="0">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="admin-form-label">Icon (Font Awesome)</label>
                        <input type="text" name="statistics[${statisticIndex}][icon]" class="form-control admin-form-control"
                               value="fas fa-chart-line" placeholder="fas fa-chart-line">
                    </div>
                </div>
            </div>
        `;
        container.appendChild(newStatistic);
        statisticIndex++;
    });

    // Remove statistic
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-statistic')) {
            const statisticItem = e.target.closest('.statistic-item');
            if (document.querySelectorAll('.statistic-item').length > 1) {
                statisticItem.remove();
                // Update numbering
                document.querySelectorAll('.statistic-item').forEach((item, index) => {
                    const header = item.querySelector('.admin-card-header h6');
                    header.innerHTML = `<i class="fas fa-chart-line me-2"></i>Statistic ${index + 1}`;
                });
            } else {
                alert('At least one statistic is required.');
            }
        }
    });
});
</script>
@endsection
