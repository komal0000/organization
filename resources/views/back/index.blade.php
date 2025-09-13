@extends('back.layout')

@section('title')
- Dashboard
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard Overview
        </div>
        <div class="admin-card-body">
            <h4 class="text-admin-primary">Welcome to Admin Panel</h4>
            <p class="text-muted">Manage your organization's content and settings from here.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="admin-stat-card">
                <i class="fas fa-bell text-admin-primary fa-2x mb-3"></i>
                <div class="stat-number">{{ \App\Models\Notice::where('type', 1)->count() }}</div>
                <div class="stat-label">Total Notices</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="admin-stat-card" style="border-left-color: var(--admin-secondary);">
                <i class="fas fa-newspaper text-admin-secondary fa-2x mb-3"></i>
                <div class="stat-number" style="color: var(--admin-secondary);">{{ \App\Models\Notice::where('type', 2)->count() }}</div>
                <div class="stat-label">News Articles</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="admin-stat-card" style="border-left-color: var(--admin-accent);">
                <i class="fas fa-images text-admin-accent fa-2x mb-3"></i>
                <div class="stat-number" style="color: var(--admin-accent);">{{ \App\Models\Gallery::count() }}</div>
                <div class="stat-label">Gallery Items</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="admin-stat-card" style="border-left-color: #28a745;">
                <i class="fas fa-sliders-h" style="color: #28a745;" class="fa-2x mb-3"></i>
                <div class="stat-number" style="color: #28a745;">{{ \App\Models\Slider::count() }}</div>
                <div class="stat-label">Active Sliders</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-plus me-2"></i>Quick Actions
                </div>
                <div class="admin-card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <a href="{{ route('admin.notice.add', ['type' => 1]) }}" class="btn btn-admin-primary w-100">
                                <i class="fas fa-bell me-2"></i>Add Notice
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('admin.notice.add', ['type' => 2]) }}" class="btn btn-admin-secondary w-100">
                                <i class="fas fa-newspaper me-2"></i>Add News
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('admin.slider.add') }}" class="btn btn-admin-outline w-100">
                                <i class="fas fa-sliders-h me-2"></i>Add Slider
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-chart-bar me-2"></i>Recent Activity
                </div>
                <div class="admin-card-body">
                    <div class="admin-alert admin-alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        System is running smoothly
                    </div>
                    <div class="admin-alert admin-alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        All components are up to date
                    </div>
                    <div class="admin-alert admin-alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Remember to backup your data regularly
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-clock me-2"></i>Recent Content
        </div>
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Notice::latest()->take(5)->get() as $notice)
                        <tr>
                            <td>
                                <span class="badge bg-admin-primary">
                                    @if($notice->type == 1) Notice
                                    @elseif($notice->type == 2) News
                                    @elseif($notice->type == 4) Committee
                                    @elseif($notice->type == 5) Gallery
                                    @elseif($notice->type == 6) FAQ
                                    @elseif($notice->type == 7) Issue
                                    @elseif($notice->type == 8) About
                                    @endif
                                </span>
                            </td>
                            <td>{{ Str::limit($notice->title, 40) }}</td>
                            <td>{{ $notice->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.notice.edit', ['notice' => $notice->id, 'type' => $notice->type]) }}"
                                   class="btn btn-sm btn-admin-outline">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No content found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
