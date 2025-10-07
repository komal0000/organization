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
<div class="mt-3 p-3 shadow">

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Link</th>
            <th>Sort Order</th>
            <th></th>
        </tr>
        @foreach ($partners as $partner)
        <tr>
            <td>
                {{$partner->name}}
            </td>
            <td>
                <img loading="lazy" src="{{vasset($partner->image)}}" style="height:60px" alt="partner image">
            </td>
            <td>
                @if($partner->link)
                    <a href="{{$partner->link}}" target="_blank" class="text-primary">{{$partner->link}}</a>
                @else
                    <span class="text-muted">No Link</span>
                @endif
            </td>
            <td>
                {{$partner->sort_order}}
            </td>
            <td>
                <a href="{{route('admin.partners.edit',['partner'=>$partner->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{route('admin.partners.del',['partner'=>$partner->id])}}" onclick="return confirm('Delete partner?');" class="btn btn-sm btn-danger" title="Delete">
                    <i class="far fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection