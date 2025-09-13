@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Vision, Goals & Mission</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-eye me-2"></i>Vision, Goals & Mission Settings
    </div>
    <div class="admin-card-body">
        @if(session('message'))
            <div class="admin-alert admin-alert-success mb-3">
                <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.setting.home-vision-goals-mission') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="section_title" class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>Section Title
                    </label>
                    <input type="text" name="section_title" id="section_title" class="form-control admin-form-control"
                           value="{{ old('section_title', $data->section_title ?? 'Vision, Mission & Goals') }}" placeholder="Enter section title">
                    @error('section_title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="section_subtitle" class="admin-form-label">
                        <i class="fas fa-text-height me-1"></i>Section Subtitle
                    </label>
                    <input type="text" name="section_subtitle" id="section_subtitle" class="form-control admin-form-control"
                           value="{{ old('section_subtitle', $data->section_subtitle ?? 'Our direction and purpose') }}" placeholder="Enter subtitle">
                    @error('section_subtitle')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Vision Section -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-eye me-2 text-primary"></i>Vision
                    </h6>
                </div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="vision_title" class="admin-form-label">
                                <i class="fas fa-heading me-1"></i>Vision Title
                            </label>
                            <input type="text" name="vision_title" id="vision_title" class="form-control admin-form-control"
                                   value="{{ old('vision_title', $data->vision_title ?? 'Our Vision') }}" placeholder="Enter vision title">
                            @error('vision_title')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="vision_description" class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Vision Description
                            </label>
                            <textarea name="vision_description" id="vision_description" class="form-control admin-form-control" rows="4"
                                      placeholder="Enter vision description">{{ old('vision_description', $data->vision_description ?? 'Our vision for the future.') }}</textarea>
                            @error('vision_description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission Section -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-rocket me-2 text-success"></i>Mission
                    </h6>
                </div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="mission_title" class="admin-form-label">
                                <i class="fas fa-heading me-1"></i>Mission Title
                            </label>
                            <input type="text" name="mission_title" id="mission_title" class="form-control admin-form-control"
                                   value="{{ old('mission_title', $data->mission_title ?? 'Our Mission') }}" placeholder="Enter mission title">
                            @error('mission_title')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="mission_description" class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Mission Description
                            </label>
                            <textarea name="mission_description" id="mission_description" class="form-control admin-form-control" rows="4"
                                      placeholder="Enter mission description">{{ old('mission_description', $data->mission_description ?? 'Our core mission and approach.') }}</textarea>
                            @error('mission_description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goals Section -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-target me-2 text-warning"></i>Goals
                    </h6>
                </div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="goals_title" class="admin-form-label">
                                <i class="fas fa-heading me-1"></i>Goals Title
                            </label>
                            <input type="text" name="goals_title" id="goals_title" class="form-control admin-form-control"
                                   value="{{ old('goals_title', $data->goals_title ?? 'Our Goals') }}" placeholder="Enter goals title">
                            @error('goals_title')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="goals_description" class="admin-form-label">
                                <i class="fas fa-align-left me-1"></i>Goals Description
                            </label>
                            <textarea name="goals_description" id="goals_description" class="form-control admin-form-control" rows="4"
                                      placeholder="Enter goals description">{{ old('goals_description', $data->goals_description ?? 'Our specific goals and targets.') }}</textarea>
                            @error('goals_description')
                                <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
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
                    <i class="fas fa-save me-2"></i>Save Vision, Goals & Mission Settings
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
