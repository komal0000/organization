@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">General</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-cogs me-2"></i>General Settings
    </div>
    <div class="admin-card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Contact Information -->
            <h5 class="text-admin-primary mb-3">
                <i class="fas fa-phone me-2"></i>Contact Information
            </h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="phone" class="admin-form-label">
                        <i class="fas fa-phone me-1"></i>Phone
                    </label>
                    <input type="text" name="phone" class="form-control admin-form-control" value="{{$data->phone??""}}" placeholder="Enter phone number" required>
                    @error('phone')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email" class="admin-form-label">
                        <i class="fas fa-envelope me-1"></i>Email
                    </label>
                    <input type="email" name="email" class="form-control admin-form-control" value="{{$data->email??""}}" placeholder="Enter email address" required>
                    @error('email')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="address" class="admin-form-label">
                        <i class="fas fa-map-marker-alt me-1"></i>Street Address
                    </label>
                    <input type="text" name="address" class="form-control admin-form-control" value="{{$data->address??""}}" placeholder="Enter street address" required>
                    @error('address')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="district" class="admin-form-label">
                        <i class="fas fa-city me-1"></i>District
                    </label>
                    <input type="text" name="district" class="form-control admin-form-control" value="{{$data->district??""}}" placeholder="Enter district" required>
                    @error('district')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="state" class="admin-form-label">
                        <i class="fas fa-map me-1"></i>State/Province
                    </label>
                    <input type="text" name="state" class="form-control admin-form-control" value="{{$data->state??""}}" placeholder="Enter state/province" required>
                    @error('state')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="country" class="admin-form-label">
                        <i class="fas fa-globe me-1"></i>Country
                    </label>
                    <input type="text" name="country" class="form-control admin-form-control" value="{{$data->country??""}}" placeholder="Enter country" required>
                    @error('country')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Social Media -->
            <h5 class="text-admin-primary mb-3 mt-4">
                <i class="fas fa-share-alt me-2"></i>Social Media Links
            </h5>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="fb" class="admin-form-label">
                        <i class="fab fa-facebook me-1"></i>Facebook URL
                    </label>
                    <input type="url" name="fb" class="form-control admin-form-control" value="{{$data->fb??""}}" placeholder="https://facebook.com/yourpage">
                    @error('fb')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="insta" class="admin-form-label">
                        <i class="fab fa-instagram me-1"></i>Instagram URL
                    </label>
                    <input type="url" name="insta" class="form-control admin-form-control" value="{{$data->insta??""}}" placeholder="https://instagram.com/yourpage">
                    @error('insta')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="twitter" class="admin-form-label">
                        <i class="fab fa-twitter me-1"></i>Twitter URL
                    </label>
                    <input type="url" name="twitter" class="form-control admin-form-control" value="{{$data->twitter??""}}" placeholder="https://twitter.com/yourpage">
                    @error('twitter')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="youtube" class="admin-form-label">
                        <i class="fab fa-youtube me-1"></i>YouTube URL
                    </label>
                    <input type="url" name="youtube" class="form-control admin-form-control" value="{{$data->youtube??""}}" placeholder="https://youtube.com/yourchannel">
                    @error('youtube')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Logo Settings -->
            <h5 class="text-admin-primary mb-3 mt-4">
                <i class="fas fa-image me-2"></i>Logo Settings
            </h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="header_logo" class="admin-form-label">
                        <i class="fas fa-header me-1"></i>Header Logo
                    </label>
                    <input type="file" class="form-control dropify" name="header_logo" id="header_logo" accept="image/*"
                      @if(isset($data->header_logo))
                        data-default-file="{{asset($data->header_logo)}}"
                      @else
                        required
                      @endif>
                    @error('header_logo')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="footer_logo" class="admin-form-label">
                        <i class="fas fa-footer me-1"></i>Footer Logo
                    </label>
                    <input type="file" class="form-control dropify" name="footer_logo" id="footer_logo" accept="image/*"
                    @if(isset($data->footer_logo))
                        data-default-file="{{asset($data->footer_logo)}}"
                    @else
                        required
                    @endif>
                    @error('footer_logo')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Save Settings
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
