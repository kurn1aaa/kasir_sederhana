@extends('layouts.app')

@section('content')
<div class="row mb-4 g-3 d-print-none">
    <div class="col-md-12">
        <div class="card card-custom p-4 d-flex flex-row align-items-center" style="border-radius: 16px; border: 1px solid #eedfd4; background: #fff;">
            <div class="rounded-4 bg-coffee-subtle p-3 me-3" style="background-color: #f5ebe6; color: #543d2b;">
                <i class="fa-solid fa-tags fa-xl"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1 small fw-bold" style="letter-spacing: 0.5px; font-size: 11px;">TOTAL KATEGORI STASIUN</h6>
                <h3 class="fw-bold mb-0 text-dark" style="font-size: 24px;">{{ $kategoris->count() }} Kategori</h3>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom p-4 mb-5 card-print-wrapper">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 d-print-none">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Daftar Kategori Stasiun Barista</h4>
            <p class="text-muted small mb-0">Kelola pengelompokan menu kafe untuk mempermudah manajemen stok gudang.</p>
        </div>
        
        <div class="d-flex gap-2 align-items-center justify-content-end">
            <a href="/admin/kategori/create" class="btn-premium-primary text-nowrap text-center d-inline-flex align-items-center justify-content-center" style="height: 38px; text-decoration: none;">
                <i class="fa-solid fa-plus me-2" style="font-size: 12px;"></i>Tambah Kategori Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show rounded-3 p-3 mb-4 bg-success-subtle text-success d-print-none" role="alert" style="font-size: 14px;">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive" style="overflow-x: visible !important;">
        <table class="table align-middle" style="width: 100% !important;">
            <thead>
                <tr>
                    <th class="px-3" style="width: 80px;">NO</th>
                    <th>NAMA KATEGORI STASIUN</th>
                    <th class="text-end px-3">AKSI KELOLA</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $index => $k)
                <tr>
                    <td class="fw-bold px-3 text-muted" style="font-size: 13px;">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-folder text-coffee opacity-50 me-1" style="font-size: 16px;"></i>
                            <span class="fw-semibold text-dark" style="font-size: 15px;">{{ $k->nama_kategori }}</span>
                        </div>
                    </td>
                    <td class="text-end px-3">
                        <div class="btn-group shadow-sm rounded-3">
                            <a href="/admin/kategori/{{ $k->id }}/edit" class="btn btn-light btn-sm px-3 text-warning border-end" style="background: #fff; border-color: #eedfd4; font-size: 13px; padding: 8px 12px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="/admin/kategori/{{ $k->id }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm px-3 text-danger" style="background: #fff; border-color: #eedfd4; font-size: 13px; padding: 8px 12px;" onclick="return confirm('Hapus kategori ini?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted small">
                        <i class="fa-solid fa-tags fa-2x d-block mb-3 opacity-20"></i>
                        Belum ada data kategori stasiun yang terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection