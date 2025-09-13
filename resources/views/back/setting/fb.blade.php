@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Facebook</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fab fa-facebook me-2"></i>Facebook Integration Settings
    </div>
    <div class="admin-card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="data" class="admin-form-label">
                        <i class="fas fa-code me-1"></i>Facebook Integration Code
                    </label>
                    <textarea name="data" id="data" class="form-control admin-form-control" rows="8" placeholder="Paste your Facebook page plugin code here">{{$data->data??""}}</textarea>
                    @error('data')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Get your Facebook page plugin code from <a href="https://developers.facebook.com/docs/plugins/page-plugin" target="_blank">Facebook Developers</a>
                    </small>
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Save Facebook Settings
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
