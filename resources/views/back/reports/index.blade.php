@extends('back.layout')
@section('head-title')
    <a href="#">Reports & Documents</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.reports.add')}}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Report/Document
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-file-alt me-2"></i>Reports & Documents
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Document</th>
                        <th>Size</th>
                        <th>Order</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                    <tr>
                        <td>
                            <strong>{{$report->title}}</strong>
                            @if($report->description)
                                <br><small class="text-muted">{{Str::limit($report->description, 80)}}</small>
                            @endif
                        </td>
                        <td>
                            <a href="{{asset($report->document)}}" target="_blank" class="btn btn-sm btn-admin-outline text-nowrap">
                                <i class="fas fa-file-{{strtolower($report->file_extension)}} me-1"></i>
                                View {{strtoupper($report->file_extension)}}
                            </a>
                        </td>
                        <td><span class="badge bg-secondary">{{$report->file_size}}</span></td>
                        <td>{{$report->sort_order}}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{route('admin.reports.edit',['report'=>$report->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('admin.reports.del',['report'=>$report->id])}}" onclick="return confirm('Delete report? This will also delete the file.');" class="btn btn-sm btn-danger" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="admin-empty">
                            <i class="fas fa-file-alt"></i>
                            No reports yet. <a href="{{route('admin.reports.add')}}">Add the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
