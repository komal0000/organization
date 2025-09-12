@extends('back.layout')
@section('head-title')
<a href="#">Setting</a>
<a href="#">Facebook</a>

@endsection
@section('content')
<div class="mt-3 p-3 shadow">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-12">
                <textarea name="data" id="data" class="form-control">{{$data->data??""}}</textarea>
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-primary">Save Setting</button>
            </div>
        </div>
    </form>
</div>
@endsection
