<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Kasir App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Login Kasir</h3>
                    
                    <!-- Pesan Validasi/Gagal Gara-gara email/password keliru -->
                    @if($errors->any())
                        <div class="alert alert-danger p-2">{{ $errors->first() }}</div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk Aplikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>