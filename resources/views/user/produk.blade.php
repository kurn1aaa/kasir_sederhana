@extends('layouts.app')

@section('content')
<div class="card card-custom p-4 mb-5" style="border: none !important;">
   
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 d-print-none">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Katalog Menu & Live Stok</h4>
            <p class="text-muted small mb-0">Daftar menu aktif etalase barista. Hubungi Administrator jika ada penyesuaian resep atau harga.</p>
        </div>

        <div class="d-flex flex-column flex-sm-row gap-2 align-items-sm-center">
          
            <a href="?printAll=true{{ $search ? '&search='.$search : '' }}" target="_blank" class="btn btn-sm btn-danger px-3 d-flex align-items-center justify-content-center" style="border-radius: 8px; height: 38px; font-size: 13px; text-decoration: none;">
                <i class="fa-solid fa-file-pdf me-1"></i> Cetak PDF / Print
            </a>  

            
            <form action="/user/produk" method="GET" class="d-flex gap-1 align-items-center position-relative m-0">
                <input type="text" name="search" class="form-control form-control-sm rounded-3 pe-5 ps-3" placeholder="Cari menu..." value="{{ $search ?? '' }}" style="border-color: #eedfd4; width: 190px; font-size: 13px; height: 38px;">
                
                @if(!empty($search))
                    <a href="/user/produk" class="text-muted position-absolute hover-danger" style="right: 50px; top: 50%; transform: translateY(-50%); z-index: 5; text-decoration: none; font-size: 14px; cursor: pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
                
                <button type="submit" class="btn btn-sm btn-light border" style="border-color: #eedfd4; border-radius: 8px; background: #fff; height: 38px; width: 38px;">
                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                </button>
            </form>
        </div>
    </div>

    
    <div class="d-none d-print-block mb-4 text-center">
        <h3 class="fw-bold text-dark mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: 1px;">LAPORAN KATALOG MENU & LIVE STOK</h3>
        <p class="text-muted small mb-2">Data Terbuka Unit Kerja Barista Coffeeshop</p>
        <div style="border-bottom: 3px double #3d2c25; width: 100%;"></div>
    </div>

    <!-- TABEL DATA UTAMA -->
    <div class="table-responsive" style="overflow-x: visible !important;">
        <table class="table align-middle" style="width: 100% !important;">
            <thead>
                <tr>
                    <th class="px-3" style="width: 60px;">NO</th>
                    <th>NAMA MENU</th>
                    <th>STASIUN BARISTA</th>
                    <th>HARGA ITEM</th>
                    <th class="text-center">STATUS KETERSEDIAAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $index => $p)
                <tr>
                    <td class="fw-bold px-3 text-muted" style="font-size: 13px;">
                       
                        @if(request()->has('printAll'))
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        @else
                            {{ str_pad($produks->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}
                        @endif
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($p->image)
                                <img src="{{ asset('images/' . $p->image) }}" alt="Foto Menu" class="rounded-3 shadow-sm border border-light" style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded-3 d-print-none" style="width: 48px; height: 48px; font-size: 10px; border: 1px dashed #eedfd4; background-color: #faf7f4 !important;">
                                    <i class="fa-regular fa-image text-muted opacity-50"></i>
                                </div>
                            @endif
                            <div>
                                <span class="fw-semibold text-dark d-block" style="font-size: 15px;">{{ $p->nama_produk }}</span>
                                <span class="text-muted" style="font-size: 11px; letter-spacing: 0.5px;">SKU: #BEANS-0{{ $p->id }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-premium bg-coffee-subtle">{{ $p->kategori->nama_kategori }}</span>
                    </td>
                    <td class="fw-bold text-dark" style="font-size: 15px;">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($p->stok < 30)
                            <span class="badge badge-premium bg-danger-subtle text-danger">
                                Sisa {{ $p->stok }} Porsi
                            </span>
                        @else
                            <span class="badge badge-premium bg-success-subtle text-success">
                                Ready ({{ $p->stok }} pcs)
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    @if(!request()->has('printAll') && method_exists($produks, 'links'))
    <div class="mt-4 d-flex justify-content-between align-items-center flex-column flex-sm-row gap-3 d-print-none" style="font-size: 13px;">
        <span class="text-muted">
            Menampilkan {{ $produks->firstItem() ?? 0 }} - {{ $produks->lastItem() ?? 0 }} dari <strong>{{ $produks->total() }}</strong> menu
        </span>
        
        <nav>
            <ul class="pagination mb-0" style="gap: 6px;">
                @if ($produks->onFirstPage())
                    <li class="page-item disabled"><span class="page-link" style="border-radius: 10px; background: #faf7f4; color: #ccc; border-color: #eedfd4;"><i class="fa-solid fa-chevron-left"></i></span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $produks->previousPageUrl() }}&search={{ $search ?? '' }}" style="border-radius: 10px; border-color: #eedfd4; color: #543d2b; background: #fff;"><i class="fa-solid fa-chevron-left"></i></a></li>
                @endif

                @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
                    @if ($page == $produks->currentPage())
                        <li class="page-item active"><span class="page-link" style="border-radius: 10px; background: #543d2b; border-color: #543d2b; color: #fff;">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}&search={{ $search ?? '' }}" style="border-radius: 10px; border-color: #eedfd4; color: #543d2b; background: #fff;">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a></li>
                    @endif
                @endforeach

                @if ($produks->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $produks->nextPageUrl() }}&search={{ $search ?? '' }}" style="border-radius: 10px; border-color: #eedfd4; color: #543d2b; background: #fff;"><i class="fa-solid fa-chevron-right"></i></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link" style="border-radius: 10px; background: #faf7f4; color: #ccc; border-color: #eedfd4;"><i class="fa-solid fa-chevron-right"></i></span></li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
</div>

<style>
    .hover-danger:hover {
        color: #dc3545 !important;
    }
    @media print {
        body {
            background: #fff !important;
        }
        .card-custom {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
        @page {
            size: landscape;
            margin: 15mm;
        }
    }
</style>


@if(request()->has('printAll'))
<script>
    window.onload = function() {
        window.print();
        setTimeout(function() { window.close(); }, 1000);
    }
</script>
@endif
@endsection