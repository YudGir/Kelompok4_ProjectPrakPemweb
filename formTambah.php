<?php
session_start();

if (!isset($_SESSION["status_login"]) || $_SESSION["status_login"] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item Baru - LootSwap</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboardUser.php">LootSwap Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Item Barter Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="logic/prosesTambah.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="nama_item" class="form-label">Nama Item Anda</label>
                                <input type="text" class="form-control" id="nama_item" name="nama_item" placeholder="Contoh: Akun ML Skin Epic / Exorcist" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_game" class="form-label">Nama Game</label>
                                <input type="text" class="form-control" id="nama_game" name="nama_game" placeholder="Contoh: Mobile Legends, Valorant, Genshin Impact" required>
                            </div>

                            <div class="mb-3">
                                <label for="item_dicari" class="form-label">Item yang Dicari (Barter)</label>
                                <input type="text" class="form-control" id="item_dicari" name="item_dicari" placeholder="Contoh: Cari akun yang ada skin Kof Gusion" required>
                            </div>

                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak yang Bisa Dihubungi</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Contoh: WhatsApp / Telegram (08123456789)" required>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Unggah Foto Item</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                <div class="form-text">Pilih file gambar (JPG, PNG, GIF, WEBP, maks 2 MB). Jika kosong, akan menggunakan gambar default.</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="dashboardUser.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan Item</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>