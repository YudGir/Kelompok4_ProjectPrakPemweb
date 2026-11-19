<?php
    session_start();

    if (!isset($_SESSION["status_login"]) || $_SESSION["status_login"] !== true) {
        header("Location: login.php");
        exit;
    }
    include "config/koneksi.php";

    $user_id = (int) $_SESSION["user_id"];

    $stmt = $koneksi->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY id DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $hasil = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard User - LootSwap</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">LootSwap Dashboard</a>
            <a href="logic/prosesLogout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        <p class="text-muted">Berikut adalah daftar item barter yang Anda miliki:</p>
        <a href="formTambah.php" class="btn btn-primary mb-3">+ Tambah Item Baru</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Game</th>
                            <th>Dicari</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($hasil->num_rows == 0) {
                            echo "<tr><td colspan='6' class='text-center text-muted'>Belum ada item. Klik tombol Tambah Item Baru.</td></tr>";
                        }
                        while ($baris = $hasil->fetch_assoc()) {
                            $badge = ($baris["status"] == "Tersedia") ? "bg-success" : "bg-secondary";
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($baris["nama_item"]) . "</td>";
                            echo "<td>" . htmlspecialchars($baris["nama_game"]) . "</td>";
                            echo "<td>" . htmlspecialchars($baris["item_dicari"]) . "</td>";
                            echo "<td><span class='badge " . $badge . "'>" . htmlspecialchars($baris["status"]) . "</span></td>";
                            echo "<td>
                                    <a href='formEdit.php?id=" . $baris["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='logic/prosesHapus.php?id=" . $baris["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>