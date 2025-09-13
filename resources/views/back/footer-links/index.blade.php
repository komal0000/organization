@extends('back.layout')
@section('head-title')
    <a href="#">Footer Links</a>
    <a href="#">Manage</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-link me-2"></i>Footer Links Management
        </div>
        <a href="{{ route('admin.footer-links.create') }}" class="btn btn-admin-primary">
            <i class="fas fa-plus me-2"></i>Add New Link
        </a>
    </div>
    <div class="admin-card-body">
        @if(session('success'))
            <div class="admin-alert admin-alert-success mb-3">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($links->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th width="120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($links as $link)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $link->order }}</span>
                                </td>
                                <td class="fw-medium">{{ $link->title }}</td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                                        {{ Str::limit($link->url, 40) }}
                                        <i class="fas fa-external-link-alt ms-1 text-muted small"></i>
                                    </a>
                                </td>
                                <td>
                                    @if($link->is_active)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.footer-links.edit', $link->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="confirmDelete({{ $link->id }})" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-link fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No footer links found</h5>
                <p class="text-muted">Add your first footer link to get started.</p>
                <a href="{{ route('admin.footer-links.create') }}" class="btn btn-admin-primary">
                    <i class="fas fa-plus me-2"></i>Add First Link
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this footer link? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function confirmDelete(id) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `{{ route('admin.footer-links.index') }}/${id}`;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endsection
