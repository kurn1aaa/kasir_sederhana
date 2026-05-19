@extends('layouts.app')

@section('content')
<div class="card p-4 shadow col-md-6 mx-auto" style="border-radius: 15px; border-color: #eedfd4;">
    <h4 class="fw-bold text-dark mb-1">Edit Data Produk</h4>
    <p class="text-muted small">Sesuaikan detail informasi menu atau perbarui foto etalase.</p>
    <hr class="mt-2 mb-4" style="border-color: #eedfd4;">
    
    <!-- PENTING: Menambahkan enctype="multipart/form-data" agar file foto baru bisa terkirim -->
    <form action="/admin/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control rounded-3" value="{{ $produk->nama_produk }}" required style="border-color: #eedfd4;">
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Kategori</label>
            <select name="kategori_id" class="form-control rounded-3" required style="border-color: #eedfd4;">
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Harga</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted" style="border-color: #eedfd4;">Rp</span>
                    <input type="number" name="harga" class="form-control rounded-end-3" value="{{ $produk->harga }}" required style="border-color: #eedfd4;">
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Stok</label>
                <input type="number" name="stok" class="form-control rounded-3" value="{{ $produk->stok }}" required style="border-color: #eedfd4;">
            </div>
        </div>

        <!-- INPUT FOTO BARU & PRATINJAU FOTO LAMA -->
        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary" style="font-size: 13px;">Ganti Foto Menu <span class="text-muted fw-normal">(Kosongkan jika tidak diubah)</span></label>
            
            <!-- Jika sebelumnya sudah ada gambar, tampilkan pratinjaunya di sini -->
            @if($produk->image)
                <div class="mb-2 d-flex align-items-center gap-2 p-2 rounded-3 border" style="background-color: #faf7f4; border-color: #eedfd4 !important; width: fit-content;">
                    <img src="{{ asset('images/' . $produk->image) }}" alt="Foto Lama" class="rounded-2 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                    <span class="text-muted" style="font-size: 11px;">Foto saat ini aktif</span>
                </div>
            @endif

            <input type="file" name="image" class="form-control rounded-3" accept="image/*" style="border-color: #eedfd4;">
            <div class="form-text text-muted" style="font-size: 11px;">Format: JPG, JPEG, PNG. Maksimal ukuran file 2MB.</div>
        </div>
        
        <div class="d-flex gap-2 justify-content-end mt-4">
            <a href="/admin/produk" class="btn btn-sm btn-light border px-3 py-2 rounded-3" style="border-color: #eedfd4; color: #543d2b;">Batal</a>
            <button type="submit" class="btn btn-sm text-white px-4 py-2 rounded-3" style="background: #543d2b;">Perbarui Data</button>
        </div>
    </form>
</div>
@endsection