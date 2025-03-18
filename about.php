<?php
// Mulai session jika perlu
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - PWD MHS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* CSS untuk membuat lebar tabel disesuaikan dengan konten */
        .list-group {
            max-width: 500px; /* Menentukan lebar maksimal */
            margin: 0 auto; /* Memusatkan tabel */
        }
        .list-group-item {
            white-space: nowrap; /* Mencegah teks melar ke baris baru */
            overflow: hidden; /* Menghindari overflow teks */
            text-overflow: ellipsis; /* Menambahkan elipsis jika teks terlalu panjang */
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- About Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-uppercase">About This Application</h2>
                <p class="text-center mt-4">This application is developed by the following team members:</p>
                <ul class="list-group mt-4">
                    <li class="list-group-item">
                        <strong>Imamuddin Al Mustaqim (2100018076)</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>Nama1 (NIM1)</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>Nama2 (NIM2)</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Close About Section -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>
