@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('layouts.navbar')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div style="background-color: #fdfeff;" class="min-vh-100 py-4">
    <div class="container-fluid px-4">
        
        <!-- Header Dashboard -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-4 mb-4 rounded-4 shadow-sm text-white float-card" 
             style="background: linear-gradient(135deg, #2d72f1, #092e55);">
            <div>
                <h2 class="fw-bold mb-1">Dashboard Ringkasan</h2>
                <p class="mb-0 text-white-50">Pantau performa penjualan dan status stok barang hari ini secara real-time.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <span class="badge bg-white text-primary shadow-sm p-2 px-3 fs-6 fw-semibold rounded-3 d-inline-flex align-items-center gap-2">
                    <i class="fa-regular fa-calendar-days"></i>
                    {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        @can('viewany', App\Models\User::class)
        
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wide">
                <i class="fa-solid fa-chart-line me-2"></i>Ringkasan Penjualan Hari Ini
            </h6>
            <div class="row g-3">
               
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #4397ff, #092e55); border-radius: 14px;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-white-50 small text-uppercase fw-semibold">Total Nilai Penjualan</span>
                                <i class="fa-solid fa-wallet fs-4 text-white-50"></i>
                            </div>
                            <h3 class="fw-bold mb-0">
                                Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>

                
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #092e55, #4397ff); border-radius: 14px;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-white-50 small text-uppercase fw-semibold">Jumlah Transaksi</span>
                                <i class="fa-solid fa-receipt fs-4 text-white-50"></i>
                            </div>
                            <h3 class="fw-bold mb-0">
                                {{ number_format($ringkasan['total_transaksi']) }} <span class="fs-6 text-white-50 fw-normal">Transaksi</span>
                            </h3>
                        </div>
                    </div>
                </div>

               
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #092e55, #4397ff); border-radius: 14px;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-white-50 small text-uppercase fw-semibold">Pembayaran Tunai</span>
                                <i class="fa-solid fa-money-bill-wave fs-4 text-white-50"></i>
                            </div>
                            <h3 class="fw-bold mb-0">
                                Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>

                
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 text-white h-100 float-card" style="background: linear-gradient(135deg, #4397ff, #092e55); border-radius: 14px;">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-white-50 small text-uppercase fw-semibold">Pembayaran Non-Tunai</span>
                                <i class="fa-solid fa-credit-card fs-4 text-white-50"></i>
                            </div>
                            <h3 class="fw-bold mb-0">
                                Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

       
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wide">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>Status Stok Kritis
            </h6>
            <div class="row g-4">
                <!-- Stok Rendah -->
                <div class="col-12 col-lg-6">
                    <div class="card border-0 h-100 rounded-3 overflow-hidden float-card">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h6 class="m-0 fw-bold" style="color: #092e55;">
                                <i class="fa-solid fa-box-open me-2 text-warning"></i>Daftar Produk Stok Rendah
                            </h6>
                            <span class="badge bg-warning-subtle text-warning fw-semibold">Perlu Restock</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th scope="col" class="ps-3" width="10%">#</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col" class="text-end pe-3">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="ps-3 text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-end pe-3">
                                            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill">{{ $produk->stok }} Pcs</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4 small">
                                            <i class="fa-regular fa-circle-check text-success d-block fs-4 mb-2"></i>
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($produkStokRendah->hasPages())
                        <div class="card-footer bg-white border-top-0 pt-3">
                            {{ $produkStokRendah->links() }}
                        </div>
                        @endif
                    </div>
                </div>

                
                <div class="col-12 col-lg-6">
                    <div class="card border-0 h-100 rounded-3 overflow-hidden float-card">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h6 class="m-0 fw-bold" style="color: #092e55;">
                                <i class="fa-solid fa-boxes-packing me-2 text-danger"></i>Produk Habis Stok
                            </h6>
                            <span class="badge bg-danger-subtle text-danger fw-semibold">Segera Isi</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th scope="col" class="ps-3" width="10%">#</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col" class="text-end pe-3">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="ps-3 text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                        <td class="text-end pe-3">
                                            <span class="badge bg-secondary text-white fw-bold px-3 py-2 rounded-pill">{{ $produk->stok }} Pcs</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center py-4 small">
                                            <i class="fa-regular fa-circle-check text-success d-block fs-4 mb-2"></i>
                                            Tidak ada produk yang habis stok.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($produkStokHabis->hasPages())
                        <div class="card-footer bg-white border-top-0 pt-3">
                            {{ $produkStokHabis->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
        <div class="mb-4">
            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wide">
                <i class="fa-solid fa-fire me-2 text-danger"></i>Best Seller Produk
            </h6>
            <div class="card border-0 rounded-3 overflow-hidden float-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted small">
                            <tr>
                                <th scope="col" class="ps-4">Nama Produk</th>
                                <th scope="col" class="text-center">Sisa Stok</th>
                                <th scope="col" class="text-end pe-4">Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">{{ $produk->nama }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">{{ $produk->stok }} Pcs</span>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="badge px-3 py-2 fs-6 fw-normal text-white rounded-pill" style="background-color: #2d72f1;">
                                        <i class="fa-solid fa-arrow-trend-up me-1"></i>{{ $produk->total_terjual }} unit
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center py-4 small">
                                    Belum ada data transaksi penjualan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .tracking-wide {
        letter-spacing: 0.05em;
    }
    .float-card {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
    }

    .float-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15), 0 10px 15px -5px rgba(0, 0, 0, 0.08);
    }
</style>
@endsection