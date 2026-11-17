<?php
include '../config/koneksi.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='../login.php';</script>";
} else {
    echo "<script>alert('Gagal mendaftar!'); window.location='../register.php';</script>";
}
?>
