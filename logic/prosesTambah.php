<?php
    session_start();
    include '../config/koneksi.php';

    $user_id     = $_SESSION['user_id'];
    $nama_item   = $_POST['nama_item'];
    $nama_game   = $_POST['nama_game'];
    $item_dicari = $_POST['item_dicari'];
    $kontak      = $_POST['kontak'];

    $nama_file   = time() . "_" . $_FILES['gambar']['name'];
    $tmp_file    = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp_file, "../uploads/" . $nama_file);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO items (user_id, nama_item, nama_game, item_dicari, kontak, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isssss", $user_id, $nama_item, $nama_game, $item_dicari, $kontak, $nama_file);
    mysqli_stmt_execute($stmt);

    header("Location: ../dashboardUser.php");
?>
