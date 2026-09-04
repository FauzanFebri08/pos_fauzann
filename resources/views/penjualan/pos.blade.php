@extends('layouts.app')

@section('title', 'POS - Transaksi Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container my-4">
    <div class="card border-0 shadow-sm rounded-4 p-3">
        
        <div class="card-body bg-primary text-white rounded-4 p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1">
                    Tambah dan Edit Penjualan
                </h3>
                <p class="mb-0 text-white-50 small">Pilih produk dan tuntaskan transaksi penjualan kasir.</p>
            </div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-light text-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                Kembali
            </a>
        </div>

        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 mx-2" role="alert">
                {{ session('errors') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="px-2">
            <div class="row g-4">

                {{-- ================ PRODUK (KOLOM KIRI) ================ --}}
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-3">Daftar Produk</h5>
                    
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-light">
                        <div class="mb-3">
                            <form method="GET" action="{{ route('penjualan.create') }}">
                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control form-control-lg bg-white border-1 rounded-3 fs-6"
                                    placeholder="Cari produk..."
                                    onkeyup="this.form.submit()">
                            </form>
                        </div>

                        <div class="pos-product-wrapper">
                            @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 align-items-center pos-product-item mx-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="col-7">
                                    <div class="pos-product-name">{{ $product->nama }}</div>
                                    <small class="pos-product-price">Rp {{ number_format($product->harga_jual) }}</small>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1" 
                                    class="form-control text-center py-1 {{ $sale->status === 'COMPLETED' ? 'disabled' : ''}}">
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-primary fw-bold w-100 py-1 rounded-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : ''}}">+</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ================ KERANJANG BELANJA (KOLOM KANAN) ================ --}}
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-3">Keranjang Belanja</h5>
                    
                    <div class="pos-cart-container card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="fw-bold text-secondary ps-3">Produk</th>
                                        <th scope="col" class="fw-bold text-secondary">Harga</th>
                                        <th scope="col" class="fw-bold text-secondary text-center">Qty</th>
                                        <th scope="col" class="fw-bold text-secondary">Subtotal</th>
                                        <th scope="col" class="fw-bold text-secondary text-center pe-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sale->itemPenjualan as $item)
                                    <tr>
                                        <td class="ps-3 fw-semibold text-dark">{{ $item->produk->nama }}</td>
                                        <td class="text-nowrap">Rp {{ number_format($item->produk->harga_jual) }}</td>
                                        <td style="width: 90px;" class="text-center">
                                            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                @csrf 
                                                @method('PUT')
                                                <input type="number" name="quantity"
                                                    value="{{ $item->kuantitas }}"
                                                    class="form-control form-control-sm text-center fw-bold"
                                                    onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="fw-bold text-dark text-nowrap">Rp {{ number_format($item->subtotal) }}</td>
                                        <td class="text-center pe-3">
                                            @can('delete', $item)
                                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                                @csrf 
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm px-2 py-0 rounded-2" onclick="return confirm('Hapus item?')" title="Hapus Item">
                                                    Hapus
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Keranjang masih kosong.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-light p-3 border-top-0">
                            <div class="d-flex justify-content-between align-items-center pos-total-box mb-3">
                                <span class="fw-semibold text-secondary">Total Pembayaran:</span>
                                <strong class="pos-total-amount">Rp {{ number_format($sale->total_pembayaran) }}</strong>
                            </div>
                            
                            <form 
                                method="POST" 
                                action="{{ route('penjualan.update', $sale->id) }}"
                                onsubmit="return confirm('Selesaikan Transaksi?')" class="mb-2">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-2">
                                    <select name="payment_method" class="form-select py-2 fw-semibold" required>
                                        <option value="">-- Pilih Metode Pembayaran --</option>
                                        <option value="CASH" {{ $sale->metode_pembayaran == 'CASH' ? 'selected' : '' }}>Cash (Tunai)</option>
                                        <option value="QRIS" {{ $sale->metode_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS (Non-Tunai)</option>
                                    </select>
                                </div>

                                <button class="btn btn-success fw-bold w-100 py-2 fs-6 rounded-3 shadow-sm {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    CHECKOUT
                                </button>
                            </form>

                            @can('delete', $sale)
                            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger fw-semibold w-100 py-2 rounded-3 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    Batalkan Transaksi
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection