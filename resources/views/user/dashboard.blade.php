@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Selamat Bekerja, {{ auth()->user()->name }}!</h2>
        <p class="text-muted">Semangat shiftnya hari ini. Tetap jaga konsistensi rasa racikan terbaikmu.</p>
    </div>

    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-danger m-0">⚠️ Peringatan Stok Menipis</h5>
            <span class="badge bg-danger px-2.5 py-1.5 rounded-3 fw-bold">4 Item Perlu Dipantau</span>
        </div>
        
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 border-start border-danger border-3">
                <div>
                    <strong class="text-dark">Truffle Fries Accord</strong>
                    <br>
                    <small class="text-muted">Kategori: Bakery & Pastry</small>
                </div>
                <span class="badge bg-danger px-3 py-2 rounded-pill">Sisa 20 Porsi</span>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 border-start border-danger border-3">
                <div>
                    <strong class="text-dark">Classic New York Cheesecake</strong>
                    <br>
                    <small class="text-muted">Kategori: Bakery & Pastry</small>
                </div>
                <span class="badge bg-danger px-3 py-2 rounded-pill">Sisa 15 Porsi</span>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 border-start border-danger border-3">
                <div>
                    <strong class="text-dark">Waffle Ice Cream Sandwich</strong>
                    <br>
                    <small class="text-muted">Kategori: Bakery & Pastry</small>
                </div>
                <span class="badge bg-danger px-3 py-2 rounded-pill">Sisa 12 Porsi</span>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 border-start border-danger border-3">
                <div>
                    <strong class="text-dark">Creamy Vanilla Cold Brew</strong>
                    <br>
                    <small class="text-muted">Kategori: Coffee & Beverage</small>
                </div>
                <span class="badge bg-danger px-3 py-2 rounded-pill">Sisa 12 Porsi</span>
            </div>
        </div>
    </div>
</div>
@endsection