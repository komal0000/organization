{{-- shared by teams/add and teams/edit; $member is null when adding --}}
@php
    $fields = [
        'name' => ['Name', 'fa-user', 'col-md-6', true],
        'desig' => ['Designation', 'fa-id-badge', 'col-md-6', true],
        'phone' => ['Phone', 'fa-phone', 'col-md-6', false],
        'email' => ['Email', 'fa-envelope', 'col-md-6', false],
        'address' => ['Address', 'fa-map-marker-alt', 'col-12', false],
        'linkedin' => ['LinkedIn Link', 'fa-link', 'col-md-6', false],
        'facebook' => ['Facebook Link', 'fa-link', 'col-md-6', false],
    ];
@endphp
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas {{ $member ? 'fa-user-edit' : 'fa-user-plus' }} me-2"></i>{{ $member ? 'Edit Member' : 'Add Member' }} — {{ $notice->title }}
    </div>
    <div class="admin-card-body">
        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="image" class="admin-form-label"><i class="fas fa-image me-1"></i>Photo</label>
                    <input type="file" class="form-control dropify" name="image" id="image" accept="image/*"
                        data-default-file="{{ $member && $member->image ? asset($member->image) : '' }}">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        @foreach ($fields as $name => [$label, $icon, $col, $required])
                            <div class="{{ $col }} mb-3">
                                <label for="{{ $name }}" class="admin-form-label">
                                    <i class="fas {{ $icon }} me-1"></i>{{ $label }}@if ($required) <span class="text-danger">*</span>@endif
                                </label>
                                <input type="{{ $name == 'email' ? 'email' : 'text' }}" class="form-control admin-form-control"
                                    id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $member->$name ?? '') }}" {{ $required ? 'required' : '' }}>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-admin-primary"><i class="fas fa-save me-2"></i>Save Member</button>
                <a href="{{ route('admin.team.index', ['notice' => $notice->id]) }}" class="btn btn-admin-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
