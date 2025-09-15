@extends('back.layout')

@section('head-title')
    <a href="#">Membership Applications</a>
@endsection

@section('toolbar')
    <div class="d-flex gap-2">
        <form method="GET" action="{{ route('admin.membership-applications.index') }}" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="Search by name or email..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-sm btn-admin-outline">
                <i class="fas fa-search"></i>
            </button>
            @if(request('status') || request('search'))
                <a href="{{ route('admin.membership-applications.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            @endif
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-users me-2"></i>Membership Applications
                    <span class="badge bg-info ms-2">{{ $memberships->total() }} total</span>
                    <div class="ms-auto d-flex gap-2">
                        <span class="badge bg-warning">{{ $memberships->where('status', 'pending')->count() }} Pending</span>
                        <span class="badge bg-success">{{ $memberships->where('status', 'approved')->count() }} Approved</span>
                        <span class="badge bg-danger">{{ $memberships->where('status', 'rejected')->count() }} Rejected</span>
                    </div>
                </div>
                <div class="admin-card-body">
                    @if($memberships->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="80">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th width="100">Chapter</th>
                                        <th width="100">Status</th>
                                        <th width="120">Submitted</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($memberships as $membership)
                                        <tr>
                                            <td>#{{ $membership->id }}</td>
                                            <td>
                                                <strong>{{ $membership->full_name }}</strong>
                                                @if($membership->chapter_applying_for)
                                                    <br><small class="text-muted">{{ $membership->chapter_applying_for }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $membership->email }}</td>
                                            <td>{{ $membership->phone_number }}</td>
                                            <td>
                                                @if($membership->chapter_applying_for)
                                                    <span class="badge bg-info">{{ ucfirst($membership->chapter_applying_for) }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $membership->status_badge }}">
                                                    {{ ucfirst($membership->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $membership->submitted_at->format('M d, Y') }}</small><br>
                                                <small class="text-muted">{{ $membership->submitted_at->format('h:i A') }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.membership-applications.show', $membership) }}"
                                                   class="btn btn-sm btn-admin-outline" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.membership-applications.destroy', $membership) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this application?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Showing {{ $memberships->firstItem() }} to {{ $memberships->lastItem() }}
                                of {{ $memberships->total() }} results
                            </div>
                            {{ $memberships->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5>No membership applications found</h5>
                            @if(request('status') || request('search'))
                                <p class="text-muted">Try adjusting your search criteria.</p>
                                <a href="{{ route('admin.membership-applications.index') }}" class="btn btn-admin-outline">
                                    <i class="fas fa-list me-2"></i>View All Applications
                                </a>
                            @else
                                <p class="text-muted">Membership applications will appear here once submitted.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
