@extends('back.layout')

@section('head-title')
    <a href="#">Essential Files</a>
@endsection

@section('toolbar')
    <a href="{{ route('admin.essential-files.create') }}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>New Essential File
    </a>
@endsection

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-file me-2"></i>Essential Files List
        </div>
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-heading me-1"></i>Title
                            </th>
                            <th>
                                <i class="fas fa-file me-1"></i>Document
                            </th>
                            <th>
                                <i class="fas fa-sort me-1"></i>Order
                            </th>
                            <th>
                                <i class="fas fa-toggle-on me-1"></i>Status
                            </th>
                            <th>
                                <i class="fas fa-calendar me-1"></i>Created
                            </th>
                            <th>
                                <i class="fas fa-cogs me-1"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($files as $file)
                            <tr>
                                <td>
                                    <strong>{{ $file->title }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="{{ $file->file_icon }} me-2"></i>
                                        <div>
                                            <small class="d-block text-muted">{{ strtoupper($file->file_type) }}</small>
                                            <small class="text-muted">{{ $file->formatted_file_size }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">{{ $file->order }}</span>
                                </td>
                                <td>
                                    @if ($file->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $file->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.essential-files.edit', $file) }}"
                                           class="btn btn-sm btn-admin-outline">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ $file->download_url }}"
                                           class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form action="{{ route('admin.essential-files.destroy', $file) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this essential file?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-file fa-2x mb-3"></i>
                                        <p>No essential files found. <a href="{{ route('admin.essential-files.create') }}">Create your first essential file</a>.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($files->hasPages())
                <div class="mt-4">
                    {{ $files->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
