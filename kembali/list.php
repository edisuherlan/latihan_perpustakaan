<?php
include '../koneksi.php';

$sql = "SELECT kembali.*, mhs.nama, buku.nama_buku FROM kembali 
        JOIN mhs ON kembali.nim = mhs.nim 
        JOIN buku ON kembali.kode_buku = buku.kode_buku";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kembali</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Daftar Kembali</h1>
        <a href="../index.php" class="btn btn-secondary mb-3">Kembali ke Home</a>
        <a href="add.php" class="btn btn-primary mb-3">Tambah Kembali</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode Kembali</th>
                    <th>Tanggal</th>
                    <th>Kode Buku</th>
                    <th>Nama Buku</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['kode_kembali']}</td>
                                <td>{$row['tgl']}</td>
                                <td>{$row['kode_buku']}</td>
                                <td>{$row['nama_buku']}</td>
                                <td>{$row['nim']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['keterangan']}</td>
                                <td>{$row['qty']}</td>
                                <td>
                                    <a href='edit.php?kode_kembali={$row['kode_kembali']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?kode_kembali={$row['kode_kembali']}' class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>Tidak ada data</td></tr>";
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
