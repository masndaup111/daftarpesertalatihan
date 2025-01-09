<?php
// Koneksi ke database
$conn = mysqli_connect("sql310.infinityfree.com", "if0_38067110", "4WElKaLJpMsb", "if0_38067110_daftarpesertalatihan");

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Tambahkan data ke tabel
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $sekolah = $_POST['sekolah'];
    $jurusan = $_POST['jurusan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO peserta (nama, sekolah, jurusan, no_hp, alamat) 
            VALUES ('$nama', '$sekolah', '$jurusan', '$no_hp', '$alamat')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Data Peserta</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
            </div>
            <div class="mb-3">
                <label for="sekolah" class="form-label">Sekolah</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Masukkan Nama Sekolah" required>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
