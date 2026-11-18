@extends('back.layout')
@section('head-title')
    <a href="#">Startup Database</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.startups.add')}}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Startup
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-rocket me-2"></i>Startup Database
        <span class="badge bg-secondary">{{ count($startups) }}</span>
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name of Firm</th>
                        <th>Project Name</th>
                        <th>Year</th>
                        <th>Location</th>
                        <th>Sector</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($startups as $index => $startup)
                    <tr>
                        <td class="text-muted">{{$index + 1}}</td>
                        <td><strong>{{$startup->name_of_firm}}</strong></td>
                        <td>{{$startup->project_name ?? '—'}}</td>
                        <td>{{$startup->year_of_operation}}</td>
                        <td>{{$startup->location_of_firm}}</td>
                        <td>{{$startup->sector ?? '—'}}</td>
                        <td>
                            <span class="badge bg-{{$startup->status_of_firm == 'Active' ? 'success' : 'secondary'}}">
                                {{$startup->status_of_firm}}
                            </span>
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="{{route('admin.startups.edit',['startup'=>$startup->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('admin.startups.del',['startup'=>$startup->id])}}" onclick="return confirm('Delete this startup?');" class="btn btn-sm btn-danger" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="admin-empty">
                            <i class="fas fa-rocket"></i>
                            No startups yet. <a href="{{route('admin.startups.add')}}">Add the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
