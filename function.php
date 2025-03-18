<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "data_mahasiswa");

// Fungsi query untuk mengambil data dari database
function query($query)
{
    global $koneksi;

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = mysqli_prepare($koneksi, $query);
    if (!$stmt) {
        die("Query error: " . mysqli_error($koneksi));
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Mengambil data dalam bentuk array
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Sanitasi output untuk proteksi XSS
        $rows[] = array_map('htmlspecialchars', $row);
    }

    return $rows;
}

// Fungsi tambah data
function tambah($data)
{
    global $koneksi;

    // Menggunakan prepared statement
    $stmt = mysqli_prepare($koneksi, "INSERT INTO mahasiswa (nim, nama, kelas, jurusan, semester) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "isssi", 
        $data['nim'], 
        $data['nama'], 
        $data['kelas'], 
        $data['jurusan'], 
        $data['semester']
    );

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Fungsi hapus data
function hapus($nim)
{
    global $koneksi;

    // Menggunakan prepared statement
    $stmt = mysqli_prepare($koneksi, "DELETE FROM mahasiswa WHERE nim = ?");
    if (!$stmt) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "i", $nim);

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Fungsi ubah data
function ubah($data)
{
    global $koneksi;

    // Menggunakan prepared statement
    $stmt = mysqli_prepare($koneksi, "UPDATE mahasiswa SET nama = ?, kelas = ?, jurusan = ?, semester = ? WHERE nim = ?");
    if (!$stmt) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "sssii", 
        $data['nama'], 
        $data['kelas'], 
        $data['jurusan'], 
        $data['semester'], 
        $data['nim']
    );

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}
