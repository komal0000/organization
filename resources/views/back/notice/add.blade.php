@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => $type]) }}">{{ noticeType($type) }}</a>
    <a href="#">Add</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.notice.index', ['type' => $type]) }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-plus me-2"></i>Add New {{ noticeType($type) }}
        </div>
        <div class="admin-card-body">
            <form action="{{ route('admin.notice.add', ['type' => $type]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="admin-form-label">
                        @if ($type == 6)
                            <i class="fas fa-question-circle me-1"></i>Question
                        @else
                            <i class="fas fa-heading me-1"></i>Title
                        @endif
                    </label>
                    <input type="text" name="title" class="form-control admin-form-control"
                        placeholder="Enter {{ $type == 6 ? 'Question' : 'Title' }}">
                    @error('title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                @if ($type != 4 && $type != 6 && $type != 7)
                    <div class="mb-3">
                        <label for="file" class="admin-form-label">
                            @if ($type == 1)
                                <i class="fas fa-download me-1"></i>Download File
                            @else
                                <i class="fas fa-image me-1"></i>Image
                            @endif
                        </label>
                        <input type="file" name="file" class="form-control dropify" data-default-file=""
                            @if ($type != 1) accept="image/*" @endif>
                        @error('file')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

        @if ($type != 1 && $type != 2)
            <div class="mb-3">
                <label for="short_desc" class="admin-form-label">
                    @if ($type == 6)
                        <i class="fas fa-comment me-1"></i>Answer
                    @elseif($type == 8)
                        Short About
                    @else
                        <i class="fas fa-align-left me-1"></i>Short Description
                    @endif
                </label>
                <textarea name="short_desc" class="form-control admin-form-control" rows="3" placeholder="Enter short description"
                    required></textarea>
                @error('short_desc')
                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif

        @if ($type == 2 || $type == 7 || $type == 8)
            <div class="mb-3">
                <label for="desc" class="admin-form-label">
                    @if ($type == 2)
                        <i class="fas fa-newspaper me-1"></i>Full News
                    @elseif($type == 8)
                        <i class="fas fa-info-circle me-1"></i>Full About
                    @else
                        <i class="fas fa-align-justify me-1"></i>Description
                    @endif
                </label>
                <textarea name="desc" id="desc" class="form-control admin-form-control" required></textarea>
                @error('desc')
                    <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-admin-primary">
                <i class="fas fa-save me-2"></i>Save {{ noticeType($type) }}
            </button>
            <a href="{{ route('admin.notice.index', ['type' => $type]) }}" class="btn btn-admin-secondary">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
        </div>

        </form>
    </div>
    </div>
@endsection
@section('js')
    @if ($type == 2 || $type == 7 || $type == 8)
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
            integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
            integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/upload/trumbowyg.upload.min.js"
            integrity="sha512-0Ax7SrxNwOb0s4mFVC5Vvn1wC6ts8ysma0OyNsXEXjygtnirRYF9Eg5Z1FPfXyoVRpsslvY/AQgoBY9u4sZKSw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/fontsize/trumbowyg.fontsize.min.js"
            integrity="sha512-eFYo+lmyjqGLpIB5b2puc/HeJieqGVD+b8rviIck2DLUVuBP1ltRVjo9ccmOkZ3GfJxWqEehmoKnyqgQwxCR+g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {

                $('#desc').trumbowyg({
                    autogrow: true,
                    btns: [
                        ['undo', 'redo'],
                        ['fontsize'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['link'],
                        ['upload'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                    ],

                    plugins: {
                        upload: {
                            serverPath: "{{ route('admin.notice.image', ['type' => $type]) }}",
                            imageWidthModalEdit: true,
                            data: [{
                                name: "_token",
                                value: "{{ csrf_token() }}"
                            }],
                        }
                    }
                });

            });
        </script>
    @endif
@endsection
