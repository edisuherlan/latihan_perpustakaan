<?php
include '../koneksi.php';


$sql = "SELECT buku.*, pengarang.nama_pengarang, lokasi.nama_lokasi 
        FROM buku 
        JOIN pengarang ON buku.kode_pengarang = pengarang.kode_pengarang 
        JOIN lokasi ON buku.kode_lokasi = lokasi.kode_lokasi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Daftar Buku</h1>
        <a href="../index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
        <a href="add.php" class="btn btn-primary mb-3">Tambah Buku</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode Buku</th>
                    <th>Nama Buku</th>
                    <th>Nama Pengarang</th>
                    <th>Stock</th>
                    <th>Nama Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['kode_buku']}</td>
                                <td>{$row['nama_buku']}</td>
                                <td>{$row['nama_pengarang']}</td>
                                <td>{$row['stock']}</td>
                                <td>{$row['nama_lokasi']}</td>
                                <td>
                                    <a href='edit.php?kode_buku={$row['kode_buku']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?kode_buku={$row['kode_buku']}' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
