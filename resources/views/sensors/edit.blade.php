@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Ubah Data Sensor</h2>
    </div>

    <form action="/sensors/update/{{ $sensor->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="nama_sensor">Nama Sensor</label>
                    <input type="text" name="nama_sensor" id="nama_sensor" value="{{ old('nama_sensor', $sensor->nama_sensor) }}" class="form-control @error('nama_sensor') is-invalid @enderror">
                    @error('nama_sensor')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="data">Data</label>
                    <input type="text" name="data" id="data" value="{{ old('data', $sensor->data) }}" class="form-control @error('data') is-invalid @enderror">
                    @error('data')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="topic">Topic</label>
                    <input type="text" name="topic" id="topic" value="{{ old('topic', $sensor->topic) }}" class="form-control @error('topic') is-invalid @enderror">
                    @error('topic')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <div>
                        <a href="/devices" class="btn btn-outline-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
