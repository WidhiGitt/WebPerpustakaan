<?php
include 'config/controller.php';

$queryRekomendasi = "SELECT buku.*, kategori.nama
          FROM buku 
          LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
          LIMIT 4";
$resultRekomendasi = $db->query($queryRekomendasi);

$queryKategori = "SELECT * FROM kategori ORDER BY nama ASC";
$resultKategori = $db->query($queryKategori);

$idKategoriTerpilih = isset($_GET['kategori']) ? intval($_GET['kategori']) : null;
$querySemua = "SELECT buku.*, kategori.nama 
               FROM buku 
               LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori 
               WHERE buku.id_buku >= 5";
if ($idKategoriTerpilih) {
    $querySemua .= " AND buku.id_kategori = $idKategoriTerpilih";
}
$resultSemua = $db->query($querySemua);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/styleSiswa.css">
    <style>
    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h1, h2 {
      text-align: center;
      color: #2c5f2d;
    }
    h3 {
      color: #3c8d2f;
      margin-top: 30px;
    }
    p {
      margin: 10px 0;
      line-height: 1.6;
    }
    ul {
      padding-left: 20px;
    }
    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 0.9rem;
      color: #777;
    }
  </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h2> <span class="font-normal">E-library</span>
            <span class="font-bold">DeSeven</span>
        </h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="KatalogPengguna.php">Katalog</a></li>
            <li><a href="Buku-dipinjam.php">Buku yang Dipinjam</a></li>
            <li><a href="PanduanPengguna.php">Panduan</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Panduan</h1>
            <div class="search-bar">
                <a class="profile-icon" href="formLogin.php">👤</a>
            </div>
        </div>


    <div class="content">
         <div class="container">
    <h1>Panduan Pengguna</h1>
    <h2>Perpustakaan Online</h2>

    <h3>📚 1. Registrasi & Login</h3>
    <p>- Registrasi akun dilakukan oleh petugas atau admin perpustakaan.</p>
    <p>- Login menggunakan <strong>username</strong> dan <strong>password</strong> yang telah diberikan.</p>

    <h3>🔍 2. Menjelajahi Katalog Buku</h3>
    <p>- Gunakan fitur pencarian untuk menemukan buku berdasarkan judul, pengarang, atau kategori.</p>
    <p>- Klik pada judul buku untuk melihat detail dan status ketersediaannya.</p>

    <h3>📥 3. Meminjam Buku</h3>
    <p>- Jika buku tersedia, klik tombol <strong>Pinjam Buku</strong>.</p>
    <p>- Sistem akan otomatis mencatat tanggal peminjaman dan tanggal pengembalian.</p>
    <p><strong>Catatan:</strong> Maksimal peminjaman adalah <strong>3 buku</strong> per pengguna.</p>

    <h3>📖 4. Melihat Buku yang Sedang Dipinjam</h3>
    <p>- Masuk ke menu <strong>Buku Dipinjam</strong> untuk melihat daftar buku yang sedang Anda pinjam.</p>
    <ul>
      <li>Judul buku</li>
      <li>Tanggal peminjaman dan pengembalian</li>
      <li>Status: <em>dipinjam</em> atau <em>dikembalikan</em></li>
    </ul>

    <h3>🔄 5. Pengembalian Buku</h3>
    <p>- Bawa buku ke perpustakaan untuk diserahkan langsung kepada petugas.</p>
    <p>- Petugas akan mengubah status peminjaman menjadi <strong>dikembalikan</strong>.</p>

    <h3>⚠️ 6. Denda Keterlambatan</h3>
    <p>- Denda berlaku jika melewati tanggal pengembalian.</p>
    <p>- Informasi jumlah denda bisa dilihat di profil pengguna atau hubungi petugas.</p>

    <h3>🛠️ 7. Bantuan & Kontak</h3>
    <p>Jika mengalami kendala teknis atau pertanyaan:</p>
    <ul>
      <li>WhatsApp: <strong>08xxxxxxxxxx</strong></li>
      <li>Email: <strong>perpustakaan@sekolah.ac.id</strong></li>
      <li>Alamat: <strong>Ruang Perpustakaan, Gedung A, Lantai 1</strong></li>
    </ul>

    <h3>💡 Tips</h3>
    <ul>
      <li>Selalu logout setelah menggunakan akun.</li>
      <li>Periksa status peminjaman secara berkala.</li>
      <li>Patuhi batas waktu pengembalian untuk menghindari denda.</li>
    </ul>

    <div class="footer">
      &copy; <?= date('Y') ?> Perpustakaan Online | Semua hak dilindungi
    </div>
  </div>
    </div>

</body>
</html>