<?php
    session_start();
    include '../config/koneksi.php';
    /** @var mysqli $koneksi */

    if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
        header("Location: ../login.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../dashboardUser.php");
        exit;
    }

    $id          = (int) $_POST['id'];
    $user_id     = (int) $_SESSION['user_id'];
    $nama_item   = trim($_POST['nama_item']);
    $nama_game   = trim($_POST['nama_game']);
    $item_dicari = trim($_POST['item_dicari']);
    $kontak      = trim($_POST['kontak']);

    $stmt = $koneksi->prepare("UPDATE items SET nama_item = ?, nama_game = ?, item_dicari = ?, kontak = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssii", $nama_item, $nama_game, $item_dicari, $kontak, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: ../dashboardUser.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . $koneksi->error;
    }
    $stmt->close();
?>