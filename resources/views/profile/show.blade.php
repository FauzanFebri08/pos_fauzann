@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Card Utama --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-gradient bg-primary py-5 text-center position-relative">
                    <div class="position-absolute top-100 start-50 translate-middle">
                        <div class="bg-white p-1 rounded-circle shadow position-relative">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Photo" class="rounded-circle object-fit-cover" style="width: 90px; height: 90px;">
                            @else
                                <div class="bg-primary text-white fw-bold rounded-circle d-flex align-items-center justify-content-center fs-1 shadow-sm" style="width: 90px; height: 90px;">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif

                            {{-- Tombol Kamera HANYA MUNCUL jika User = Admin --}}
                            @php
                                $isAdmin = ($user->role_id == 1 || ($user->role && $user->role->id == 1));
                            @endphp
                            @if ($isAdmin)
                                <button type="button" class="btn btn-sm btn-dark rounded-circle position-absolute bottom-0 end-0 p-1 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" data-bs-toggle="modal" data-bs-target="#uploadAvatarModal" title="Ubah Foto Profil">
                                    <i class="bi bi-camera-fill fs-6"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body pt-5 pb-4 px-4 text-center mt-3">
                    <h3 class="fw-bold text-dark mb-1">{{ $user->name }}</h3>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                    <span class="badge {{ $isAdmin ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-success-subtle text-success border border-success-subtle' }} px-3 py-2 rounded-pill fw-semibold fs-7 mb-4">
                        <i class="bi {{ $isAdmin ? 'bi-shield-check' : 'bi-person-badge' }} me-1"></i>
                        {{ $isAdmin ? 'Administrator' : 'Kasir / Staff' }}
                    </span>

                    <div class="row g-3 text-start mb-4">
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 d-flex align-items-center gap-3">
                                <div class="bg-white text-primary p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-person fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small">Nama Lengkap</span>
                                    <strong class="text-dark">{{ $user->name }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 d-flex align-items-center gap-3">
                                <div class="bg-white text-primary p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-envelope fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small">Alamat Email</span>
                                    <strong class="text-dark">{{ $user->email }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 d-flex align-items-center gap-3">
                                <div class="bg-white text-primary p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-calendar-check fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small">Terdaftar Sejak</span>
                                    <strong class="text-dark">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary fw-semibold py-2 rounded-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Upload Foto Profil HANYA DIBUAT jika User = Admin --}}
@if ($isAdmin)
<div class="modal fade" id="uploadAvatarModal" tabindex="-1" aria-labelledby="uploadAvatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="uploadAvatarModalLabel">Ubah Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="avatar" class="form-label text-muted small">Pilih Gambar (JPG, PNG, WEBP max 2MB)</label>
                        <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" name="avatar" accept="image/*" required>
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection