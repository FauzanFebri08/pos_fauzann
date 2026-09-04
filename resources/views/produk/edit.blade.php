@extends('layouts.app')

@section('title', 'Edit Produk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user-form.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <div class="card form-card shadow-sm border-0">
            {{-- Header Card --}}
            <div class="card-header bg-primary text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-1">Edit Produk</h3>
                        <p class="mb-0 text-white-50">Perbarui informasi produk di bawah ini.</p>
                    </div>
                    {{-- Kembali ke daftar produk --}}
                    <a href="{{ route('produk.index') }}" class="btn btn-light btn-sm text-primary fw-semibold px-3 py-2">
                        &larr; Kembali
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('produk._form')
                </form>
            </div>
        </div>
    </div>
@endsection