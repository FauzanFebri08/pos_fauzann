@extends('layouts.app')

@section('title', 'Tambah Jenis')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">Tambah Jenis</h3>
                <p class="mb-0 text-white-50 small">Isi formulir untuk menambahkan jenis baru.</p>
            </div>
            <a href="{{ route('jenis.index') }}" class="btn btn-light btn-sm fw-bold text-primary rounded-3 px-3">
                ← Kembali
            </a>
        </div>

        <div class="px-2">
            <form action="{{ route('jenis.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama" class="form-label text-secondary fw-semibold">Nama Jenis</label>
                    <input type="text" 
                            name="nama" 
                            id="nama" 
                            class="form-control @error('nama') is-invalid @enderror" 
                            value="{{ old('nama') }}" 
                            placeholder="Masukkan nama jenis" 
                            required>

                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4 rounded-3 fw-bold">Simpan</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection