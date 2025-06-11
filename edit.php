<?php
session_start();
include 'config/controller.php';

// Pastikan variabel $user didefinisikan sebelum digunakan
$user = null;

// Ambil data berdasarkan ID (parameter GET)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Validasi ID menjadi angka
    $data = select("SELECT * FROM user WHERE id = $id");

    // Jika data ditemukan, set ke $user
    if (count($data) > 0) {
        $user = $data[0];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data
if (isset($_POST['update'])) {
    if (update_user($_POST) > 0) {
        echo "<script>
            alert('Berhasil mengupdate data');
            document.location.href = 'dataUser.php';
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal mengupdate data');
            document.location.href = 'dataUser.php';
            </script>";
    }
}

$backLink = '#';
if ($_SESSION['level'] == 2) {
    $backlink = 'DashboardPetugas2.php';
}elseif($_SESSION['level'] == 1){
    $backlink = 'DashboardAdmin2.php';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="registration-form">
    <h2>Edit Data Pengguna</h2>

    <!-- Pastikan $user tidak null -->
    <?php if ($user): ?>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control item" name="id" placeholder="id" value="<?= $user['id']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="nama" placeholder="Nama" value="<?= $user['nama']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="username" placeholder="Username" value="<?= $user['username']; ?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="password" placeholder="Password" value="<?= $user['password']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="level" placeholder="Level" value="<?= $user['level']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="status" placeholder="Status" value="<?= $user['status']; ?>">
            </div>
            <div class="form-group" style="display: flex; justify-content: center; gap: 10px;">
                <input type="submit" name="update" value="Edit" onclick="window.location.href='<?= $backLink ?>'">
                <button class="btn btn-success" onclick="window.location.href='<?= $backLink ?>'">Back</button>
            </div>
        </form>
    <?php else: ?>
        <p>Data tidak ditemukan atau belum dimuat.</p>
    <?php endif; ?>
</div>
</body>
</html>
