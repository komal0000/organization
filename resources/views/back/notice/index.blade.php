@extends('back.layout')
@section('head-title')
    <a href="#">{{noticeType($type)}}</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.notice.add',['type'=>$type])}}" class="btn btn-sm btn-primary">New {{noticeType($type)}}</a>
@endsection
@section('content')
<div class="shadow p-3 mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                @if ($type==2 || $type==5)
                <th>
                    Image
                </th>
                @endif
                <th>

                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($notices as $notice)
                <tr>
                    <td>
                        {{$notice->title}}
                    </td>
                    @if ($type==2 || $type==5)
                    <td>
                        <img  loading="lazy"  style="max-height: 50px;" src="{{asset($notice->file)}}" alt="">
                    </td>
                    @endif
                    <td>
                        <a href="{{route('admin.notice.edit',['notice'=>$notice->id])}}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{route('admin.notice.del',['notice'=>$notice->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Delete {{noticeType($type)}}')"> Delete</a>
                        @if ($type==4)
                            <a href="{{route('admin.team.index',['notice'=>$notice->id])}}" class="btn btn-sm btn-primary" >Members</a>
                            @if ($notice->is_main==0)
                                <a href="{{route('admin.team.setmain',['id'=>$notice->id])}}" class="btn btn-sm btn-primary" >Set Main</a>
                            @endif
                        @endif
                        @if ($type==5)
                            <a href="{{route('admin.gallery.index',['notice'=>$notice->id])}}" class="btn btn-sm btn-primary" >Manage Images</a>
                        @endif

                        @if ($type==8 && $notice->is_main == 0)
                            <a href="{{route('admin.notice.main',['notice'=>$notice->id])}}" class="btn btn-sm btn-primary" >Show In Home</a>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
