<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coffeeshop.kasir</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #fcfaf7; 
            color: #3d2c25;
        }
        .brand-title {
            font-family: 'Instrument Serif', serif;
            font-size: 26px;
            letter-spacing: 0.5px;
            color: #f7ebe1;
        }
        .sidebar { 
            background: #1c120c; 
            min-height: 100vh; 
            color: #fff; 
            box-shadow: 6px 0 30px rgba(28, 18, 12, 0.04);
        }
        .sidebar .nav-link { 
            color: rgba(255, 255, 255, 0.45); 
            font-weight: 500; 
            font-size: 14px;
            padding: 12px 20px; 
            border-radius: 14px; 
            margin: 8px 16px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            background: #3a2619; /* Warm Oak */
            color: #fff; 
            transform: translateX(4px);
        }
        .navbar-custom { 
            background-color: rgba(255, 255, 255, 0.85); 
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #eedfd4;
        }
        .card-custom { 
            border: 1px solid rgba(238, 223, 212, 0.5); 
            border-radius: 24px; 
            background: #ffffff;
            box-shadow: 0 12px 35px rgba(43, 30, 22, 0.015); 
        }
        
        /* PREMIUM FLOATING BUTTONS */
        .btn-premium-primary {
            background: #543d2b !important;
            color: #ffffff !important;
            border: none !important;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(84, 61, 43, 0.18);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-premium-primary:hover {
            background: #3d2c1f !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(84, 61, 43, 0.3);
        }
        .btn-premium-danger {
            background: #fff0f0 !important;
            color: #d94141 !important;
            border: 1px solid #fcdada !important;
            font-weight: 600;
            font-size: 13px;
            padding: 8px 18px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-premium-danger:hover {
            background: #d94141 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217, 65, 65, 0.2);
        }

        /* TEXT & BADGES */
        .text-coffee { color: #543d2b !important; }
        .bg-coffee-subtle {
            background-color: #f5ebe6 !important;
            color: #543d2b !important;
        }
        .table th {
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.8px;
            color: #8c776c !important;
            background: #faf7f4 !important;
            border-bottom: 1px solid #eedfd4 !important;
            padding: 16px 14px !important;
        }
        .table td {
            padding: 18px 14px !important;
            border-bottom: 1px solid #f7ebe1 !important;
            color: #4a372c;
        }
        .table tr:last-child td { border-bottom: none !important; }
        .badge-premium {
            font-size: 11px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
        }

        /* ===================================================
           👑 TACTICAL PRINT ENGINE (SOLUSI BIAR GA KEBACOK SETENGAH)
           =================================================== */
        @media print {
            /* 1. Hilangkan Navbar Atas, Tombol Logout, dan Sidebar secara absolut */
            .sidebar, .navbar-custom, .d-print-none {
                display: none !important;
            }
            
            /* 2. Reset paksa layout kolom Bootstrap agar mengalir penuh 100% layar kertas */
            .col-md-9, .col-lg-10, .ms-auto {
                width: 100% !important;
                margin-left: 0 !important;
                left: 0 !important;
                position: relative !important;
                padding: 0 !important;
            }

            body {
                background-color: #ffffff !important;
                color: #000000 !important;
                font-size: 12px;
            }

            /* 3. Hilangkan bayangan card dan border melengkung ekstrim agar rapi di kertas */
            .card-custom {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                background: transparent !important;
            }

            /* 4. Pastikan tabel tidak terpotong di tengah baris (Page Break Optimize) */
            tr {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }
            
            thead {
                display: table-header-group !important; /* Kepala tabel muncul berulang jika kertas lebih dari 1 halaman */
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR (Otomatis Hilang Saat Print Berkat d-print-none & CSS) -->
        <div class="col-md-3 col-lg-2 px-0 sidebar d-none d-md-block position-fixed d-print-none">
            <div class="p-4 text-center border-bottom border-secondary border-opacity-25 mb-3">
                <h5 class="fw-bold mb-0 brand-title" style="font-size: 24px;">
                    <i class="fa-solid fa-mug-hot me-2" style="font-size: 18px;"></i>coffeeshop<span style="color: #eddcd2; opacity: 0.5;">.</span>kasir
                </h5>
                <small class="text-muted" style="font-size: 10px; letter-spacing: 2.5px; opacity: 0.7;">BARISTA INTERFACE</small>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/{{ auth()->user()->role->nama_role }}/produk">
                        <i class="fa-solid fa-mug-saucer me-2"></i> Menu & Stok
                    </a>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT AREA (Otomatis Melebar 100% Saat Print) -->
        <div class="col-md-9 col-lg-10 ms-auto px-0">
            <!-- NAVBAR ATAS (Otomatis Hilang Saat Print Berkat d-print-none) -->
            <nav class="navbar navbar-expand navbar-light navbar-custom px-4 py-3 mb-4 d-print-none">
                <div class="container-fluid px-0 d-flex justify-content-between">
                    <span class="navbar-text fw-medium text-muted" style="font-size: 14px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> System Active • 
                        <span class="text-dark fw-bold">{{ auth()->user()->name }}</span> 
                        <span class="badge bg-coffee-subtle border border-secondary border-opacity-10 ms-1" style="font-size: 10px;">{{ ucfirst(auth()->user()->role->nama_role) }}</span>
                    </span>
                    
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="btn-premium-danger" type="submit">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1" style="font-size: 12px;"></i> Log Out
                        </button>
                    </form>
                </div>
            </nav>

            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>