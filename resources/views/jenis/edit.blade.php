@extends('layouts.app')

@section('title', 'Edit Jenis')

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
                        <h3 class="fw-bold mb-1">Edit Jenis</h3>
                        <p class="mb-0 text-white-50">Perbarui informasi jenis di bawah ini.</p>
                    </div>
                    
                    
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('jenis.update', $jeni) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    
                </form>
            </div>
        </div>
    </div>
@endsection