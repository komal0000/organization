@extends('back.layout')
@section('head-title')
    <a href="#">Setting</a>
    <a href="#">contact</a>
@endsection
@section('content')

    <div class="shadow mt-3 p-3">

        <form action="" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">
                <div class="col-md-12">
                    <label for="title">Organization Name</label>
                    <input type="text" name="title" class="form-control" value="{{$data->title??""}}" required>
                </div>
                <div class="col-md-12">
                    <label for="description">Organization Description</label>
                    <textarea type="text" name="description" class="form-control" required>{!! $data->description??"" !!}</textarea>
                </div>

                <div class="col-md-12">
                    <label for="feature_image">Feature Image</label>
                    <input type="file" class="form-control dropify" name="feature_image" id="feature_image" accept="image/*"
                      @if(isset($data->feature_image))
                        data-default-file="{{asset($data->feature_image)}}"
                      @else
                        required
                      @endif
                      >
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary">Save Sharing Info</button>
            </div>
        </form>
    </div>
@endsection
@section('js')


@endsection
