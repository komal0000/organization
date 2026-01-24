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
<div class="mt-3 p-3 shadow">

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Name of Firm</th>
                <th>Project Name</th>
                <th>Year</th>
                <th>Size</th>
                <th>Location</th>
                <th>Gender</th>
                <th>Sector</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($startups as $index => $startup)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$startup->name_of_firm}}</td>
                <td>{{$startup->project_name ?? '-'}}</td>
                <td>{{$startup->year_of_operation}}</td>
                <td>{{$startup->size_of_company}}</td>
                <td>{{$startup->location_of_firm}}</td>
                <td>{{$startup->gender_of_entrepreneurs}}</td>
                <td>{{$startup->sector ?? '-'}}</td>
                <td>
                    <span class="badge bg-{{$startup->status_of_firm == 'Active' ? 'success' : 'secondary'}}">
                        {{$startup->status_of_firm}}
                    </span>
                </td>
                <td>
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
                <td colspan="10" class="text-center text-muted">No startups found. Add your first startup!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
