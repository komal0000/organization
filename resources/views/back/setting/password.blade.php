@extends('back.layout')
@section('head-title')
    <a href="#">Setting</a>
    <a href="#">contact</a>
@endsection
@section('content')
    <div class="mt-3 p-3 shadow">

        <form action="" method="post" onsubmit="return $('#new_password').val()==$('#new_password_confirmation').val();">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="new_password_confirmation">Confirm Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary">Change Password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
@endsection
