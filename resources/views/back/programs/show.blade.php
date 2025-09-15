@extends('back.layout')

@section('head-title')
    <a href="{{ route('admin.programs.index') }}">Programs</a>
    <span class="admin-breadcrumb-separator">></span>
    <span>{{ $program->title }}</span>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-edit me-1"></i>Edit Program
        </a>
        <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-info btn-sm" target="_blank">
            <i class="fas fa-external-link-alt me-1"></i>View on Site
        </a>
        <form action="{{ route('admin.programs.toggle-status', $program) }}" method="POST" style="display: inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-{{ $program->is_active ? 'warning' : 'success' }} btn-sm">
                <i class="fas fa-{{ $program->is_active ? 'pause' : 'play' }} me-1"></i>
                {{ $program->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-admin-outline btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Back to Programs
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-eye me-2"></i>Program Details
                    <div class="ms-auto">
                        <span class="badge bg-{{ $program->is_active ? 'success' : 'secondary' }}">
                            {{ $program->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($program->is_featured)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>
                </div>
                <div class="admin-card-body">
                    <!-- Featured Image -->
                    @if($program->featured_image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $program->featured_image) }}"
                                 alt="{{ $program->title }}"
                                 class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Title -->
                    <h1 class="mb-3">{{ $program->title }}</h1>

                    <!-- Short Description -->
                    <div class="alert alert-info">
                        <strong>Short Description:</strong><br>
                        {{ $program->short_description }}
                    </div>

                    <!-- Content -->
                    <div class="program-content">
                        <h5 class="border-bottom pb-2 mb-3">Program Content</h5>
                        <div class="content-body">
                            {!! $program->content !!}
                        </div>
                    </div>

                    <!-- Gallery Images -->
                    @if($program->gallery_images && count($program->gallery_images) > 0)
                        <div class="mt-4">
                            <h5 class="border-bottom pb-2 mb-3">Gallery Images</h5>
                            <div class="row">
                                @foreach($program->gallery_images as $image)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('storage/' . $image) }}"
                                             class="img-fluid rounded"
                                             style="height: 200px; width: 100%; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Program Information -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-info-circle me-2"></i>Program Information
                </div>
                <div class="admin-card-body">
                    <div class="info-item mb-3">
                        <label>Status:</label>
                        <p>
                            <span class="badge bg-{{ $program->is_active ? 'success' : 'secondary' }}">
                                {{ $program->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>

                    <div class="info-item mb-3">
                        <label>Featured:</label>
                        <p>
                            @if($program->is_featured)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star"></i> Yes
                                </span>
                            @else
                                <span class="text-muted">No</span>
                            @endif
                        </p>
                    </div>

                    <div class="info-item mb-3">
                        <label>Display Order:</label>
                        <p><span class="badge bg-info">{{ $program->order }}</span></p>
                    </div>

                    <div class="info-item mb-3">
                        <label>Slug:</label>
                        <p><code>{{ $program->slug }}</code></p>
                    </div>

                    <div class="info-item mb-3">
                        <label>Created:</label>
                        <p>{{ $program->created_at->format('M d, Y h:i A') }}</p>
                    </div>

                    <div class="info-item">
                        <label>Last Updated:</label>
                        <p>{{ $program->updated_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            @if($program->meta_title || $program->meta_description)
                <div class="admin-card mt-3">
                    <div class="admin-card-header">
                        <i class="fas fa-search me-2"></i>SEO Information
                    </div>
                    <div class="admin-card-body">
                        @if($program->meta_title)
                            <div class="info-item mb-3">
                                <label>Meta Title:</label>
                                <p>{{ $program->meta_title }}</p>
                            </div>
                        @endif

                        @if($program->meta_description)
                            <div class="info-item">
                                <label>Meta Description:</label>
                                <p>{{ $program->meta_description }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="admin-card mt-3">
                <div class="admin-card-header">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </div>
                <div class="admin-card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-admin-primary">
                            <i class="fas fa-edit me-2"></i>Edit Program
                        </a>
                        <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-info" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>View on Website
                        </a>
                        <form action="{{ route('admin.programs.toggle-status', $program) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $program->is_active ? 'warning' : 'success' }} w-100">
                                <i class="fas fa-{{ $program->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $program->is_active ? 'Deactivate Program' : 'Activate Program' }}
                            </button>
                        </form>
                        <button type="button" class="btn btn-danger w-100" onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i>Delete Program
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this program? This action cannot be undone and will also delete all associated images.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Program</button>
                    </form>
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

.content-body {
    line-height: 1.6;
}

.content-body h1, .content-body h2, .content-body h3,
.content-body h4, .content-body h5, .content-body h6 {
    color: #f4891f;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.content-body p {
    margin-bottom: 1rem;
}

.content-body ul, .content-body ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.content-body blockquote {
    border-left: 4px solid #f4891f;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 1rem;
}
</style>
@endsection

@section('js')
<script>
function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
