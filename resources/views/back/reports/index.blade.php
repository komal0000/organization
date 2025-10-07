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
<div class="mt-3 p-3 shadow">

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Document</th>
            <th>File Size</th>
            <th>Sort Order</th>
            <th></th>
        </tr>
        @foreach ($reports as $report)
        <tr>
            <td>
                <strong>{{$report->title}}</strong>
            </td>
            <td>
                @if($report->description)
                    <span class="text-muted">{{Str::limit($report->description, 50)}}</span>
                @else
                    <span class="text-muted">No description</span>
                @endif
            </td>
            <td>
                <a href="{{asset($report->document)}}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-file-{{strtolower($report->file_extension)}} me-1"></i>
                    View {{strtoupper($report->file_extension)}}
                </a>
            </td>
            <td>
                <span class="badge bg-secondary">{{$report->file_size}}</span>
            </td>
            <td>
                {{$report->sort_order}}
            </td>
            <td>
                <a href="{{route('admin.reports.edit',['report'=>$report->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{route('admin.reports.del',['report'=>$report->id])}}" onclick="return confirm('Delete report? This will also delete the file.');" class="btn btn-sm btn-danger" title="Delete">
                    <i class="far fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection