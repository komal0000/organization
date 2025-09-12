
@extends('back.layout')
@section('head-title')
<a href="#">Setting</a>
<a href="#">Home FAQ</a>

@endsection
@section('content')
<div class="mt-3 p-3 shadow">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-2">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $data->title ?? '') }}">
            </div>

            <div class="col-md-12 mb-2">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" class="form-control" value="{{ old('subtitle', $data->subtitle ?? '') }}">
            </div>

            <div class="col-md-12 mb-2">
                <label for="semi" class="form-label">Semi</label>
                <textarea id="semi" name="semi" class="form-control" rows="3">{{ old('semi', $data->semi ?? '') }}</textarea>
            </div>

            <div class="col-md-12 mb-2">
                <label for="bottom_text" class="form-label">Bottom text</label>
                <textarea id="bottom_text" name="bottom_text" class="form-control" rows="3">{{ old('bottom_text', $data->bottom_text ?? '') }}</textarea>
            </div>

            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary">Save Setting</button>
            </div>
        </div>
    </form>
</div>
@endsection
