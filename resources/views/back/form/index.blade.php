@extends('back.layout')
@section('head-title')
    <a href="#">Forms</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.admin_form_create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add New Form
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-wpforms me-2"></i>All Forms
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Fields</th>
                        <th>Responses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->year }}</td>
                        <td>
                            @if($row->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $row->fields->count() }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.admin_form_responses', $row->id) }}" class="badge bg-warning text-decoration-none">
                                {{ $row->responses->count() }}
                            </a>
                        </td>
                        <td class="pt_10 pb_10">
                            <a href="{{ route('forms.show', $row->slug) }}" class="btn btn-success btn-sm" target="_blank" title="View Form">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.admin_form_edit', $row->id) }}" class="btn btn-admin-outline btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.admin_form_delete', $row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
