@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.registration-applications.index') }}">Registration Applications</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>Application #{{ $application->id }}</span>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <form action="{{ route('admin.registration-applications.update', $application) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="approved">
            <button type="submit" class="btn btn-success btn-sm"
                    {{ $application->status == 'approved' ? 'disabled' : '' }}>
                <i class="fas fa-check me-1"></i>Approve
            </button>
        </form>
        <form action="{{ route('admin.registration-applications.update', $application) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="btn btn-danger btn-sm"
                    {{ $application->status == 'rejected' ? 'disabled' : '' }}>
                <i class="fas fa-times me-1"></i>Reject
            </button>
        </form>
        <a href="{{ route('admin.registration-applications.index') }}" class="btn btn-admin-outline btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Application Details -->
        <div class="col-md-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-file-alt me-2"></i>Application Details
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger'
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$application->status] ?? 'secondary' }} ms-2">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                <div class="admin-card-body">
                    <!-- Form Information -->
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-wpforms me-2 text-primary"></i>Form Information
                    </h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Form Title:</label>
                                <p><strong>{{ $application->form->title }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Form Year:</label>
                                <p>{{ $application->form->year }}</p>
                            </div>
                        </div>
                        @if($application->form->description)
                        <div class="col-12">
                            <div class="info-item">
                                <label>Form Description:</label>
                                <p>{{ $application->form->description }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Submitted Information -->
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-user-edit me-2 text-primary"></i>Submitted Information
                    </h5>

                    @if($application->responses && count($application->responses) > 0)
                        <div class="row">
                            @foreach($application->form->fields as $field)
                                @if(isset($application->responses[$field->name]) && !empty($application->responses[$field->name]))
                                <div class="col-md-6 mb-3">
                                    <div class="info-item">
                                        <label>{{ $field->label }}:</label>
                                        <p>
                                            @if($field->type === 'file')
                                                @if(file_exists(storage_path('app/public/' . $application->responses[$field->name])))
                                                    <a href="{{ asset('storage/' . $application->responses[$field->name]) }}"
                                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-download me-1"></i>
                                                        {{ basename($application->responses[$field->name]) }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">File not found: {{ basename($application->responses[$field->name]) }}</span>
                                                @endif
                                            @elseif($field->type === 'email')
                                                <a href="mailto:{{ $application->responses[$field->name] }}">
                                                    {{ $application->responses[$field->name] }}
                                                </a>
                                            @elseif($field->type === 'phone')
                                                <a href="tel:{{ $application->responses[$field->name] }}">
                                                    {{ $application->responses[$field->name] }}
                                                </a>
                                            @elseif($field->type === 'textarea')
                                                <div class="border p-2 bg-light rounded">
                                                    {!! nl2br(e($application->responses[$field->name])) !!}
                                                </div>
                                            @else
                                                {{ $application->responses[$field->name] }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No submitted information available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Application Management -->
        <div class="col-md-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-cog me-2"></i>Application Status
                </div>
                <div class="admin-card-body">
                    <div class="info-item mb-3">
                        <label>Current Status:</label>
                        <p>
                            <span class="badge bg-{{ $statusColors[$application->status] ?? 'secondary' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </p>
                    </div>

                    <div class="info-item mb-3">
                        <label>Submitted:</label>
                        <p>
                            @if($application->submitted_at)
                                {{ $application->submitted_at->format('M d, Y h:i A') }}
                            @else
                                {{ $application->created_at->format('M d, Y h:i A') }}
                            @endif
                        </p>
                    </div>

                    <div class="info-item mb-4">
                        <label>Application ID:</label>
                        <p><code>#{{ $application->id }}</code></p>
                    </div>

                    <form action="{{ route('admin.registration-applications.update', $application) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="admin-form-label">Update Status:</label>
                            <select name="status" class="form-control admin-form-control">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Admin Notes:</label>
                            <textarea name="admin_notes" class="form-control admin-form-control"
                                      rows="4" placeholder="Add notes about this application...">{{ $application->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-admin-primary w-100">
                            <i class="fas fa-save me-2"></i>Update Application
                        </button>
                    </form>
                </div>
            </div>

            <!-- Technical Information -->
            <div class="admin-card mt-3">
                <div class="admin-card-header">
                    <i class="fas fa-info-circle me-2"></i>Technical Details
                </div>
                <div class="admin-card-body">
                    <div class="info-item mb-2">
                        <label>IP Address:</label>
                        <p><code>{{ $application->ip_address }}</code></p>
                    </div>

                    <div class="info-item mb-2">
                        <label>User Agent:</label>
                        <p class="small text-muted">{{ $application->user_agent }}</p>
                    </div>

                    <div class="info-item">
                        <label>Created:</label>
                        <p>{{ $application->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
.info-item {
    margin-bottom: 15px;
}

.info-item label {
    font-weight: 600;
    color: #495057;
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

.info-item p {
    margin: 0;
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

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
</style>
