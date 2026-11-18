@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => 5]) }}">Galleries</a>
    <a href="#">{{ $notice->title }}</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.notice.index', ['type' => 5]) }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Galleries
    </a>
@endsection

@section('content')
    <style>
        .del {
            position: absolute;
            top: 0px;
            right: 0px;

        }
    </style>
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-upload me-2"></i>Upload Images
        </div>
        <div class="admin-card-body">
            <div id="shadow-data">
                <div class="row" id="images"></div>
                <div class="d-flex flex-wrap gap-2">
                    <label for="image" class="btn btn-admin-outline mb-0">
                        <input type="file" accept="image/*" class="form-control d-none" id="image" multiple
                            onchange="fileChanged(this,event)">
                        <i class="fas fa-folder-open me-2"></i>Select Images
                    </label>
                    <button class="btn btn-admin-primary" onclick="uploadFiles()">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Selected
                    </button>
                </div>
            </div>
            <div id="shadow-loader" class="d-none text-muted">
                <span class="spinner-border spinner-border-sm me-2"></span>Uploading…
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-images me-2"></i>Saved Images
        </div>
        <div class="admin-card-body">
            <div id="galleries" class="row"></div>
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
