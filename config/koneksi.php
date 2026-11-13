<?php
    $koneksi = mysqli_connect("localhost", "root", "", "db_lootswap");

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>