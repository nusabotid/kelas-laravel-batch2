@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Dashboard</h2>
    </div>

    <div>
        @if (auth()->check())
            <p>Selamat datang user {{ auth()->user()->name ?? '-' }}</p>
        @else
            <p>Belum ada user yang terautentikasi</p>
        @endif
    </div>

</div>
@endsection
