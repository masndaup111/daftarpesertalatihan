<?php
// Koneksi ke database
$conn = mysqli_connect("sql310.infinityfree.com", "if0_38067110", "4WElKaLJpMsb", "if0_38067110_daftarpesertalatihan");

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Hapus data jika tombol delete diklik
if (isset($_GET['delete'])) {
    $id_peserta = $_GET['delete'];
    $sql = "DELETE FROM peserta WHERE id_peserta = $id_peserta";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fungsi pencarian
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $result = mysqli_query($conn, "SELECT * FROM peserta WHERE 
        nama LIKE '%$search%' OR 
        sekolah LIKE '%$search%' OR 
        jurusan LIKE '%$search%' OR 
        no_hp LIKE '%$search%' OR 
        alamat LIKE '%$search%' 
        ORDER BY id_peserta ASC");
} else {
    $result = mysqli_query($conn, "SELECT * FROM peserta ORDER BY id_peserta ASC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Pelatihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2a9d8f, #ffffff);
            font-family: Arial, sans-serif;
            color: #333;
        }

        h2 {
            color: #fff;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            background-color: #2a9d8f;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .table-container {
            background-color: #ffffffd9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #2a9d8f;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1b6d63;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .btn-success {
            background-color: #198754;
            border: none;
        }

        .btn-success:hover {
            background-color: #146c43;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .table-primary {
            background-color: #e0f7f3;
        }

        .form-control:focus {
            border-color: #2a9d8f;
            box-shadow: 0 0 5px rgba(42, 157, 143, 0.5);
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.5rem;
            }

            .search-group {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .search-buttons {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
            }

            .form-control {
                width: 100%;
            }

            .btn {
                width: auto;
            }
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="table-container">
            <h2>DAFTAR PESERTA PELATIHAN MILITER</h2>

            <!-- Form Pencarian -->
            <form method="GET" class="d-flex search-group mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari data..." value="<?= htmlspecialchars($search); ?>">
                <div class="search-buttons">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <!-- Tambah Data Button -->
            <div class="d-flex justify-content-start mb-3">
                <a href="create.php" class="btn btn-success">Tambah Data</a>
            </div>

            <!-- Tabel Data -->
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>Jurusan</th>
                <th>No Hp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['sekolah'] . "</td>";
                    echo "<td>" . $row['jurusan'] . "</td>";
                    echo "<td>" . $row['no_hp'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>
                            <a href='update.php?id_peserta=" . $row['id_peserta'] . "' class='btn btn-warning btn-sm'>Update</a>
                            <a href='index.php?delete=" . $row['id_peserta'] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' class='btn btn-danger btn-sm'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Data tidak ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


            <!-- Logout Button -->
            <div class="d-flex justify-content-end mt-3">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
