<?php
include "config/controller.php";

if (isset($_POST['tambah'])) {
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
    $id = $_POST['id'];
    $id_buku = $_POST['id_buku'];

    if ($tgl_peminjaman && $tgl_pengembalian && $id && $id_buku) {
        // Insert ke tabel peminjaman dulu
        $insertPeminjaman = $db->query("INSERT INTO peminjaman (tgl_peminjaman, tgl_pengembalian, id) VALUES ('$tgl_peminjaman', '$tgl_pengembalian', $id)");

        if ($insertPeminjaman) {
            $id_peminjaman = $db->insert_id; // ambil id peminjaman yang baru

            // Insert ke detail_peminjaman dengan status 'dipinjam'
            $insertDetail = $db->query("INSERT INTO detail_peminjaman (id_peminjaman, id_buku, status) VALUES ($id_peminjaman, $id_buku, 'dipinjam')");

            if ($insertDetail) {
                echo "<script>alert('Peminjaman berhasil ditambahkan'); window.location.href='index.php';</script>";
                exit;
            } else {
                echo "Error insert detail peminjaman: " . $db->error;
            }
        } else {
            echo "Error insert peminjaman: " . $db->error;
        }
    } else {
        echo "Mohon isi semua data dengan benar.";
    }
}


// Ambil data user untuk dropdown
$queryUsers = mysqli_query($db, "SELECT id, username FROM user WHERE level = 3");

$backLink = "index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Peminjaman Buku</title>
    <link rel="stylesheet" href="style/style2.css" />
</head>
<body>
    <div class="registration-form">
        <h2>Tambah Peminjaman Buku</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="tgl_peminjaman">Tanggal Peminjaman:</label>
                <input type="date" class="form-control item" id="tgl_peminjaman" name="tgl_peminjaman" required>
            </div>

            <div class="form-group">
                <label for="tgl_pengembalian">Tanggal Pengembalian (rencana):</label>
                <input type="date" class="form-control item" id="tgl_pengembalian" name="tgl_pengembalian" required>
            </div>

            <div class="form-group">
                <label for="id_peminjaman">ID Peminjaman:</label>
                <input type="text" class="form-control item" id="id_peminjaman" name="id_peminjaman" required>
            </div>

            <div class="form-group">
                <label for="id_buku">ID Buku:</label>
                <input type="text" class="form-control item" id="id_buku" name="id_buku" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control item" id="status" name="status" required>
            </div>

            <div class="form-group">
                <label for="id">Peminjam:</label>
                <select class="form-control item" id="id" name="id" required>
                    <option value="">-- Pilih Peminjam --</option>
                    <?php while ($user = mysqli_fetch_assoc($queryUsers)) : ?>
                        <option value="<?= $user['id']; ?>"><?= htmlspecialchars($user['username']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="tambah" value="Add Borrowing Book">
                <a href="<?= $backLink ?>" class="btn btn-success">Back</a>
            </div>
        </form>
    </div>
</body>
</html>