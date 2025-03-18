<?php
require 'function.php';

$siswa = query("SELECT * FROM mahasiswa ORDER BY nim DESC");

$filename = "data_mahasiswa_fti_" . date('Ymd') . ".csv";

// Header untuk ekspor CSV
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

$output = fopen('php://output', 'w');

// Menulis header kolom
fputcsv($output, ['No.', 'Nama', 'NIM', 'Kelas', 'Jurusan', 'Semester']);

$no = 1;
foreach ($siswa as $row) {
    fputcsv($output, [
        $no++,
        htmlspecialchars_decode($row['nama']),
        $row['nim'],
        $row['kelas'],
        $row['jurusan'],
        $row['semester']
    ]);
}

fclose($output);
?>
