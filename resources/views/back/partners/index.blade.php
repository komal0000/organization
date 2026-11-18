@extends('back.layout')
@section('head-title')
    <a href="#">Partners</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.partners.add')}}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Partner
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-handshake me-2"></i>Partners
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Order</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($partners as $partner)
                    <tr>
                        <td>
                            <img loading="lazy" src="{{vasset($partner->image)}}" class="admin-thumb" alt="partner logo">
                        </td>
                        <td><strong>{{$partner->name}}</strong></td>
                        <td>
                            @if($partner->link)
                                <a href="{{$partner->link}}" target="_blank" rel="noopener">{{Str::limit($partner->link, 40)}}</a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{$partner->sort_order}}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{route('admin.partners.edit',['partner'=>$partner->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('admin.partners.del',['partner'=>$partner->id])}}" onclick="return confirm('Delete partner?');" class="btn btn-sm btn-danger" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="admin-empty">
                            <i class="fas fa-handshake"></i>
                            No partners yet. <a href="{{route('admin.partners.add')}}">Add the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
