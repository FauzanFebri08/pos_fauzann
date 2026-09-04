@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<div class="users">
  <div class="container py-4">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">

            <div>
                <h2 class="mb-0">
                    <i class="bi bi-people-fill"></i>
                    Manajemen Users
                </h2>
                <small>Kelola seluruh akun pengguna sistem.</small>
            </div>

            <a href="{{ route('admin.users.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i>
                Tambah User
            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.users') }}" method="GET" class="row g-2 mb-4">

                <div class="col-md-10">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari username atau email...">
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                    <tr>
                        <th width="70">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="180">Aksi</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>{{ $users->firstItem() + $loop->index }}</td>

                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>

                                @if($user->role->name == 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-success">
                                        {{ ucfirst($user->role->name) }}
                                    </span>
                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.users.edit', $user) }}"
                                
                                   class="btn btn-warning btn-sm">
                                    edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      class="d-inline ">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus user ini?')">

                                        hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1"></i><br>
                                Belum ada data user.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>

        </div>

    </div>

  </div>
</div>

@endsection