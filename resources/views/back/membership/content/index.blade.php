@extends('back.layout')

@section('head-title')
    <a href="#">Membership Content</a>
@endsection

@section('toolbar')
    <a href="{{ route('admin.membership-content.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Content Section
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="admin-card">
                <div class="admin-card-header">
                    <i class="fas fa-edit me-2"></i>Membership Page Content
                    <span class="badge bg-info ms-2">{{ $contents->count() }} sections</span>
                </div>
                <div class="admin-card-body">
                    @if($contents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="60">Order</th>
                                        <th>Section Name</th>
                                        <th width="100">Type</th>
                                        <th>Section Key</th>
                                        <th width="80">Status</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contents as $content)
                                        <tr>
                                            <td>{{ $content->order }}</td>
                                            <td>{{ $content->section_name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $content->content_type)) }}</span>
                                            </td>
                                            <td><code>{{ $content->section_key }}</code></td>
                                            <td>
                                                @if($content->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.membership-content.edit', $content) }}"
                                                   class="btn btn-sm btn-admin-outline" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.membership-content.destroy', $content) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this content section?')">
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
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-edit fa-3x text-muted mb-3"></i>
                            <h5>No content sections found</h5>
                            <p class="text-muted">Add your first content section to customize the membership page.</p>
                            <a href="{{ route('admin.membership-content.create') }}" class="btn btn-admin-primary">
                                <i class="fas fa-plus me-2"></i>Add Content Section
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
