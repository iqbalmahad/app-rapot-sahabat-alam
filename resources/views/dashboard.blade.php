@extends('template.main')
@section('content')
<!-- Begin Page Content -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
<div class="container-fluid">
    
    @if (Auth::user()->hasRole('admin'))
        @include('layouts.dashboard_admin')
    @else
        @include('layouts.dashboard_user') 
    @endif
    
</div>
@endsection