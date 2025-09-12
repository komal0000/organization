@extends('back.layout')
@section('head-title')
    <a href="#">Sliders</a>
@endsection
@section('toolbar')
    <a href="{{route('admin.slider.add')}}" class="btn btn-sm btn-primary">Add Slider</a>
@endsection
@section('content')
<div class="mt-3 p-3 shadow">

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>
                Image
            </th>
            <th></th>
        </tr>
        @foreach ($sliders as $slider)
        <tr>
            <td>
                {{$slider->title}}
            </td>
            <td>
                <img  loading="lazy"  src="{{vasset($slider->image)}}" style="height:100px" alt="slider image">
            </td>
            <td>
                <a href="{{route('admin.slider.edit',['slider'=>$slider->id])}}" class="btn btn-primary">Edit</a>
                <a href="{{route('admin.slider.del',['slider'=>$slider->id])}}" onclick="return confirm('Delete slider?');" class="btn btn-danger">Del</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
