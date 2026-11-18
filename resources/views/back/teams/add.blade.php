@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => 4]) }}">Committees</a>
    <a href="{{ route('admin.team.index', ['notice' => $notice->id]) }}">{{ $notice->title }}</a>
    <a href="#">Add Member</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.team.index', ['notice' => $notice->id]) }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Members
    </a>
@endsection
@section('content')
    @include('back.teams.form', ['member' => null, 'action' => route('admin.team.add', ['notice' => $notice->id])])
@endsection
