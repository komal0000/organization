@extends('back.layout')
@section('head-title')

    <a href="{{route('admin.notice.index',['type'=>4])}}">Teams</a>
    <a href="#">{{$notice->title}}</a>
    <a href="#">Members</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.team.add',['notice'=>$notice->id])}}" class="btn btn-sm btn-primary">Add Member</a>
@endsection
@section('content')
<div class="mt-3 p-3 shadow">

    <table class="table table-bordered">
        <tr>
            <th>
                Image
            </th>
            <th>Name</th>
            <th>Designation</th>
            <th>
                Phone
            </th>
            <th>
                Email
            </th>
            <th>
                Address
            </th>
            <th></th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>
                <img  loading="lazy"  src="{{vasset($member->image)}}" style="height:50px" alt="slider image">
            </td>
            <td>
                {{$member->name}}
            </td>
            <td>{{$member->desig}}</td>
            <td>
                {{$member->phone}}
            </td>
            <td>
                {{$member->email}}
            </td>
            <td>
                {{$member->address}}
            </td>
            <td>
                <a href="{{route('admin.team.edit',['team'=>$member->id])}}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{route('admin.team.del',['team'=>$member->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Delete member');">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
