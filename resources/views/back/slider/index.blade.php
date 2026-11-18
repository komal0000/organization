@extends('back.layout')
@section('head-title')
    <a href="#">Sliders</a>
@endsection
@section('toolbar')
    <form method="POST" action="{{ route('admin.slider.toggle') }}" class="m-0"
        onsubmit="return confirm('{{ $enabled ? 'Hide the slider from the home page?' : 'Show the slider on the home page?' }}')">
        @csrf
        <button class="btn {{ $enabled ? 'btn-success' : 'btn-secondary' }}" title="Show or hide the whole slider on the home page">
            <i class="fas {{ $enabled ? 'fa-toggle-on' : 'fa-toggle-off' }} me-2"></i>Slider: {{ $enabled ? 'ON' : 'OFF' }}
        </button>
    </form>
    <a href="{{route('admin.slider.add')}}" class="btn btn-admin-primary">
        <i class="fas fa-plus me-2"></i>Add Slider
    </a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-sliders-h me-2"></i>Sliders
        @unless ($enabled)
            <span class="badge bg-secondary ms-auto">Hidden on home page</span>
        @endunless
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                    <tr>
                        <td>
                            <img loading="lazy" src="{{vasset($slider->image)}}" class="admin-thumb admin-thumb-wide" alt="slider image">
                        </td>
                        <td>{{$slider->title ?: '—'}}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{route('admin.slider.edit',['slider'=>$slider->id])}}" class="btn btn-sm btn-admin-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('admin.slider.del',['slider'=>$slider->id])}}" onclick="return confirm('Delete slider?');" class="btn btn-sm btn-danger" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="admin-empty">
                            <i class="fas fa-images"></i>
                            No sliders yet. <a href="{{route('admin.slider.add')}}">Add the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
