@extends('back.layout')
@section('head-title')
    <a href="#">{{noticeType($type)}}</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.notice.add',['type'=>$type])}}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>New {{noticeType($type)}}
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-list me-2"></i>{{noticeType($type)}} List
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>
                            <i class="fas fa-heading me-1"></i>Title
                        </th>
                        @if ($type==2 || $type==5)
                        <th>
                            <i class="fas fa-image me-1"></i>Image
                        </th>
                        @endif
                        <th>
                            <i class="fas fa-calendar me-1"></i>Created
                        </th>
                        <th>
                            <i class="fas fa-cogs me-1"></i>Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notices as $notice)
                    <tr>
                        <td>
                            <strong>{{$notice->title}}</strong>
                            @if($notice->short_desc)
                                <br><small class="text-muted">{{ Str::limit($notice->short_desc, 80) }}</small>
                            @endif
                        </td>
                        @if ($type==2 || $type==5)
                        <td>
                            @if($notice->file)
                                <img loading="lazy" style="max-height: 50px; border-radius: 5px;" src="{{asset($notice->file)}}" alt="">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        @endif
                        <td>
                            <span class="text-muted">{{ $notice->created_at }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <a href="{{route('admin.notice.edit',['notice'=>$notice->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{route('admin.notice.del',['notice'=>$notice->id])}}" class="btn btn-sm btn-danger" onclick="return confirm('Delete {{noticeType($type)}}?')" title="Delete">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                @if ($type==4)
                                    <a href="{{route('admin.team.index',['notice'=>$notice->id])}}" class="btn btn-sm btn-admin-secondary" title="Members">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    @if ($notice->is_main==0)
                                        <a href="{{route('admin.team.setmain',['id'=>$notice->id])}}" class="btn btn-sm btn-admin-primary" title="Set as Main Committee">
                                            <i class="fas fa-star"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.team.unsetmain',['id'=>$notice->id]) }}" class="btn btn-sm btn-success disabled" style="display: flex; align-items: center;" title="Main Committee">
                                            <i class="fas fa-crown me-1"></i>Main
                                        </a>
                                    @endif
                                @endif
                                @if ($type==5)
                                    <a href="{{route('admin.gallery.index',['notice'=>$notice->id])}}" class="btn btn-sm btn-admin-secondary" title="Manage Images">
                                        <i class="fas fa-images"></i>
                                    </a>
                                @endif

                                @if ($type==8 && $notice->is_main == 0)
                                    <a href="{{route('admin.notice.main',['notice'=>$notice->id])}}" class="btn btn-sm btn-admin-primary" title="Show In Home">
                                        <i class="fas fa-home"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ ($type==2 || $type==5) ? '4' : '3' }}" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            No {{noticeType($type)}} found. <a href="{{route('admin.notice.add',['type'=>$type])}}">Create the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
