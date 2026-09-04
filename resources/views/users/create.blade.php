@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-primary text-white py-3">

                    <h3 class="mb-0">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah User
                    </h3>

                    <small>Masukkan data pengguna baru.</small>

                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.users.store') }}" method="POST">

                        @include('users._form')

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection