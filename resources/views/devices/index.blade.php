@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Data Device</h2>
        <a href="/devices/create" class="btn btn-primary">TAMBAH DATA</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session()->get('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Serial Number</th>
                <th>Meta Data</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $device->serial_number }}</td>
                    <td>{{ $device->meta_data }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/devices/edit/{{ $device->id }}" class="btn btn-sm btn-warning d-inline-block me-2">Ubah</a>
                            <form action="/devices/delete/{{ $device->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
