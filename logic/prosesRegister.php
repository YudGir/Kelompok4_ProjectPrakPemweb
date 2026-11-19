<?php
    include '../config/koneksi.php';
    /** @var mysqli $koneksi */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../register.php");
        exit;
    }

    $username      = trim($_POST['username']);
    $password_asli = $_POST['password'];

    if ($username === "" || $password_asli === "") {
        echo "<script>alert('Username dan password tidak boleh kosong!'); window.location='../register.php';</script>";
        exit;
    }

    // cek apakah username sudah dipakai
    $cek = $koneksi->prepare("SELECT id FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        echo "<script>alert('Username sudah dipakai, pilih yang lain!'); window.location='../register.php';</script>";
        exit;
    }
    $cek->close();

    $password_hash = password_hash($password_asli, PASSWORD_DEFAULT);

    $stmt = $koneksi->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='../login.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar!'); window.location='../register.php';</script>";
    }
    $stmt->close();
?>