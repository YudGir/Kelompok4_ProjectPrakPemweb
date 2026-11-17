<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboardUser.php");
    exit;
}

//cek cookie, kalo user pilih
$saved_user = isset($_COOKIE['ingat_user']) ? $_COOKIE['ingat_user'] : '';
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Login - LootSwap</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="d-flex align-items-center vh-100">

<div class="container">
    <div class="card mx-auto shadow" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="card-title text-center text-warning fw-bold mb-3">Login LootSwap</h4>
            <form action="logic/prosesLogin.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $saved_user; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ingat Username Saya</label>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold">Masuk</button>
            </form>
            <p class="text-center mt-3 small">Belum punya akun? <a href="register.php" class="text-warning">Daftar di sini</a></p>
            <p class="text-center small"><a href="index.php" class="text-secondary">← Kembali ke Beranda</a></p>
        </div>
    </div>
</div>

</body>
</html>
