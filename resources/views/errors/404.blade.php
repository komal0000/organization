@extends('front.layout')
@section('content')
    <div class="py-5" style="background: var(--org-extra)">
        <div class="container text-center">
            <h1 style="font-family: var(--org-font-two)">
                This page doesn't exists.
            </h1>
            <hr class="mt-0">
            <h5>
                <a  href="{{route('home')}}">Go To Home Page</a>
            </h5>
        </div>
    </div>
@endsection
