<?php
session_start();

// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nis dengan fungsi get dan sanitasi input
$nim = isset($_GET['nim']) ? htmlspecialchars($_GET['nim'], ENT_QUOTES, 'UTF-8') : '';

// Pastikan $nim memiliki nilai yang valid sebelum melanjutkan
if (empty($nim)) {
    echo "<script>
            alert('NIM tidak valid!');
            document.location.href = 'index.php';
          </script>";
    exit;
}

// Jika fungsi hapus jika data terhapus, maka munculkan alert dibawah
if (hapus($nim) > 0) {
    echo "<script>
                alert('Data Mahasiswa berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
} else {
    // Jika fungsi hapus jika data tidak terhapus, maka munculkan alert dibawah
    echo "<script>
            alert('Data siswa gagal dihapus!');
        </script>";
}
?>
