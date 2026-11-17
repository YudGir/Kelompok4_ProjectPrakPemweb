<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Daftar - LootSwap</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="d-flex align-items-center vh-100">

<div class="container">
    <div class="card mx-auto shadow" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="card-title text-center text-warning fw-bold mb-3">Daftar Akun Baru</h4>
            <form action="logic/prosesRegister.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold">Daftar Sekarang</button>
            </form>
            <p class="text-center mt-3 small">Sudah punya akun? <a href="login.php" class="text-warning">Login di sini</a></p>
        </div>
    </div>
</div>

</body>
</html>
