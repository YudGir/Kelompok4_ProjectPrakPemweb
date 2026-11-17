<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboardUser.php");
        exit;
    }

    $saved_user = isset($_COOKIE['ingat_user']) ? $_COOKIE['ingat_user'] : '';
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LootSwap</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center vh-100">

<div class="container">
    <div class="card mx-auto bg-body-tertiary border-secondary shadow-lg" style="max-width: 420px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <a href="index.php" class="text-decoration-none text-warning fs-3 fw-bold">LootSwap</a>
                <p class="text-secondary small mt-1">Masuk ke akunmu untuk mulai barter</p>
            </div>

            <form action="logic/prosesLogin.php" method="POST">
                <div class="mb-3">
                    <label class="form-label small text-secondary">Username</label>
                    <input type="text" name="username" class="form-control bg-dark border-secondary" value="<?= $saved_user; ?>" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small text-secondary">Password</label>
                    <input type="password" name="password" class="form-control bg-dark border-secondary" placeholder="Masukkan password" required>
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small text-secondary" for="remember">Ingat Username Saya</label>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold py-2">Masuk Sekarang</button>
            </form>

            <hr class="border-secondary my-4">
            <p class="text-center small mb-1 text-secondary">Belum punya akun? <a href="register.php" class="text-warning text-decoration-none fw-bold">Daftar di sini</a></p>
            <p class="text-center small mb-0"><a href="index.php" class="text-secondary text-decoration-none">Kembali ke Beranda?</a></p>
        </div>
    </div>
</div>

</body>
</html>
