@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => 5]) }}">Gallery</a>
    <a href="#">{{ $notice->title }}</a>
    <a href="#">Images</a>
@endsection

@section('content')
    <style>
        .del {
            position: absolute;
            top: 0px;
            right: 0px;

        }
    </style>
    <div class="mt-3 p-3 shadow">
        <div id="shadow-data">
            <div class="row" id="images"></div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <label for="image" class="btn btn-primary w-100">
                        <input type="file" accept="image/*" class="form-control d-none" id="image" multiple
                            onchange="fileChanged(this,event)">
                        Select Files
                    </label>

                </div>
                <div class="col-md-2">
                    <button class="btn btn-success w-100" onclick="uploadFiles()">
                        Upload Files
                    </button>
                </div>
            </div>
        </div>
        <div id="shadow-loader" class="d-none">
            Uploading Data
        </div>
    </div>

    <div class="mt-4 shadow p-3">
        <div id="galleries" class="row">

        </div>
    </div>
@endsection
@section('js')
    <script>
        var galleries = {!! json_encode($galleries) !!};

        @include('back.gallery.js')

        $(document).ready(function() {
            galleries.forEach(data => {
                renderSaved(data);
            });
        });
    </script>
@endsection
