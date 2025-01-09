<?php
// Koneksi ke database
$conn = mysqli_connect("sql310.infinityfree.com", "if0_38067110", "4WElKaLJpMsb", "if0_38067110_daftarpesertalatihan");

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil data peserta berdasarkan ID
if (isset($_GET['id_peserta'])) {
    $id_peserta = $_GET['id_peserta'];

    // Query untuk mendapatkan data peserta
    $result = mysqli_query($conn, "SELECT * FROM peserta WHERE id_peserta = $id_peserta");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='index.php';</script>";
    }
}

// Proses update data
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $sekolah = $_POST['sekolah'];
    $jurusan = $_POST['jurusan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $sql = "UPDATE peserta SET 
            nama = '$nama', 
            sekolah = '$sekolah', 
            jurusan = '$jurusan', 
            no_hp = '$no_hp', 
            alamat = '$alamat' 
            WHERE id_peserta = $id_peserta";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='index.php';</script>";
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
    <title>Update Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Peserta</h2>
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="sekolah" class="form-label">Sekolah</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" value="<?php echo $row['sekolah']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $row['jurusan']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No Hp</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
