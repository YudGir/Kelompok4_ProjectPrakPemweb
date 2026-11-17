<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - LootSwap</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

<div class="container">
    <div class="card mx-auto bg-body-tertiary border-secondary shadow-lg" style="max-width: 420px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <a href="index.php" class="text-decoration-none text-warning fs-3 fw-bold">LootSwap</a>
                <p class="text-secondary small mt-1">Buat akun baru dan mulai tukar item</p>
            </div>

            <form action="logic/prosesRegister.php" method="POST">
                <div class="mb-3">
                    <label class="form-label small text-secondary">Username</label>
                    <input type="text" name="username" class="form-control bg-dark border-secondary" placeholder="Pilih username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small text-secondary">Password</label>
                    <input type="password" name="password" class="form-control bg-dark border-secondary" placeholder="Buat password" required>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold py-2">Daftar Sekarang</button>
            </form>

            <hr class="border-secondary my-4">
            <p class="text-center small mb-1 text-secondary">Sudah punya akun? <a href="login.php" class="text-warning text-decoration-none fw-bold">Login di sini</a></p>
            <p class="text-center small mb-0"><a href="index.php" class="text-secondary text-decoration-none">Kembali ke Beranda?</a></p>
        </div>
    </div>
</div>

</body>
</html>
