@extends('back.layout')
@section('head-title')
    <a href="#">Setting</a>
    <a href="#">Donation</a>
@endsection
@section('content')
    <div class="mt-3 p-3 shadow">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $data->title ?? '' }}" required>
                </div>

                <div class="col-md-6">
                    <label for="qr">QR</label>
                    <input type="file" class="form-control dropify" name="qr" id="qr" accept="image/*"
                        @if (isset($data->qr)) data-default-file="{{ vasset($data->qr) }}"
                  @else
                    required @endif>

                    <div class=" mt-4">
                        <button class="btn btn-primary">Save Setting</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <label for="about">About</label>
                        <textarea name="about" class="form-control" style="min-height: 200px">{{ $data->about ?? '' }}</textarea>
                    </div>
                    <hr class="m-1">
                    <div>
                        <label for="extra">Extra Info</label>
                        <textarea name="extra" class="form-control" style="min-height: 200px">{{ $data->extra ?? '' }}</textarea>
                    </div>
                </div>


            </div>
        </form>
    </div>
@endsection
