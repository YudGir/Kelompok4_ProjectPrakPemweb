<?php
    session_start();
    include '../config/koneksi.php';
    /** @var mysqli $koneksi */

    if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
        header("Location: ../login.php");
        exit;
    }

    $id      = (int) $_GET['id'];
    $user_id = (int) $_SESSION['user_id'];

    // ambil data item milik user yang sedang login
    $stmt = $koneksi->prepare("SELECT gambar FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $hasil = $stmt->get_result();
    $data  = $hasil->fetch_assoc();
    $stmt->close();

    if (!$data) {
        header("Location: ../dashboardUser.php");
        exit;
    }

    $stmt = $koneksi->prepare("DELETE FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);

    if ($stmt->execute()) {
        // hapus file gambar kalau bukan gambar default
        $path = "../uploads/" . basename($data['gambar']);
        if ($data['gambar'] !== "default.png" && file_exists($path)) {
            unlink($path);
        }
        header("Location: ../dashboardUser.php");
        exit;
    } else {
        echo "Proses hapus gagal! " . $koneksi->error;
    }
    $stmt->close();
?>