@extends('back.layout')

@section('head-title')
    <a href="#">Programs</a>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.programs.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add New Program
        </a>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleOrderMode()">
            <i class="fas fa-sort me-1"></i>Reorder Programs
        </button>
    </div>
@endsection

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-list me-2"></i>Programs List
            <div class="ms-auto">
                <span class="badge bg-success">{{ $programs->where('is_active', true)->count() }} Active</span>
                <span class="badge bg-secondary">{{ $programs->where('is_active', false)->count() }} Inactive</span>
            </div>
        </div>
        <div class="admin-card-body">
            @if($programs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="programsTable">
                        <thead>
                            <tr>
                                <th width="50" class="order-handle" style="display:none;">
                                    <i class="fas fa-grip-vertical"></i>
                                </th>
                                <th width="80">Image</th>
                                <th>Title</th>
                                <th width="120">Order</th>
                                <th width="100">Status</th>
                                <th width="100">Featured</th>
                                <th width="120">Created</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-programs">
                            @foreach($programs as $program)
                                <tr data-id="{{ $program->id }}">
                                    <td class="order-handle text-center" style="display:none;">
                                        <i class="fas fa-grip-vertical text-muted"></i>
                                    </td>
                                    <td>
                                        @if($program->featured_image)
                                            <img src="{{ asset('storage/' . $program->featured_image) }}"
                                                 alt="{{ $program->title }}"
                                                 class="img-thumbnail"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $program->title }}</strong>
                                        <br><small class="text-muted">{{ Str::limit($program->short_description, 50) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $program->order }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $program->is_active ? 'success' : 'secondary' }}">
                                            {{ $program->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($program->is_featured)
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $program->created_at->format('M d, Y') }}<br>
                                        <small class="text-muted">{{ $program->created_at->format('h:i A') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.programs.show', $program) }}"
                                               class="btn btn-sm btn-admin-outline" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.programs.edit', $program) }}"
                                               class="btn btn-sm btn-admin-outline" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('programs.show', $program->slug) }}"
                                               class="btn btn-sm btn-info" title="View on Site" target="_blank">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.programs.toggle-status', $program) }}"
                                                  method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-sm btn-{{ $program->is_active ? 'warning' : 'success' }}"
                                                        title="{{ $program->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $program->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete({{ $program->id }})" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $programs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Programs Found</h5>
                    <p class="text-muted">Start by creating your first program.</p>
                    <a href="{{ route('admin.programs.create') }}" class="btn btn-admin-primary">
                        <i class="fas fa-plus me-2"></i>Add New Program
                    </a>
                </div>
            @endif
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
                    Are you sure you want to delete this program? This action cannot be undone and will also delete associated images.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
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
.order-mode .order-handle {
    display: table-cell !important;
}

.sortable-ghost {
    opacity: 0.4;
}

.sortable-chosen {
    background-color: #f8f9fa;
}

.order-handle {
    cursor: grab;
}

.order-handle:active {
    cursor: grabbing;
}
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
let orderMode = false;
let sortable = null;

function toggleOrderMode() {
    orderMode = !orderMode;
    const table = document.getElementById('programsTable');
    const handles = document.querySelectorAll('.order-handle');

    if (orderMode) {
        table.classList.add('order-mode');
        handles.forEach(handle => handle.style.display = 'table-cell');

        // Initialize sortable
        sortable = Sortable.create(document.getElementById('sortable-programs'), {
            handle: '.order-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            onEnd: function(evt) {
                updateProgramOrder();
            }
        });

        document.querySelector('[onclick="toggleOrderMode()"]').innerHTML =
            '<i class="fas fa-save me-1"></i>Save Order';
    } else {
        table.classList.remove('order-mode');
        handles.forEach(handle => handle.style.display = 'none');

        if (sortable) {
            sortable.destroy();
            sortable = null;
        }

        document.querySelector('[onclick="toggleOrderMode()"]').innerHTML =
            '<i class="fas fa-sort me-1"></i>Reorder Programs';
    }
}

function updateProgramOrder() {
    const rows = document.querySelectorAll('#sortable-programs tr');
    const programs = [];

    rows.forEach((row, index) => {
        programs.push({
            id: row.dataset.id,
            order: index + 1
        });
    });

    fetch('{{ route("admin.programs.update-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ programs: programs })
    })
    .then(response => response.json())
    .then(data => {
        // Update order badges
        rows.forEach((row, index) => {
            const badge = row.querySelector('.badge.bg-info');
            if (badge) {
                badge.textContent = index + 1;
            }
        });
    })
    .catch(error => {
        console.error('Error updating order:', error);
    });
}

function confirmDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = '{{ route("admin.programs.destroy", ":id") }}'.replace(':id', id);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
