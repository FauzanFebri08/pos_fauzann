@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')
<div class="produk">
<div class="container my-4">
    <div class="card card-main p-3">
        
        <div class="card-body header-banner p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.85A.5.5 0 0 1 16 3.5v9.75a.5.5 0 0 1-.316.465l-7.5 3a1.5 1.5 0 0 1-1.168 0l-7.5-3A.5.5 0 0 1 0 13.25V3.5a.5.5 0 0 1 .316-.465z"/>
                    </svg>
                    Manajemen Produk
                </h3>
                <p class="mb-0 header-banner-subtitle small">Kelola seluruh data barang, harga, dan stok produk.</p>
            </div>
            
            @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-light fw-bold px-3 py-2 rounded-3 text-primary d-flex align-items-center gap-1 shadow-sm">
                    <span class="fs-5">+</span> Tambah Produk
                </a>
            @endcan
        </div>

        <div class="px-2">
            <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        class="form-control py-2 ps-3 input-search" 
                        placeholder="Cari nama produk..."
                    >
                    <button class="btn btn-primary px-4 fw-semibold btn-search" type="submit">
                     Search
                    </button>
                </div>
            </form>
            

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="fw-bold text-secondary">#</th>
                            <th scope="col" class="fw-bold text-secondary">Foto</th>
                            <th scope="col" class="fw-bold text-secondary">Nama</th>
                            <th scope="col" class="fw-bold text-secondary">Jenis</th>
                            <th scope="col" class="fw-bold text-secondary">User</th>
                            <th scope="col" class="fw-bold text-secondary">Harga Beli</th>
                            <th scope="col" class="fw-bold text-secondary">Harga Jual</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Stok</th>
                            <th scope="col" class="fw-bold text-secondary text-center">Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row" class="text-secondary fw-normal">{{ $products->firstItem() + $loop->index }}</th>
                                <td>
                                    <img src="{{ asset('storage/' . $product->foto) }}" 
                                        alt="{{ $product->nama }}" 
                                        class="rounded-3 img-thumbnail img-product-thumb">
                                </td>
                                <td class="fw-bold text-dark">{{ $product->nama }}</td>
                                <td>{{ $product->jenis->nama_jenis ?? '-' }}</td>
                                <td class="text-secondary">{{ $product->user->name }}</td>
                                <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                <td class="fw-semibold text-success">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill {{ $product->stok > 5 ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                        {{ $product->stok }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        @can('update', $product)
                                            <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning btn-sm text-white rounded-3 px-2">
                                            edit
                                            </a>
                                        @endcan

                                        @can('delete', $product)
                                            <form action="{{ route('produk.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm rounded-3 px-2">
                                                hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <h5 class="fw-bold text-secondary mb-0">Data tidak tersedia.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
</div>

@endsection