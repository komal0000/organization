@extends('back.layout')
@section('head-title')
<a href="{{route('admin.slider.index')}}">Sliders</a>
<a href="#">Edit</a>

@endsection
@section('content')
    <div class="shadow mt-3 p-3">

        <form action="{{route('admin.slider.edit',['slider'=>$slider->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required value="{{$slider->title}}">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="link">Link</label>
                    <input type="url" class="form-control" id="link" name="link" value="{{$slider->link}}">
                </div>
                <div class="col-md-8 mb-2">
                    <label for="image">Desktop Image</label>
                    <input type="file" class="form-control dropify" name="image" id="image"  accept="image/*" data-default-file="{{asset($slider->image)}}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="mobile_image">Mobile Image</label>
                    <input type="file" class="form-control dropify" name="mobile_image" id="mobile_image"  accept="image/*" data-default-file="{{asset($slider->mobile_image)}}">
                </div>
            </div>
            <div class="mb-2">
                <label for="subtitle">Subtitle</label>
                <textarea class="form-control" id="subtitle" name="subtitle" required>{{$slider->subtitle}}</textarea>
            </div>
            <div class="text-end">
                <button class="btn btn-primary">
                    Save Slider
                </button>
                <a href="{{route('admin.slider.index')}}" class="btn btn-danger">Cancel</a>
            </div>

        </form>
    </div>
@endsection
