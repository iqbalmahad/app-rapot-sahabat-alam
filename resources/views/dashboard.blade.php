@extends('template.main')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    @if (Auth::user()->hasRole('admin'))
        @include('layouts.dashboard_admin')
    @else
        @include('layouts.dashboard_user') 
    @endif
</div>
@endsection