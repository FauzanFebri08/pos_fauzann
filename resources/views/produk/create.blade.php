@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">Tambah Produk</h3>
                <p class="mb-0 text-white-50 small">Isi formulir untuk menambahkan produk baru.</p>
            </div>
            <a href="{{ route('produk.index') }}" class="btn btn-light btn-sm fw-bold text-primary rounded-3 px-3">
                ← Kembali
            </a>
        </div>

        <div class="px-2">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Input Gambar & Preview --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="foto" class="form-label text-secondary fw-semibold">Gambar</label>
                        <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- Container Preview Gambar --}}
                    <div class="col-md-6 mt-3 mt-md-0 d-none" id="preview-container">
                        <label class="form-label text-secondary fw-semibold d-block">Preview Gambar</label>
                        <img id="img-preview" src="#" alt="Preview Foto" class="img-thumbnail rounded-3 shadow-sm" style="max-height: 180px; object-fit: cover;">
                    </div>
                </div>

                {{-- Dropdown Pilihan Jenis Produk --}}
                <div class="mb-3">
                    <label for="jenis_id" class="form-label text-secondary fw-semibold">Jenis Produk</label>
                    <select name="jenis_id" id="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Jenis --</option>
                        @foreach ($jenis as $item)
                            <option value="{{ $item->id }}" {{ old('jenis_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label text-secondary fw-semibold">Nama Produk</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama produk" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="purchase_price" class="form-label text-secondary fw-semibold">Harga Beli</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price') }}" placeholder="Masukkan harga beli" required>
                    @error('purchase_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="selling_price" class="form-label text-secondary fw-semibold">Harga Jual</label>
                    <input type="number" name="selling_price" id="selling_price" class="form-control @error('selling_price') is-invalid @enderror" value="{{ old('selling_price') }}" placeholder="Masukkan harga jual" required>
                    @error('selling_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label text-secondary fw-semibold">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', 0) }}" placeholder="Masukkan jumlah stok" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success w-100 rounded-3 fw-bold py-2">Simpan</button>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- Script untuk Preview Foto --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const container = document.getElementById('preview-container');
        const preview = document.getElementById('img-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            container.classList.add('d-none');
        }
    }
</script>

@endsection
