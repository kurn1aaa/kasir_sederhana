@extends('layouts.app')

@section('content')
<!-- BARIS KARTU RINGKASAN DASHBOARD (SELALU MUNCUL DI MONITOR, GAIB SAAT DIPRINT) -->
<div class="row mb-4 g-3 d-print-none">
    <div class="col-md-4">
        <div class="card card-custom p-4 d-flex flex-row align-items-center" style="border-radius: 16px; border: 1px solid #eedfd4; background: #fff;">
            <div class="rounded-4 bg-coffee-subtle p-3 me-3" style="background-color: #f5ebe6; color: #543d2b;">
                <i class="fa-solid fa-mug-hot fa-xl"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1 small fw-bold" style="letter-spacing: 0.5px; font-size: 11px;">TOTAL VARIAN MENU</h6>
                <h3 class="fw-bold mb-0 text-dark" style="font-size: 24px;">{{ $totalVarian }} Varian</h3>
            </div>
        </div>
    </div>
   
    <div class="col-md-4">
        <div class="card card-custom p-4 d-flex flex-row align-items-center" style="border-radius: 16px; border: 1px solid #fce8e6; background: #fff;">
            <div class="rounded-4 p-3 me-3" style="background-color: #fce8e6; color: #dc3545;">
                <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1 small fw-bold" style="letter-spacing: 0.5px; font-size: 11px;">STOK KRITIS (&lt; 30)</h6>
                <h3 class="fw-bold mb-0 text-danger" style="font-size: 24px;">{{ $stokKritis }} Menu</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom p-4 d-flex flex-row align-items-center" style="border-radius: 16px; border: 1px solid #eef1f6; background: #fff;">
            <div class="rounded-4 p-3 me-3" style="background-color: #e8f0fe; color: #1a73e8;">
                <i class="fa-solid fa-tags fa-xl"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1 small fw-bold" style="letter-spacing: 0.5px; font-size: 11px;">TOTAL KATEGORI</h6>
                <h3 class="fw-bold mb-0 style-color" style="font-size: 24px; color: #1a73e8;">{{ $totalKategori }} Kategori</h3>
            </div>
        </div>
    </div>
</div>

<!-- TABEL UTAMA -->
<div class="card card-custom p-4 mb-5 card-print-wrapper">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 d-print-none">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Katalog Menu & Stok Gudang</h4>
            <p class="text-muted small mb-0">Kelola racikan produk, harga jual barista, dan sisa porsi tersedia.</p>
        </div>
        
       
        <div class="d-flex gap-2 flex-column flex-sm-row align-items-center">
            <form action="/admin/produk" method="GET" class="d-flex gap-1 align-items-center position-relative m-0">
                <input type="text" name="search" class="form-control form-control-sm rounded-3 pe-5 ps-3" placeholder="Cari menu..." value="{{ $search ?? '' }}" style="border-color: #eedfd4; width: 190px; font-size: 13px; height: 38px;">
                
                @if(!empty($search))
                    <a href="/admin/produk" class="text-muted position-absolute hover-danger" style="right: 52px; top: 50%; transform: translateY(-50%); z-index: 5; text-decoration: none; font-size: 14px; cursor: pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
                
                <button type="submit" class="btn btn-sm btn-light border" style="border-color: #eedfd4; border-radius: 8px; background: #fff; height: 38px; width: 38px;"><i class="fa-solid fa-magnifying-glass text-muted"></i></button>
            </form>

           
            <a href="?printAll=true{{ $search ? '&search='.$search : '' }}" target="_blank" class="btn btn-sm btn-light border d-inline-flex align-items-center justify-content-center" style="border-color: #eedfd4; border-radius: 8px; background: #fff; height: 38px; width: 38px; text-decoration: none;" title="Cetak Laporan PDF">
                <i class="fa-solid fa-print text-danger"></i>
            </a>

            <a href="/admin/produk/create" class="btn-premium-primary text-nowrap text-center d-inline-flex align-items-center justify-content-center" style="height: 38px; text-decoration: none;">
                <i class="fa-solid fa-plus me-2" style="font-size: 12px;"></i>Tambah Menu baru
            </a>
        </div>
    </div>

    @if(session('success') && !request()->has('printAll'))
        <div class="alert alert-success border-0 alert-dismissible fade show rounded-3 p-3 mb-4 bg-success-subtle text-success d-print-none" role="alert" style="font-size: 14px;">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive" style="overflow-x: visible !important;">
        <table class="table align-middle" style="width: 100% !important;">
            <thead>
                <tr>
                    <th class="px-3" style="width: 60px;">NO</th>
                    <th>NAMA MENU</th>
                    <th>STASIUN BARISTA</th>
                    <th>HARGA ITEM</th>
                    <th class="text-center">KETERSEDIAAN</th>
                    <th class="text-end px-3 class-aksi">AKSI KELOLA</th>
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
                                <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded-3 table-no-pic d-print-none" style="width: 48px; height: 48px; font-size: 10px; border: 1px dashed #eedfd4; background-color: #faf7f4 !important;">
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
                                <i class="fa-solid fa-circle-exclamation me-1" style="font-size: 9px;"></i> Sisa {{ $p->stok }} Porsi
                            </span>
                        @else
                            <span class="badge badge-premium bg-success-subtle text-success">
                                <i class="fa-solid fa-circle me-1" style="font-size: 7px; vertical-align: middle;"></i> Ready ({{ $p->stok }} pcs)
                            </span>
                        @endif
                    </td>
                    <td class="text-end px-3 class-aksi">
                        <div class="btn-group shadow-sm rounded-3">
                            <a href="/admin/produk/{{ $p->id }}/edit" class="btn btn-light btn-sm px-3 text-warning border-end" style="background: #fff; border-color: #eedfd4; font-size: 13px; padding: 8px 12px;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="/admin/produk/{{ $p->id }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm px-3 text-danger" style="background: #fff; border-color: #eedfd4; font-size: 13px; padding: 8px 12px;" onclick="return confirm('Hapus menu ini dari daftar?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
    @if(!request()->has('printAll') && method_exists($produks, 'links'))
    <div class="mt-4 d-flex justify-content-between align-items-center flex-column flex-sm-row gap-3 class-pagination d-print-none" style="font-size: 13px;">
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
            color: #000 !important; 
            padding: 10px !important;
            -webkit-print-color-adjust: exact !important; 
            print-color-adjust: exact !important;
        }
        
        .navbar, .sidebar, .class-pagination, .class-aksi, .alert, .d-print-none {
            display: none !important;
        }
        
        .card-print-wrapper { 
            border: none !important; 
            box-shadow: none !important; 
            padding: 0 !important; 
            background: transparent !important;
        }
        
        .table-responsive { 
            overflow: visible !important; 
        }

       
        table { 
            width: 100% !important; 
            border-collapse: collapse !important;
            margin-top: 15px;
        }
        
        th, td { 
            border: 1px solid #111111 !important; 
            border-bottom: 2px solid #111111 !important; 
            padding: 12px 8px !important; 
            color: #000 !important;
            background-color: #fff !important;
        }

        th {
            background-color: #f2f2f2 !important;
            font-weight: bold !important;
        }

        .table-no-pic {
            border: none !important;
            background: transparent !important;
        }
        
        body::before {
            content: "LAPORAN DATA KATALOG & MONITORING STOK KAFE (ADMINISTRATOR)";
            display: block;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: #000;
        }
        
        body::after {
            content: "Dicetak otomatis oleh Sistem Manajemen Inventaris Kafe Berbasis Web";
            display: block;
            text-align: right;
            font-size: 10px;
            font-style: italic;
            margin-top: 20px;
            color: #555;
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