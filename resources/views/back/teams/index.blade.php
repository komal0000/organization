@extends('back.layout')
@section('head-title')
    <a href="{{route('admin.notice.index',['type'=>4])}}">Committees</a>
    <a href="#">{{$notice->title}}</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.notice.index',['type'=>4])}}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Committees
    </a>
    <a href="{{route('admin.team.add',['notice'=>$notice->id])}}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Member
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-users me-2"></i>{{$notice->title}} — Members
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $member)
                    <tr>
                        <td>
                            <img loading="lazy" src="{{vasset($member->image)}}" class="admin-thumb rounded-circle" alt="member photo">
                        </td>
                        <td><strong>{{$member->name}}</strong></td>
                        <td>{{$member->desig}}</td>
                        <td>{{$member->phone}}</td>
                        <td>{{$member->email}}</td>
                        <td>{{$member->address}}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{route('admin.team.edit',['team'=>$member->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('admin.team.del',['team'=>$member->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Delete member?');" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="admin-empty">
                            <i class="fas fa-user-friends"></i>
                            No members yet. <a href="{{route('admin.team.add',['notice'=>$notice->id])}}">Add the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
