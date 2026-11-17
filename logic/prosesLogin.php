<?php
    session_start();
    include '../config/koneksi.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = mysqli_prepare($koneksi, "SELECT id, username, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user   = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
    
        if (isset($_POST['remember'])) {
            setcookie('ingat_user', $user['username'], time() + (86400 * 7), "/");
        }
    
        header("Location: ../dashboardUser.php");
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location='../login.php';</script>";
    }
?>
