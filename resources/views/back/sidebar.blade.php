<style>
    .link{
        text-decoration: none;
        font-weight: 600;
    }
</style>
<div >
    <h5 class="mt-3">Admin Panel</h5>
</div>
<hr>
<div >
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>1])}}">Notices</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>2])}}">News</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>4])}}">Comittes</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>5])}}">Galleries</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>6])}}">FAQ</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>7])}}">Issues</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.notice.index',['type'=>8])}}">About Us</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.slider.index')}}">Sliders</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.setting.general')}}">General Setting</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.setting.donation')}}">Donation Setting</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.setting.fb')}}">FB Page Setting</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.setting.meta')}}">Sharing Setting</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.setting.contact')}}">Contact Setting</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('admin.setting.password')}}">Change Password</a>
    <hr class="my-1">
    <a class="link ps-1" href="{{route('logout')}}" onclick="return confirm('Do you want to logout?')">Logout</a>
    {{-- <hr class="my-1"> --}}

</div>

