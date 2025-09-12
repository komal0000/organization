@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => $type]) }}">{{ noticeType($type) }}</a>
    <a href="#">Add</a>
@endsection
@section('toolbar')
@endsection
@section('content')
    <div class="mt-3 p-3 shadow">
        <form action="{{ route('admin.notice.add', ['type' => $type]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="title">
                    @if($type==6)
                    Question
                    @else
                    Title
                    @endif
                </label>
                <input type="text" name="title" class="form-control" data="Enter Title">
            </div>
            @if ($type!=4 &&  $type!=6 && $type!=7)
            <div class="mb-2">
                <label for="file">
                    @if ($type == 1)
                        Download File
                    @else
                        Image
                    @endif
                </label>
                <input type="file" name="file" class="form-control dropify" data="Select File" required
                    @if ($type != 1) accept="image/*" @endif>

            </div>
            @endif
            @if ($type != 1 && $type != 2)
                <div class="mb-2">
                    <label for="short_desc">
                        @if($type==6)
                        Answer
                        @elseif($type==8)
                        Short About
                        @else
                        Short Description
                        @endif
                    </label>
                    <textarea type="text" name="short_desc" class="form-control" data="Enter short description" required></textarea>
                </div>
            @endif

            @if ($type == 2 || $type==7 || $type==8)
                <div class="mb-2">
                    <label for="desc">
                        @if ($type == 2)
                            Full News
                        @elseif($type==8)
                            Full About
                        @endif
                    </label>
                    <textarea type="text" name="desc" id="desc" class="form-control" required></textarea>
                </div>
            @endif

            <div>
                <button class="btn btn-primary">
                    Save {{ noticeType($type) }}
                </button>
            </div>

        </form>
    </div>
@endsection
@section('js')
    @if ($type == 2 || $type==7 || $type==8)
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
                            serverPath: "{{route('admin.notice.image',['type'=>$type])}}",
                            imageWidthModalEdit: true,
                            data: [{name:"_token",value:"{{csrf_token()}}"}],
                        }
                    }
                });

            });
        </script>
    @endif
@endsection
