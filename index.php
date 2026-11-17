<?php
    session_start();
    include 'config/koneksi.php';

    $query = "SELECT items.*, users.username FROM items 
            JOIN users ON items.user_id = users.id 
            ORDER BY items.id DESC";
    $result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>LootSwap - Barter Item Game</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-warning" href="index.php">LootSwap</a>
        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboardUser.php" class="btn btn-outline-warning btn-sm">Dashboard Saya</a>
                <a href="logic/prosesLogout.php" class="btn btn-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light btn-sm">Login</a>
                <a href="register.php" class="btn btn-warning btn-sm">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Tempat Barter Item Virtual</h2>
        <p class="text-secondary">Tukarkan skin, senjata, dan item game kamu dengan aman!</p>
        <input type="text" id="searchInput" onkeyup="cariItem()" class="form-control w-50 mx-auto" placeholder="Ketik nama item atau nama game...">
    </div>

    <div class="row" id="daftarItem">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4 item-card">
                <div class="card h-100 shadow-sm border-secondary">
                    <img src="uploads/<?= $row['gambar']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Gambar Item">
                    
                    <div class="card-body">
                        <span class="badge bg-primary mb-2"><?= $row['nama_game']; ?></span>
                        <?php if ($row['status'] == 'Tersedia'): ?>
                            <span class="badge bg-success mb-2">Tersedia</span>
                        <?php else: ?>
                            <span class="badge bg-secondary mb-2">Sudah Ditukar</span>
                        <?php endif; ?>

                        <h5 class="card-title fw-bold text-warning"><?= $row['nama_item']; ?></h5>
                        <p class="card-text mb-1"><strong>Dicari:</strong> <?= $row['item_dicari']; ?></p>
                        <p class="card-text text-secondary small">Pemilik: @<?= $row['username']; ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <?php if ($row['status'] == 'Tersedia'): ?>
                            <button onclick="infoKontak('<?= $row['nama_item']; ?>', '<?= $row['kontak']; ?>')" class="btn btn-warning w-100 fw-bold">
                                Ajukan Barter?
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>Item Terjual/Tertukar</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

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
        alert("Tertarik menukar '" + namaItem + "'?\n\nSilakan hubungi pemilik item melalui:\n " + kontak);
    }
</script>

</body>
</html>
