@extends('back.layout')
@section('head-title')
    <a href="{{ route('admin.notice.index', ['type' => 4]) }}">Committees</a>
    <a href="{{ route('admin.team.index', ['notice' => $team->notice->id]) }}">{{ $team->notice->title }}</a>
    <a href="#">Edit {{ $team->name }}</a>
@endsection
@section('toolbar')
    <a href="{{ route('admin.team.index', ['notice' => $team->notice->id]) }}" class="btn btn-admin-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Members
    </a>
@endsection
@section('content')
    @include('back.teams.form', ['member' => $team, 'notice' => $team->notice, 'action' => route('admin.team.edit', ['team' => $team->id])])
@endsection
