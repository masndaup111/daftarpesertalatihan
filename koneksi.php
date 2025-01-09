<?php
// Koneksi ke database
$host = "sql310.infinityfree.com";
$user = "if0_38067110";
$pass = "4WElKaLJpMsb";
$db = "if0_38067110_daftarpesertalatihan"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data dari tabel peserta
$query = "SELECT * FROM peserta";
$result = mysqli_query($conn, $query);
?>


