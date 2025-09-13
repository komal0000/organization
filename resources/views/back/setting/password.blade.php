@extends('back.layout')
@section('head-title')
    <a href="#">Settings</a>
    <a href="#">Password</a>
@endsection
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <i class="fas fa-key me-2"></i>Change Password
    </div>
    <div class="admin-card-body">
        <form action="" method="post" onsubmit="return $('#new_password').val()==$('#new_password_confirmation').val();">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="current_password" class="admin-form-label">
                        <i class="fas fa-lock me-1"></i>Current Password
                    </label>
                    <input type="password" name="current_password" id="current_password" class="form-control admin-form-control" placeholder="Enter current password" required>
                    @error('current_password')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="new_password" class="admin-form-label">
                        <i class="fas fa-key me-1"></i>New Password
                    </label>
                    <input type="password" name="new_password" id="new_password" class="form-control admin-form-control" placeholder="Enter new password" required>
                    @error('new_password')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="new_password_confirmation" class="admin-form-label">
                        <i class="fas fa-check-circle me-1"></i>Confirm Password
                    </label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control admin-form-control" placeholder="Confirm new password" required>
                    @error('new_password_confirmation')
                        <div class="admin-alert admin-alert-error mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fas fa-save me-2"></i>Change Password
                </button>
                <button type="reset" class="btn btn-admin-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
@endsection
