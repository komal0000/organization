@extends('back.layout')

@section('head-title')
    <a href="#">Registration Applications</a>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <form method="GET" action="{{ route('admin.registration-applications.index') }}" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <select name="form_id" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Forms</option>
                @foreach($forms as $form)
                    <option value="{{ $form->id }}" {{ request('form_id') == $form->id ? 'selected' : '' }}>
                        {{ $form->title }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="Search by ID or content..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-sm btn-admin-outline">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <a href="{{ route('admin.registration-applications.export') }}?{{ http_build_query(request()->all()) }}"
           class="btn btn-sm btn-success">
            <i class="fas fa-download me-1"></i>Export CSV
        </a>
    </div>
@endsection

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-list me-2"></i>Registration Applications
            <div class="ms-auto">
                <span class="badge bg-warning">{{ $applications->where('status', 'pending')->count() }} Pending</span>
                <span class="badge bg-success">{{ $applications->where('status', 'approved')->count() }} Approved</span>
                <span class="badge bg-danger">{{ $applications->where('status', 'rejected')->count() }} Rejected</span>
            </div>
        </div>
        <div class="admin-card-body">
            @if($applications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="80">ID</th>
                                <th>Form</th>
                                <th>Key Information</th>
                                <th width="100">Status</th>
                                <th width="120">Submitted</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>#{{ $application->id }}</td>
                                    <td>
                                        <strong>{{ $application->form->title }}</strong>
                                        <br><small class="text-muted">{{ $application->form->year }}</small>
                                    </td>
                                    <td>
                                        @if($application->responses)
                                            @php
                                                $keyFields = ['name', 'email', 'phone', 'first_name', 'last_name'];
                                                $displayData = [];
                                                foreach($keyFields as $key) {
                                                    if(isset($application->responses[$key]) && !empty($application->responses[$key])) {
                                                        $displayData[] = $application->responses[$key];
                                                        if(count($displayData) >= 2) break;
                                                    }
                                                }
                                            @endphp
                                            @if(count($displayData) > 0)
                                                <strong>{{ implode(' ', $displayData) }}</strong><br>
                                            @endif
                                            @if(isset($application->responses['email']))
                                                <small class="text-muted">{{ $application->responses['email'] }}</small>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'approved' => 'success',
                                                'rejected' => 'danger'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$application->status] ?? 'secondary' }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($application->submitted_at)
                                            {{ $application->submitted_at->format('M d, Y') }}<br>
                                            <small class="text-muted">{{ $application->submitted_at->format('h:i A') }}</small>
                                        @else
                                            {{ $application->created_at->format('M d, Y') }}<br>
                                            <small class="text-muted">{{ $application->created_at->format('h:i A') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.registration-applications.show', $application) }}"
                                               class="btn btn-sm btn-admin-outline">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete({{ $application->id }})">
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
                    {{ $applications->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Applications Found</h5>
                    <p class="text-muted">There are no registration applications matching your criteria.</p>
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
                    Are you sure you want to delete this application? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
function confirmDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = '{{ route("admin.registration-applications.destroy", ":id") }}'.replace(':id', id);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
