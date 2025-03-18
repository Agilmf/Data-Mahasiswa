<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika fungsi tambah jika data tersimpan, maka munculkan alert dibawah
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = strtoupper($_POST['kelas']);
    $jurusan = $_POST['jurusan'];
    $semester = $_POST['semester'];

    // Validasi server-side
    if (!preg_match('/^\d{10}$/', $nim)) {
        echo "<script>alert('NIM hanya terdiri dari 10 angka!');</script>";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $nama)) {
        echo "<script>alert('Nama hanya terdiri dari huruf!');</script>";
    } elseif (!preg_match('/^[A-Z]$/', $kelas)) {
        echo "<script>alert('Kelas hanya terdiri dari 1 huruf kapital!');</script>";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $jurusan)) {
        echo "<script>alert('Jurusan hanya terdiri dari huruf!');</script>";
    } elseif (!preg_match('/^[1-8]$/', $semester)) {
        echo "<script>alert('Semester hanya terdiri dari angka 1-8!');</script>";
    } else {
        // Jika semua validasi lolos, simpan data
        if (tambah($_POST)) {
            echo "<script>
                    alert('Data Mahasiswa berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>alert('Data Mahasiswa gagal ditambahkan!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>PWD MHS</title>

    <script>
        function validateForm() {
            const nim = document.getElementById('nim').value;
            const nama = document.getElementById('nama').value;
            const kelas = document.getElementById('kelas').value.toUpperCase();
            const jurusan = document.getElementById('jurusan').value;
            const semester = document.getElementById('semester').value;

            // Validasi NIM
            if (!/^\d{10}$/.test(nim)) {
                alert('NIM hanya terdiri dari 10 angka!');
                return false;
            }

            // Validasi Nama
            if (!/^[a-zA-Z ]+$/.test(nama)) {
                alert('Nama hanya terdiri dari huruf!');
                return false;
            }

            // Validasi Kelas
            if (!/^[A-Z]$/.test(kelas)) {
                alert('Kelas hanya terdiri dari 1 huruf kapital!');
                return false;
            }

            // Validasi Jurusan
            if (!/^[a-zA-Z ]+$/.test(jurusan)) {
                alert('Jurusan hanya terdiri dari huruf!');
                return false;
            }

            // Validasi Semester
            if (!/^[1-8]$/.test(semester)) {
                alert('Semester hanya terdiri dari angka 1-8!');
                return false;
            }

            // Ubah kelas ke huruf kapital otomatis
            document.getElementById('kelas').value = kelas;

            return true;
        }
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">PWD MHS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data Mahasiswa FTI</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM Mahasiswa</label>
                        <input type="text" class="form-control w-50" id="nim" placeholder="Masukkan NIM" name="nim" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control w-50" id="nama" placeholder="Masukkan Nama Lengkap" name="nama" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control w-50" id="kelas" placeholder="Masukkan Kelas" name="kelas" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control w-50" id="jurusan" placeholder="Masukkan Jurusan" name="jurusan" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control w-50" id="semester" placeholder="Masukkan Semester" name="semester" autocomplete="off" required>
                    </div>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
