@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-3">Tambah Data Device</h2>
    </div>

    <form action="/devices/store" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="serial_number">Serial Number</label>
                    <input type="text" name="serial_number" id="serial_number" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="meta_data">Meta Data</label>
                    <input type="text" name="meta_data" id="meta_data" class="form-control">
                </div>
                <div class="d-flex justify-content-end">
                    <div>
                        <a href="/devices" class="btn btn-outline-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
