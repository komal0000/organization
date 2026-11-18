@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => $notice->type]) }}">{{ noticeType($notice->type) }}</a>
    <a href="#">Edit</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.notice.index', ['type' => $notice->type]) }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection
@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-edit me-2"></i>Edit {{ noticeType($notice->type) }}
        </div>
        <div class="admin-card-body">
        <form action="{{ route('admin.notice.edit', ['notice' => $notice->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="admin-form-label">
                    @if($notice->type==6)
                    Question
                    @else
                    Title
                    @endif
                </label>
                <input type="text" name="title" id="title" class="form-control admin-form-control" value="{{$notice->title}}">
            </div>
            @if ($notice->type!=4  &&  $notice->type!=6 && $notice->type!=7)

            <div class="mb-3">
                <label for="file" class="admin-form-label">
                    @if ($notice->type == 1)
                        Download File
                    @else
                        Image
                    @endif
                </label>
                <input type="file" name="file" id="file" class="form-control dropify" data-default-file="{{ $notice->file ? asset($notice->file) : '' }}"
                    @if ($notice->type != 1) accept="image/*" @endif>

            </div>
            @endif
            @if ($notice->type != 1 && $notice->type != 2 )
                <div class="mb-3">
                    <label for="short_desc" class="admin-form-label">
                        @if($notice->type==6)
                        Answer
                        @elseif($notice->type==8)
                        Short About
                        @else
                        Short Description
                        @endif
                    </label>
                    <textarea type="text" name="short_desc" id="short_desc" class="form-control admin-form-control" rows="4" required>{{$notice->short_desc}}</textarea>
                </div>
            @endif

            @if ($notice->type == 2 || $notice->type==7 || $notice->type==8)
                <div class="mb-3">
                    <label for="desc" class="admin-form-label">
                        @if ($notice->type == 2)
                            Full News
                        @elseif($notice->type==8)
                            Full About
                        @endif
                    </label>
                    <textarea type="text" name="desc" id="desc" class="form-control admin-form-control" required>{{$notice->desc}}</textarea>
                </div>
            @endif

            <div class="d-flex gap-2">
                <button class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Update {{ noticeType($notice->type) }}
                </button>
                <a href="{{ route('admin.notice.index', ['type' => $notice->type]) }}" class="btn btn-admin-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>

        </form>
        </div>
    </div>
@endsection
@section('js')
    @if ($notice->type == 2 || $notice->type==7 || $notice->type==8)
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
                            serverPath: "{{route('admin.notice.image',['type'=>$notice->type])}}",
                            imageWidthModalEdit: true,
                            data: [{name:"_token",value:"{{csrf_token()}}"}],
                        }
                    }
                });

            });
        </script>
    @endif
@endsection
