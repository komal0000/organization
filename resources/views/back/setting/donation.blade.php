@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Donation</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-donate me-2"></i>Donation Settings
    </div>
    <div class="admin-card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="admin-form-label">
                        <i class="fas fa-heading me-1"></i>Donation Title
                    </label>
                    <input type="text" name="title" class="form-control admin-form-control" value="{{ $data->title ?? '' }}" placeholder="Enter donation section title" required>
                    @error('title')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="qr" class="admin-form-label">
                        <i class="fas fa-qrcode me-1"></i>QR Code Image
                    </label>
                    <input type="file" class="form-control dropify" name="qr" id="qr" accept="image/*"
                        @if (isset($data->qr)) data-default-file="{{ vasset($data->qr) }}"
                        @else required @endif>
                    @error('qr')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="about" class="admin-form-label">
                            <i class="fas fa-info-circle me-1"></i>About Donation
                        </label>
                        <textarea name="about" class="form-control admin-form-control" style="min-height: 150px" placeholder="Enter information about donations">{{ $data->about ?? '' }}</textarea>
                        @error('about')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="extra" class="admin-form-label">
                            <i class="fas fa-plus-circle me-1"></i>Additional Information
                        </label>
                        <textarea name="extra" class="form-control admin-form-control" style="min-height: 150px" placeholder="Enter additional donation information">{{ $data->extra ?? '' }}</textarea>
                        @error('extra')
                            <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Save Donation Settings
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
        </form>
    </div>
@endsection
