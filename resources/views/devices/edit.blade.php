@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Ubah Data Device</h2>
    </div>

    <form action="/devices/update/{{ $device->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="serial_number">Serial Number</label>
                    <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number', $device->serial_number) }}">
                    @error('serial_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="meta_data">Meta Data</label>
                    <input type="text" name="meta_data" id="meta_data" class="form-control @error('meta_data') is-invalid @enderror" value="{{ old('meta_data', $device->meta_data) }}">
                    @error('meta_data')
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
