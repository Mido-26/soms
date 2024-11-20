@extends('layouts.app')

@section('title', 'Dashboard')
@section('name', 'Dashboard')

@section('content')

    @if ($role == 'admin')
        @include('layouts.components.adminDash')
    @endif
    @if ($role == 'user')
        @include('layouts.components.userDashboard')
    @endif


@endsection
