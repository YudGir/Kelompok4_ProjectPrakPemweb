<?php
    session_start();
    include 'config/koneksi.php';

    function e($teks) {
        return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
    }

    $query = "SELECT items.*, users.username FROM items
              JOIN users ON items.user_id = users.id
              ORDER BY items.id DESC";
    $result = mysqli_query($koneksi, $query);

    $sudah_login = isset($_SESSION['status_login']) && $_SESSION['status_login'] === true;
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LootSwap - Barter Item Game</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-warning fs-4" href="index.php">
            LootSwap
        </a>
        <div class="d-flex gap-2">
            <?php if ($sudah_login): ?>
                <a href="dashboardUser.php" class="btn btn-outline-warning btn-sm px-3">Dashboard</a>
                <a href="logic/prosesLogout.php" class="btn btn-danger btn-sm px-3">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light btn-sm px-3">Login</a>
                <a href="register.php" class="btn btn-warning btn-sm fw-bold px-3">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="bg-body-tertiary border-bottom border-secondary py-5 mb-5">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">Tempat Barter Item Virtual</h1>
        <p class="lead text-secondary mb-4 mx-auto" style="max-width: 600px;">
            Tukarkan skin, senjata, dan item game favoritmu dengan pemain lain dengan mudah.
        </p>
        <div class="input-group mx-auto shadow-sm" style="max-width: 550px;">
            <input type="text" id="searchInput" onkeyup="cariItem()" class="form-control form-control-lg bg-dark border-secondary text-light" placeholder="Cari nama item atau nama game...">
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4" id="daftarItem">
        <?php if (mysqli_num_rows($result) == 0): ?>
            <div class="col-12 text-center py-5 text-secondary">
                <p>Belum ada item yang diposting. Yuk login dan jadi yang pertama!</p>
            </div>
        <?php endif; ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 item-card">
                <div class="card h-100 bg-body-tertiary border-secondary shadow">
                    <img src="uploads/<?= e($row['gambar']); ?>" class="card-img-top border-bottom border-secondary" style="height: 210px; object-fit: cover;" alt="Gambar Item">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <?php if ($row['status'] == 'Tersedia'): ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Sudah Ditukar</span>
                            <?php endif; ?>
                            <span class="badge bg-dark border border-secondary"><?= e($row['nama_game']); ?></span>
                        </div>

                        <h5 class="card-title fw-bold text-warning mt-2"><?= e($row['nama_item']); ?></h5>
                        <p class="card-text small mb-2">
                            <span class="text-secondary">Dicari:</span> <strong class="text-light"><?= e($row['item_dicari']); ?></strong>
                        </p>
                        <p class="card-text text-secondary small mb-0">
                            Pemilik: @<?= e($row['username']); ?>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top border-secondary pt-3 pb-3">
                        <?php if ($row['status'] == 'Tersedia'): ?>
                            <button class="btn btn-warning w-100 fw-bold btn-barter"
                                    data-item="<?= e($row['nama_item']); ?>"
                                    data-kontak="<?= e($row['kontak']); ?>">
                                Ajukan Barter
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>Item Sudah Ditukar</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<footer class="bg-black text-center text-secondary py-3 border-top border-secondary mt-auto">
    <small>&copy; 2026 LootSwap - Proyek Praktikum Pemrograman Web</small>
</footer>

<script>
    function cariItem() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let cards = document.getElementsByClassName('item-card');

        for (let i = 0; i < cards.length; i++) {
            let isiCard = cards[i].innerText.toLowerCase();
            cards[i].style.display = isiCard.includes(input) ? "" : "none";
        }
    }

    function infoKontak(namaItem, kontak) {
        alert("Tertarik menukar '" + namaItem + "'?\n\nSilakan hubungi pemilik item melalui:\n" + kontak);
    }

    const tombolBarter = document.querySelectorAll('.btn-barter');
    tombolBarter.forEach(function (tombol) {
        tombol.addEventListener('click', function () {
            infoKontak(tombol.dataset.item, tombol.dataset.kontak);
        });
    });
</script>

</body>
</html>