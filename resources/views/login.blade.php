@extends('layouts.app') 

@section('title', 'Login - POS')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="login-wrapper d-flex justify-content-center align-items-center">
    <div class="card border-0 shadow-lg p-3 p-md-4 float-card" style="width: 100%; max-width: 420px; border-radius: 20px; background-color: #ffffff;">
        <div class="card-body">
            
          
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm text-white" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4397ff, #092e55);">
                    <i class="fa-solid fa-store fa-xl"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1">Selamat Datang</h3>
                <p class="text-muted small mb-0">Masuk ke akun POS Anda untuk melanjutkan</p>
            </div>

           
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                
             
                <div class="mb-3">
                    <label for="emailInput" class="form-label fw-semibold small text-secondary">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               class="form-control bg-light border-start-0 ps-0 @error('email') is-invalid @enderror" 
                               id="emailInput" 
                               placeholder="nama@email.com" 
                               value="{{ old('email') }}" 
                               style="border-radius: 0 10px 10px 0; height: 45px;"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

               
                <div class="mb-3">
                    <label for="passwordInput" class="form-label fw-semibold small text-secondary">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               class="form-control bg-light border-start-0 ps-0 @error('password') is-invalid @enderror" 
                               id="passwordInput" 
                               placeholder="••••••••" 
                               style="border-radius: 0 10px 10px 0; height: 45px;"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                        <label class="form-check-label small text-muted" for="rememberMe">
                            Ingat Saya
                        </label>
                    </div>
                </div>

         
                <div class="d-grid gap-2">
                    <button type="submit" class="btn text-white fw-bold py-2 shadow-sm" style="background: linear-gradient(135deg, #2d72f1, #092e55); border-radius: 10px; height: 45px;">
                        Masuk <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
    /* Mengunci tampilan agar background benar-benar memenuhi seluruh layar */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .login-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: linear-gradient(135deg, #092e55 0%, #2d72f1 100%);
        z-index: 9999;
        padding: 15px;
    }

    .float-card {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
        transition: transform 0.3s ease;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #2d72f1;
    }

    .input-group:focus-within .input-group-text {
        border-color: #2d72f1;
        color: #2d72f1 !important;
    }
</style>

@endsection