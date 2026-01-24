@extends('back.layout')
@section('head-title')
    <a href="{{route('admin.startups.index')}}">Startup Database</a>
    <a href="#">Edit</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.startups.index')}}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-edit me-2"></i>Edit Startup
        </div>
        <div class="admin-card-body">
            <form action="{{route('admin.startups.edit', ['startup' => $startup->id])}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_of_firm" class="admin-form-label">
                            <i class="fas fa-building me-1"></i>Name of the Firm <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control admin-form-control" id="name_of_firm" name="name_of_firm" placeholder="Enter firm name" value="{{old('name_of_firm', $startup->name_of_firm)}}" required>
                        @error('name_of_firm')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="project_name" class="admin-form-label">
                            <i class="fas fa-project-diagram me-1"></i>Project Name
                        </label>
                        <input type="text" class="form-control admin-form-control" id="project_name" name="project_name" placeholder="Enter project name" value="{{old('project_name', $startup->project_name)}}">
                        @error('project_name')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="year_of_operation" class="admin-form-label">
                            <i class="fas fa-calendar me-1"></i>Year of Operation <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control admin-form-control" id="year_of_operation" name="year_of_operation" placeholder="e.g., 2023" value="{{old('year_of_operation', $startup->year_of_operation)}}" required>
                        @error('year_of_operation')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="size_of_company" class="admin-form-label">
                            <i class="fas fa-users me-1"></i>Size of Company <span class="text-danger">*</span>
                        </label>
                        <select class="form-control admin-form-control" id="size_of_company" name="size_of_company" required>
                            <option value="">Select Size</option>
                            <option value="Less than 10" {{old('size_of_company', $startup->size_of_company) == 'Less than 10' ? 'selected' : ''}}>Less than 10</option>
                            <option value="10-50" {{old('size_of_company', $startup->size_of_company) == '10-50' ? 'selected' : ''}}>10-50</option>
                            <option value="51 or Above" {{old('size_of_company', $startup->size_of_company) == '51 or Above' ? 'selected' : ''}}>51 or Above</option>
                        </select>
                        @error('size_of_company')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="location_of_firm" class="admin-form-label">
                            <i class="fas fa-map-marker-alt me-1"></i>Location of Firm <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control admin-form-control" id="location_of_firm" name="location_of_firm" placeholder="Enter location" value="{{old('location_of_firm', $startup->location_of_firm)}}" required>
                        @error('location_of_firm')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="gender_of_entrepreneurs" class="admin-form-label">
                            <i class="fas fa-user me-1"></i>Gender of Entrepreneurs <span class="text-danger">*</span>
                        </label>
                        <select class="form-control admin-form-control" id="gender_of_entrepreneurs" name="gender_of_entrepreneurs" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{old('gender_of_entrepreneurs', $startup->gender_of_entrepreneurs) == 'Male' ? 'selected' : ''}}>Male</option>
                            <option value="Female" {{old('gender_of_entrepreneurs', $startup->gender_of_entrepreneurs) == 'Female' ? 'selected' : ''}}>Female</option>
                            <option value="Other" {{old('gender_of_entrepreneurs', $startup->gender_of_entrepreneurs) == 'Other' ? 'selected' : ''}}>Other</option>
                        </select>
                        @error('gender_of_entrepreneurs')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="status_of_firm" class="admin-form-label">
                            <i class="fas fa-toggle-on me-1"></i>Status of Firm <span class="text-danger">*</span>
                        </label>
                        <select class="form-control admin-form-control" id="status_of_firm" name="status_of_firm" required>
                            <option value="Active" {{old('status_of_firm', $startup->status_of_firm) == 'Active' ? 'selected' : ''}}>Active</option>
                            <option value="Inactive" {{old('status_of_firm', $startup->status_of_firm) == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                            <option value="Closed" {{old('status_of_firm', $startup->status_of_firm) == 'Closed' ? 'selected' : ''}}>Closed</option>
                        </select>
                        @error('status_of_firm')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="sector" class="admin-form-label">
                            <i class="fas fa-industry me-1"></i>Sector (Optional)
                        </label>
                        <input type="text" class="form-control admin-form-control" id="sector" name="sector" placeholder="e.g., Technology, Healthcare, Education" value="{{old('sector', $startup->sector)}}">
                        @error('sector')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="fas fa-save me-2"></i>Update Startup
                    </button>
                    <a href="{{route('admin.startups.index')}}" class="btn btn-admin-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
