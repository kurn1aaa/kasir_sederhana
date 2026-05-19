@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Live Monitor: Aktivitas Kasir</h2>
        <p class="text-muted">Memantau rekam jejak dan tindakan operasional tim kasir secara real-time.</p>
    </div>

    <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 20px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark m-0">
                <i class="fa-solid fa-user-clock text-coffee me-2"></i>Log Tindakan Kasir Terbaru
            </h5>
            <span class="badge bg-coffee-subtle px-3 py-2 rounded-pill fw-bold">Hari Ini</span>
        </div>

        <div class="d-flex flex-column gap-3">
            <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border-start border-success border-3">
                <span class="badge bg-success p-2.5 rounded-circle mt-1"><i class="fa-solid fa-cart-shopping"></i></span>
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="text-dark">Transaksi Berhasil</strong>
                        <small class="text-muted">Baru saja</small>
                    </div>
                    <p class="text-muted small m-0">Kasir mencetak struk baru untuk pemesanan <span class="text-dark fw-bold">Creamy Vanilla Cold Brew</span>.</p>
                </div>
            </div>

            <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border-start border-warning border-3">
                <span class="badge bg-warning p-2.5 rounded-circle mt-1"><i class="fa-solid fa-clock-rotate-left"></i></span>
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="text-dark">Pengecekan Stok Kritis</strong>
                        <small class="text-muted">12 menit yang lalu</small>
                    </div>
                    <p class="text-muted small m-0">Kasir membuka halaman data produk untuk melihat sisa porsi <span class="text-dark fw-bold">Waffle Ice Cream Sandwich</span>.</p>
                </div>
            </div>

            <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border-start border-success border-3">
                <span class="badge bg-success p-2.5 rounded-circle mt-1"><i class="fa-solid fa-cart-shopping"></i></span>
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="text-dark">Transaksi Berhasil</strong>
                        <strong class="text-dark"></strong>
                        <small class="text-muted">45 menit yang lalu</small>
                    </div>
                    <p class="text-muted small m-0">Kasir melayani pesanan 1x <span class="text-dark fw-bold">Truffle Fries Accord</span> dan 1x <span class="text-dark fw-bold">Classic New York Cheesecake</span>.</p>
                </div>
            </div>

            <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border-start border-info border-3">
                <span class="badge bg-info p-2.5 rounded-circle mt-1"><i class="fa-solid fa-right-to-bracket"></i></span>
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="text-dark">Sesi Masuk (Login)</strong>
                        <small class="text-muted">1 jam yang lalu</small>
                    </div>
                    <p class="text-muted small m-0">Akun user kasir berhasil masuk ke sistem lewat terminal komputer utama.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection