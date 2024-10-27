@extends('layouts.main')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-center align-items-center">
        <h2 class="mb-3">Ubah Password</h2>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            @if (session('error-password'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ session()->get('error-password') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session()->get('success') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="/ubah-password" method="post">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="old_password" class="form-label">Password Lama</label>
                    <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                    @error('old_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="new_password" class="form-label">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/dashboard" class="btn btn-outline-secondary d-block">Kembali ke Dashboard</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
