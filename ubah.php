<?php
session_start();

// Jika tidak login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil file function.php
require 'function.php';

// Mengambil data dari nim dengan validasi
$nim = filter_input(INPUT_GET, 'nim', FILTER_SANITIZE_NUMBER_INT);
if (!$nim) {
    echo "<script>
            alert('NIM tidak valid!');
            document.location.href = 'index.php';
          </script>";
    exit;
}

// Mengambil data mahasiswa berdasarkan nim
$siswa = query("SELECT * FROM mahasiswa WHERE nim = $nim");
if (!$siswa) {
    echo "<script>
            alert('Data mahasiswa tidak ditemukan!');
            document.location.href = 'index.php';
          </script>";
    exit;
}

$siswa = $siswa[0]; // Mengambil data pertama dari hasil query

// Jika tombol ubah ditekan
if (isset($_POST['ubah'])) {
    // Panggil fungsi ubah dari function.php
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa berhasil diubah!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal diubah!');
              </script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Ubah Data</title>
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 0.5em;
        }
        .is-invalid {
            border-color: red;
        }
        button:disabled {
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">PWD MHS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data Mahasiswa</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data" id="form-ubah">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="number" class="form-control w-50" id="nim" value="<?= htmlspecialchars($siswa['nim']); ?>" name="nim" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" value="<?= htmlspecialchars_decode($siswa['nama']); ?>" name="nama" autocomplete="off" required>
                        <div id="error-nama" class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control w-50" id="kelas" value="<?= htmlspecialchars_decode($siswa['kelas']); ?>" name="kelas" autocomplete="off" required>
                        <div id="error-kelas" class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control w-50" id="jurusan" value="<?= htmlspecialchars_decode($siswa['jurusan']); ?>" name="jurusan" autocomplete="off" required>
                        <div id="error-jurusan" class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" class="form-control w-50" id="semester" value="<?= htmlspecialchars_decode($siswa['semester']); ?>" name="semester" autocomplete="off" required>
                        <div id="error-semester" class="error-message"></div>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah" id="btn-ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script>
        const form = document.getElementById('form-ubah');
        const btnUbah = document.getElementById('btn-ubah');

        // Atur aturan regex untuk setiap field
        const validationRules = {
            nama: /^[a-zA-Z\s'\-]+$/, // Hanya huruf, spasi, tanda kutip ('), tanda strip (-)
            kelas: /^[a-zA-Z0-9\s]+$/, // Huruf, angka, spasi
            jurusan: /^[a-zA-Z0-9\s'\-]+$/, // Huruf, angka, spasi, tanda kutip ('), tanda strip (-)
            semester: /^[0-9]+$/ // Hanya angka
        };

        // Pesan error spesifik untuk masing-masing field
        const errorMessages = {
            nama: "Nama hanya boleh berisi huruf, spasi, tanda kutip ( ' ), dan tanda strip ( - ).",
            kelas: "Kelas hanya boleh berisi huruf, angka, dan spasi.",
            jurusan: "Jurusan hanya boleh berisi huruf, angka, spasi, tanda kutip ( ' ), dan tanda strip ( - ).",
            semester: "Semester hanya boleh berisi angka."
        };

        const fields = ['nama', 'kelas', 'jurusan', 'semester'];

        function validateField(field) {
            const input = document.getElementById(field);
            const errorDiv = document.getElementById(`error-${field}`);
            const regex = validationRules[field];

            if (!regex.test(input.value)) {
                input.classList.add('is-invalid');
                errorDiv.textContent = errorMessages[field];
                btnUbah.disabled = true;
            } else {
                input.classList.remove('is-invalid');
                errorDiv.textContent = '';
                if (fields.every(f => !document.getElementById(f).classList.contains('is-invalid'))) {
                    btnUbah.disabled = false;
                }
            }
        }

        fields.forEach(field => {
            const input = document.getElementById(field);
            input.addEventListener('input', () => validateField(field));
        });

        form.addEventListener('submit', (e) => {
            fields.forEach(validateField);
            if (fields.some(f => document.getElementById(f).classList.contains('is-invalid'))) {
                e.preventDefault();
            }
        });
    </script>

</body>

</html>
