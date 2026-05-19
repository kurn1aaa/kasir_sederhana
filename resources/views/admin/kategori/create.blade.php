@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="mb-3">
            <a href="/admin/kategori" class="text-decoration-none text-muted small fw-semibold">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Kategori
            </a>
        </div>

        <div class="card card-custom p-4 mb-5">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Tambah Kategori Baru</h4>
                <p class="text-muted small mb-0">Masukkan nama stasiun barista baru ke dalam sistem kafe.</p>
            </div>

            <form action="/admin/kategori" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_kategori" class="form-label fw-bold text-secondary small" style="letter-spacing: 0.5px;">NAMA KATEGORI STASIUN</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control rounded-3 @error('nama_kategori') is-invalid @enderror" placeholder="Contoh: Espresso Bar, Manual Brew" value="{{ old('nama_kategori') }}" style="border-color: #eedfd4; height: 45px; font-size: 14px;" required>
                    @error('nama_kategori')
                        <div class="invalid-feedback mt-2"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="/admin/kategori" class="btn btn-light px-4 border" style="border-radius: 12px; height: 42px; font-size: 14px; border-color: #eedfd4;">Batal</a>
                    <button type="submit" class="btn-premium-primary px-4" style="height: 42px;"><i class="fa-solid fa-floppy-disk me-2"></i> Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection