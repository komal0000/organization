@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.membership-applications.index') }}">Membership Applications</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>Application #{{ $membership->id }}</span>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <form action="{{ route('admin.membership-applications.update', $membership) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="approved">
            <button type="submit" class="btn btn-success btn-sm"
                    {{ $membership->status == 'approved' ? 'disabled' : '' }}>
                <i class="fas fa-check me-1"></i>Approve
            </button>
        </form>
        <form action="{{ route('admin.membership-applications.update', $membership) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <button type="submit" class="btn btn-danger btn-sm"
                    {{ $membership->status == 'rejected' ? 'disabled' : '' }}>
                <i class="fas fa-times me-1"></i>Reject
            </button>
        </form>
        <a href="{{ route('admin.membership-applications.index') }}" class="btn btn-admin-outline btn-sm">
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
                    <i class="fas fa-user me-2"></i>Application Details
                    <span class="badge bg-{{ $membership->status_badge }} ms-2">{{ ucfirst($membership->status) }}</span>
                </div>
                <div class="admin-card-body">
                    <!-- Personal Information -->
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-user-circle me-2 text-primary"></i>Personal Information
                    </h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Full Name:</label>
                                <p>{{ $membership->full_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Email:</label>
                                <p><a href="mailto:{{ $membership->email }}">{{ $membership->email }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Phone Number:</label>
                                <p><a href="tel:{{ $membership->phone_number }}">{{ $membership->phone_number }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Nepali Citizen:</label>
                                <p>{{ $membership->nepali_citizen ? ucfirst($membership->nepali_citizen) : 'Not specified' }}</p>
                            </div>
                        </div>
                        @if($membership->residential_area)
                            <div class="col-md-12">
                                <div class="info-item">
                                    <label>Residential Area:</label>
                                    <p>{{ $membership->residential_area }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Additional Information -->
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-info-circle me-2 text-success"></i>Additional Information
                    </h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Chapter Applying For:</label>
                                <p>{{ $membership->chapter_applying_for ?: 'Not specified' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Marital Status:</label>
                                <p>{{ $membership->marital_status ? ucfirst($membership->marital_status) : 'Not specified' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Sector:</label>
                                <p>{{ $membership->sector ?: 'Not specified' }}</p>
                            </div>
                        </div>
                        @if($membership->academic_qualification)
                            <div class="col-md-12">
                                <div class="info-item">
                                    <label>Academic Qualification:</label>
                                    <p>{{ $membership->academic_qualification }}</p>
                                </div>
                            </div>
                        @endif
                        @if($membership->organization_member)
                            <div class="col-md-12">
                                <div class="info-item">
                                    <label>Other Organization Memberships:</label>
                                    <p>{{ $membership->organization_member }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Organization Details -->
                    <h5 class="border-bottom pb-2 mb-3">
                        <i class="fas fa-building me-2 text-info"></i>Organization Details
                    </h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>City:</label>
                                <p>{{ $membership->city ?: 'Not specified' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label>Number of Employees:</label>
                                <p>{{ $membership->number_of_employees ?: 'Not specified' }}</p>
                            </div>
                        </div>
                        @if($membership->address)
                            <div class="col-md-12">
                                <div class="info-item">
                                    <label>Address:</label>
                                    <p>{{ $membership->address }}</p>
                                </div>
                            </div>
                        @endif
                        @if($membership->website)
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label>Website:</label>
                                    <p><a href="{{ $membership->website }}" target="_blank">{{ $membership->website }}</a></p>
                                </div>
                            </div>
                        @endif
                        @if($membership->organization_telephone)
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label>Organization Telephone:</label>
                                    <p><a href="tel:{{ $membership->organization_telephone }}">{{ $membership->organization_telephone }}</a></p>
                                </div>
                            </div>
                        @endif
                        @if($membership->organization_email)
                            <div class="col-md-12">
                                <div class="info-item">
                                    <label>Organization Email:</label>
                                    <p><a href="mailto:{{ $membership->organization_email }}">{{ $membership->organization_email }}</a></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Status and Actions -->
        <div class="col-md-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-cog me-2"></i>Application Status
                </div>
                <div class="admin-card-body">
                    <div class="info-item mb-3">
                        <label>Current Status:</label>
                        <p><span class="badge bg-{{ $membership->status_badge }}">{{ ucfirst($membership->status) }}</span></p>
                    </div>

                    <div class="info-item mb-3">
                        <label>Submitted:</label>
                        <p>{{ $membership->submitted_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <div class="info-item mb-4">
                        <label>Application ID:</label>
                        <p><code>#{{ $membership->id }}</code></p>
                    </div>

                    <form action="{{ route('admin.membership-applications.update', $membership) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="admin-form-label">Update Status:</label>
                            <select name="status" class="form-control admin-form-control">
                                <option value="pending" {{ $membership->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="approved" {{ $membership->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $membership->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="admin-form-label">Admin Notes:</label>
                            <textarea name="admin_notes" class="form-control admin-form-control"
                                      rows="4" placeholder="Add notes about this application...">{{ $membership->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-admin-primary w-100">
                            <i class="fas fa-save me-2"></i>Update Application
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Actions -->
            <div class="admin-card mt-3">
                <div class="admin-card-header">
                    <i class="fas fa-envelope me-2"></i>Quick Actions
                </div>
                <div class="admin-card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $membership->email }}" class="btn btn-admin-outline">
                            <i class="fas fa-envelope me-2"></i>Send Email
                        </a>
                        <a href="tel:{{ $membership->phone_number }}" class="btn btn-admin-outline">
                            <i class="fas fa-phone me-2"></i>Call Applicant
                        </a>
                        @if($membership->organization_email && $membership->organization_email != $membership->email)
                            <a href="mailto:{{ $membership->organization_email }}" class="btn btn-admin-outline">
                                <i class="fas fa-building me-2"></i>Email Organization
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<style>
    .info-item {
        margin-bottom: 15px;
    }

    .info-item label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
        display: block;
        font-size: 14px;
    }

    .info-item p {
        margin: 0;
        color: #333;
        word-wrap: break-word;
    }

    .info-item a {
        color: #f4891f;
        text-decoration: none;
    }

    .info-item a:hover {
        text-decoration: underline;
    }
</style>
@endsection
