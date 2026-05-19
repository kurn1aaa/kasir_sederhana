@extends('layouts.app')

@section('content')
<div class="card p-4 shadow col-md-6 mx-auto" style="border-radius: 15px; border-color: #eedfd4;">
    <h4 class="fw-bold text-dark mb-1">Tambah Produk Baru</h4>
    <p class="text-muted small">Racik varian menu baru untuk etalase penjualan barista.</p>
    <hr class="mt-2 mb-4" style="border-color: #eedfd4;">
    
    <!-- 1. PENTING: Menambahkan enctype="multipart/form-data" agar bisa kirim file gambar -->
    <form action="/admin/produk" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control rounded-3" placeholder="Contoh: Es Kopi Susu Gula Aren" required style="border-color: #eedfd4;">
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Kategori</label>
            <select name="kategori_id" class="form-control rounded-3" required style="border-color: #eedfd4;">
                <option value="" disabled selected>-- Pilih Stasiun Barista --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Harga</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted" style="border-color: #eedfd4;">Rp</span>
                    <input type="number" name="harga" class="form-control rounded-end-3" placeholder="0" required style="border-color: #eedfd4;">
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Stok Awal</label>
                <input type="number" name="stok" class="form-control rounded-3" placeholder="0" required style="border-color: #eedfd4;">
            </div>
        </div>

        <!-- 2. PENTING: Input File untuk Foto Menu Kopi -->
        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Foto Menu <span class="text-muted fw-normal">(Opsional)</span></label>
            <input type="file" name="image" class="form-control rounded-3" accept="image/*" style="border-color: #eedfd4;">
            <div class="form-text text-muted" style="font-size: 11px;">Format: JPG, JPEG, PNG. Maksimal ukuran file 2MB.</div>
        </div>
        
        <div class="d-flex gap-2 justify-content-end mt-4">
            <a href="/admin/produk" class="btn btn-sm btn-light border px-3 py-2 rounded-3" style="border-color: #eedfd4; color: #543d2b;">Kembali</a>
            <button type="submit" class="btn btn-sm text-white px-4 py-2 rounded-3" style="background: #543d2b;">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection