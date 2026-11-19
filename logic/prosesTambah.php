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

    $user_id     = (int) $_SESSION['user_id'];
    $nama_item   = trim($_POST['nama_item']);
    $nama_game   = trim($_POST['nama_game']);
    $item_dicari = trim($_POST['item_dicari']);
    $kontak      = trim($_POST['kontak']);

    $nama_file = "default.png";

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $ekstensi_boleh = ["jpg", "jpeg", "png", "gif", "webp"];
        $ekstensi = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $tmp_file = $_FILES['gambar']['tmp_name'];

        if (!in_array($ekstensi, $ekstensi_boleh) || getimagesize($tmp_file) === false) {
            echo "<script>alert('File harus berupa gambar (jpg, png, gif, webp)!'); window.history.back();</script>";
            exit;
        }

        if ($_FILES['gambar']['size'] > 2 * 1024 * 1024) {
            echo "<script>alert('Ukuran gambar maksimal 2 MB!'); window.history.back();</script>";
            exit;
        }

        $nama_file = uniqid() . "." . $ekstensi;

        if (!move_uploaded_file($tmp_file, "../uploads/" . $nama_file)) {
            echo "<script>alert('Gagal mengunggah gambar!'); window.history.back();</script>";
            exit;
        }
    }

    $stmt = $koneksi->prepare("INSERT INTO items (user_id, nama_item, nama_game, item_dicari, kontak, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $nama_item, $nama_game, $item_dicari, $kontak, $nama_file);

    if ($stmt->execute()) {
        header("Location: ../dashboardUser.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . $koneksi->error;
    }
    $stmt->close();
?>