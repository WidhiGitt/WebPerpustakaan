<?php
//Panggil koneksi PHP
include "koneksi.php";

//Fungsi menampilkan
function select($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row ;
    }
    return $rows;
}

//fungsi tambah pengguna-web
function create_user($post) {
    global $db;

    $nama_lengkap = strip_tags($post['nama_lengkap']);
    $telepon = strip_tags($post['telepon']);
    $alamat = strip_tags($post['alamat']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);

    $level = 3;
    $status = 1;

    // Simpan ke detail_user
    $query_detail = "INSERT INTO detail_user (nama_lengkap, telepon, alamat) 
                     VALUES ('$nama_lengkap', '$telepon', '$alamat')";
    mysqli_query($db, $query_detail);
    $id_DU = mysqli_insert_id($db);

    // Simpan ke user
    $query_user = "INSERT INTO user (id_DU, nama, username, password, level, status)
                   VALUES ('$id_DU', '$nama', '$username', '$password', '$level', '$status')";
    mysqli_query($db, $query_user);
    $id_user_baru = mysqli_insert_id($db);

    // Cek siapa yang melakukan aksi (admin/petugas atau user sendiri)
    $id_log = isset($_SESSION['id']) ? $_SESSION['id'] : $id_user_baru;

    // Catat log
    $aksi = 'Tambah Pengguna';
    $deskripsi = "Menambahkan pengguna baru: $username";
    logAktivitas($id_log, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

// Fungsi edit pengguna
function update_user($post) {
    global $db;
    $id = intval($post['id']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);
    $status = strip_tags($post['status']);

// Query update data
$query = "UPDATE user 
                SET nama = '$nama', 
                  username = '$username', 
                  password = '$password', 
                  level = '$level', 
                  status = '$status' 
              WHERE id = $id";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Edit Pengguna';
    $deskripsi = "Mengubah data pengguna: $nama, $username, $password, $level, $status";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function delete_user($id) {
    global $db; // Pastikan koneksi database tersedia
    $id = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM user WHERE id = $id";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Hapus Pengguna';
    $deskripsi = "Menghapus pengguna: $id";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

//fungsi tambah kategori
function create_ktgr($post) {
    global $db;
    $id_kategori = strip_tags($post ['id_kategori']);
    $nama = strip_tags($post ['nama']);

//query tambah data
$query = "INSERT INTO kategori (id_kategori, nama)
VALUES ('$id_kategori', '$nama')";
mysqli_query($db, $query);

// Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Tambah Kategori';
    $deskripsi = "Menambahkan kategori baru: $id_kategori, $nama";
    logAktivitas($id, $aksi, $deskripsi);

return mysqli_affected_rows($db);
}

// Fungsi edit kategori
function update_ktgr($post) {
    global $db;
    // Cek apakah id_kategori ada
    if (!isset($post['id_kategori']) || !isset($post['nama'])) {
        return 0; // atau bisa lempar error/kembalikan false
    }
    $id_kategori = intval($post['id_kategori']);
    $nama = strip_tags($post['nama']);
    
    // Query update data
    $query = "UPDATE kategori 
              SET nama = '$nama'
              WHERE id_kategori = $id_kategori";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Edit Kategori';
    $deskripsi = "Mengubah data kategori: $nama";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function delete_ktgr($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_kategori = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM kategori WHERE id_kategori = $id_kategori";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Hapus Kategori';
    $deskripsi = "Menghapus kategori: $id_kategori";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function create_buku($post) {
    global $db;
    $id_buku = strip_tags($post ['id_buku']);
    $judul_buku = strip_tags($post ['judul_buku']);
    $penulis = strip_tags($post ['penulis']);
    $penerbit = strip_tags($post ['penerbit']);
    $cover = strip_tags($post ['cover']);
    $cover_bg_color = strip_tags($post ['cover_bg_color']);
    $tahun_terbit = strip_tags($post ['tahun_terbit']);
    $jumlah_buku = strip_tags($post ['jumlah_buku']);
    $id_kategori = strip_tags($post ['id_kategori']);

    //query tambah data
    $query = "INSERT INTO buku (id_buku, judul_buku, penulis, penerbit, cover, cover_bg_color, tahun_terbit, jumlah_buku, id_kategori)
    VALUES ('$id_buku', '$judul_buku', '$penulis', '$penerbit', '$cover', '$cover_bg_color', '$tahun_terbit', '$jumlah_buku', '$id_kategori')";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Tambah Buku';
    $deskripsi = "Menambahkan buku baru: $id_buku, $judul_buku, $penulis, $id_kategori";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

// Fungsi edit buku
function update_buku($post) {
    global $db;
    $id_buku = strip_tags($post ['id_buku']);
    $judul_buku = strip_tags($post ['judul_buku']);
    $penulis = strip_tags($post ['penulis']);
    $penerbit = strip_tags($post ['penerbit']);
    $cover = strip_tags($post ['cover']);
    $cover_bg_color = strip_tags($post ['cover_bg_color']);
    $tahun_terbit = strip_tags($post ['tahun_terbit']);
    $jumlah_buku = strip_tags($post ['jumlah_buku']);
    $id_kategori = strip_tags($post ['id_kategori']);

// Query update data
$query = "UPDATE buku 
                SET judul_buku = '$judul_buku', 
                  penulis = '$penulis', 
                  penerbit = '$penerbit',   
                  cover = '$cover', 
                  cover_bg_color = '$cover_bg_color', 
                  tahun_terbit = '$tahun_terbit', 
                  jumlah_buku = '$jumlah_buku', 
                  id_kategori = '$id_kategori'
              WHERE id_buku = $id_buku";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Edit Buku';
    $deskripsi = "Mengubah data buku: $judul_buku, $penulis, $penerbit, $cover, $cover_bg_color, $tahun_terbit, $jumlah_buku, $id_kategori";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function delete_buku($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_buku = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM buku WHERE id_buku = $id_buku";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Hapus Buku';
    $deskripsi = "Menghapus buku: $id_buku";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function create_pmnjmn($post) {
    global $db;
    
    $tgl_peminjaman = strip_tags($post['tgl_peminjaman']);
    $tgl_pengembalian = strip_tags($post['tgl_pengembalian']);
    $tgl_bukukembali = isset($post['tgl_bukukembali']) ? strip_tags($post['tgl_bukukembali']) : NULL;
    $id_peminjam = strip_tags($post['id']);
    $id_buku = strip_tags($post['id_buku']);
    $status = 'dipinjam';

    // Insert peminjaman dulu
    $query_peminjaman = "INSERT INTO peminjaman (id, tgl_peminjaman, tgl_pengembalian, tgl_bukukembali)
                        VALUES ('$id_peminjam', '$tgl_peminjaman', '$tgl_pengembalian', '$tgl_bukukembali')";
    mysqli_query($db, $query_peminjaman);
    $id_peminjaman_baru = mysqli_insert_id($db);

    if (!$id_peminjaman_baru) return 0;

    // Insert detail peminjaman
    $query_detail = "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, status) 
                     VALUES ('$id_peminjaman_baru', '$id_buku', '$status')";
    mysqli_query($db, $query_detail);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Tambah Peminjaman';
    $deskripsi = "Menambahkan peminjaman baru: $id_peminjaman_baru, $id, $tgl_peminjaman, $tgl_pengembalian, $id_buku, $status";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

// Fungsi edit peminjaman
function update_pmnjmn($post) {
    global $db;
    $id_peminjaman = intval($post['id_peminjaman']);
    $tgl_peminjaman = strip_tags($post ['tgl_peminjaman']);
    $tgl_pengembalian = strip_tags($post ['tgl_pengembalian']);
    $tgl_bukukembali = strip_tags($post ['tgl_bukukembali']);
    $id = strip_tags($post ['id']);

// Query update data
$query = "UPDATE peminjaman 
                SET tgl_peminjaman = '$tgl_peminjaman', 
                  tgl_pengembalian = '$tgl_pengembalian', 
                  tgl_bukukembali = '$tgl_bukukembali', 
                  id = '$id'
              WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Edit Peminjaman';
    $deskripsi = "Mengubah data peminjaman: $tgl_peminjaman, $tgl_pengembalian, $tgl_bukukembali, $id";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function delete_pmnjmn($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_peminjaman = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Hapus Peminjaman';
    $deskripsi = "Menghapus peminjaman: $id_peminjaman";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function create_dp($post) {
    global $db;
    $id_peminjaman = strip_tags($post ['id_peminjaman']);
    $id_buku = strip_tags($post ['id_buku']);
    $status = strip_tags($post ['status']);

    //query tambah data
    $query = "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, status)
    VALUES ('$id_peminjaman', '$id_buku', '$status')";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Tambah Detail Peminjaman';
    $deskripsi = "Menambahkan detail peminjaman baru: $id_peminjaman, $id_buku, $status";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

// Fungsi edit detail_peminjaman
function update_dp($post) {
    global $db;
    $id_DP = intval($post['id_DP']);
    $id_peminjaman = strip_tags($post['id_peminjaman']);
    $id_buku = strip_tags($post['id_buku']);
    $status = strip_tags($post['status']);

// Query update data
$query = "UPDATE user 
                SET id_peminjaman = '$id_peminjaman', 
                  id_buku = '$id_buku', 
                  status = '$status' 
              WHERE id_DP = $id_DP";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Edit Detail Peminjaman';
    $deskripsi = "Mengubah data detail peminjaman: $id_peminjaman, $id_buku, $status";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function delete_dp($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_DP = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM detail_peminjaman WHERE id_DP = $id_DP";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Hapus Detail Peminjaman';
    $deskripsi = "Menghapus detail peminjaman: $id_DP";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function create_du($post) {
    global $db;
    $nama_lengkap = strip_tags($post ['nama_lengkap']);
    $telepon = strip_tags($post ['telepon']);
    $alamat = strip_tags($post ['alamat']);

    //query tambah data
    $query = "INSERT INTO detail_user (nama_lengkap, telepon, alamat)
    VALUES ('$nama_lengkap', '$telepon', '$alamat')";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Tambah Detail Pengguna';
    $deskripsi = "Menambahkan detail pengguna baru: $nama_lengkap, $telepon, $alamat";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

// Fungsi edit pengguna
function update_du($post) {
    global $db;
    $id_DU = intval($post['id_DU']);
    $nama_lengkap = strip_tags($post['nama_lengkap']);
    $telepon = strip_tags($post['telepon']);
    $alamat = strip_tags($post['alamat']);

// Query update data
$query = "UPDATE detail_user 
                SET nama_lengkap = '$nama_lengkap', 
                  telepon = '$telepon', 
                  alamat = '$alamat' 
              WHERE id_DU = $id_DU";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Edit Detail Pengguna';
    $deskripsi = "Mengubah data detail pengguna: $nama_lengkap, $telepon, $alamat";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function delete_du($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_DU = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM detail_user WHERE id_DU = $id_DU";
    mysqli_query($db, $query);

    // Log aktivitas
    $id = $_SESSION['id'];
    $aksi = 'Hapus Detail Pengguna';
    $deskripsi = "Menghapus detail pengguna: $id_DU";
    logAktivitas($id, $aksi, $deskripsi);

    return mysqli_affected_rows($db);
}

function logAktivitas($id, $aksi, $deskripsi) {
    global $db;
    $waktu = date("Y-m-d H:i:s");

    $query = "INSERT INTO log_aktivitas (id, aksi, deskripsi, waktu)
              VALUES ('$id', '$aksi', '$deskripsi', '$waktu')";

    $result = mysqli_query($db, $query);

    // Debug: tampilkan error jika query gagal
    if (!$result) {
        die("Gagal insert log aktivitas: " . mysqli_error($db));
    }

    return mysqli_affected_rows($db);
}

?>
