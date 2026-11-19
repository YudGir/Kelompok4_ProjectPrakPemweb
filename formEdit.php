<?php
    session_start();

    if (!isset($_SESSION["status_login"]) || $_SESSION["status_login"] !== true) {
        header("Location: login.php");
        exit();
    }
    include "config/koneksi.php";

    $id      = (int) $_GET["id"];
    $user_id = (int) $_SESSION["user_id"];

    $stmt = $koneksi->prepare("SELECT * FROM items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $hasil = $stmt->get_result();
    $data  = $hasil->fetch_assoc();
    $stmt->close();

    if (!$data) {
        header("Location: dashboardUser.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - LootSwap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboardUser.php">LootSwap Dashboard</a>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">Edit Item Barter</h4>
                    </div>
                    <div class="card-body">
                        <form action="logic/prosesEdit.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                            <div class="mb-3">
                                <label class="form-label">Nama Item Anda</label>
                                <input type="text" class="form-control" name="nama_item" value="<?php echo htmlspecialchars($data['nama_item']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Game</label>
                                <input type="text" class="form-control" name="nama_game" value="<?php echo htmlspecialchars($data['nama_game']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Item yang Dicari (Barter)</label>
                                <input type="text" class="form-control" name="item_dicari" value="<?php echo htmlspecialchars($data['item_dicari']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kontak yang Bisa Dihubungi</label>
                                <input type="text" class="form-control" name="kontak" value="<?php echo htmlspecialchars($data['kontak']); ?>" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="dashboardUser.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>