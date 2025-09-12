@extends('back.layout')
@section('head-title')
<a href="#">Setting</a>
<a href="#">General</a>

@endsection
@section('content')
<div class="mt-3 p-3 shadow">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{$data->phone??""}}" required>
            </div>
            <div class="col-md-4">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{$data->email??""}}" required>
            </div>
            <div class="col-md-4">
                <label for="address">Street Address</label>
                <input type="text" name="address" class="form-control" value="{{$data->address??""}}" required>
            </div>
            <div class="col-md-4">
                <label for="district">District</label>
                <input type="text" name="district" class="form-control" value="{{$data->district??""}}" required>
            </div>
            <div class="col-md-4">
                <label for="state">State/Province</label>
                <input type="text" name="state" class="form-control" value="{{$data->state??""}}" required>
            </div>
            <div class="col-md-4">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" value="{{$data->country??""}}" required>
            </div>
            <div class="col-md-3">
                <label for="fb">Facebook Url</label>
                <input type="url" name="fb" class="form-control" value="{{$data->fb??""}}" >
            </div>
            <div class="col-md-3">
                <label for="insta">Instagram Url</label>
                <input type="url" name="insta" class="form-control" value="{{$data->insta??""}}" >
            </div>
            <div class="col-md-3">
                <label for="twitter">Twitter Url</label>
                <input type="url" name="twitter" class="form-control" value="{{$data->twitter??""}}" >
            </div>
            <div class="col-md-3">
                <label for="youtube">Youtube Url</label>
                <input type="url" name="youtube" class="form-control" value="{{$data->youtube??""}}" >
            </div>
            <div class="col-md-6">
                <label for="header_logo">Header Logo</label>
                <input type="file" class="form-control dropify" name="header_logo" id="header_logo" accept="image/*"
                  @if(isset($data->header_logo))
                    data-default-file="{{asset($data->header_logo)}}"
                  @else
                    required
                  @endif
                  >
            </div>
            <div class="col-md-6">
                <label for="footer_logo">Fotter Logo</label>
                <input type="file" class="form-control dropify" name="footer_logo" id="footer_logo" accept="image/*"
                @if(isset($data->footer_logo))
                    data-default-file="{{asset($data->footer_logo)}}"
                @else
                    required
                @endif
                >
            </div>

            <div class="col-12 mt-2">
                <button class="btn btn-primary">Save Setting</button>
            </div>
        </div>
    </form>
</div>
@endsection
