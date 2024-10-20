@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Data Sensor</h2>
        <a href="/sensors/create" class="btn btn-primary">TAMBAH DATA</a>
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
                <th>Nama Sensor</th>
                <th>Data</th>
                <th>Topic</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sensors as $sensor)
                <tr>
                    <td>{{ ($sensors->currentPage() - 1) * $sensors->perPage() + $loop->index + 1 }}</td>
                    <td>{{ $sensor->nama_sensor }}</td>
                    <td>{{ $sensor->data }}</td>
                    <td>{{ $sensor->topic }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/sensors/edit/{{ $sensor->id }}" class="btn btn-sm btn-warning d-inline-block me-2">Ubah</a>
                            <form action="/sensors/delete/{{ $sensor->id }}" method="post">
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

    <div class="py-4">
        {{ $sensors->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
