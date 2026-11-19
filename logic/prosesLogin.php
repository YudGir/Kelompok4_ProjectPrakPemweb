<?php
    session_start();
    include '../config/koneksi.php';
    /** @var mysqli $koneksi */

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../login.php");
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $koneksi->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $hasil = $stmt->get_result();
    $user  = $hasil->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['status_login'] = true;
        $_SESSION['user_id']      = $user['id'];
        $_SESSION['username']     = $user['username'];

        if (isset($_POST['remember'])) {
            setcookie('ingat_user', $user['username'], time() + (86400 * 7), "/");
        } else {
            setcookie('ingat_user', '', time() - 3600, "/");
        }

        header("Location: ../dashboardUser.php");
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location='../login.php';</script>";
    }
?>