<?php
    include '../config/koneksi.php';
    
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = mysqli_prepare($koneksi, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='../login.php';</script>";
    } else {
        echo "<script>alert('Gagal mendaftar!'); window.location='../register.php';</script>";
    }
?>
