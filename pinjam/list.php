<?php
include '../koneksi.php';

$sql = "SELECT pinjam.*, mhs.nama, buku.nama_buku FROM pinjam 
        JOIN mhs ON pinjam.nim = mhs.nim 
        JOIN buku ON pinjam.kode_buku = buku.kode_buku";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pinjam</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Daftar Pinjam</h1>
        <a href="add.php" class="btn btn-primary mb-3">Tambah Pinjam</a>
        <a href="../index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Kode Pinjam</th>
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
                                    <td>{$row['kode_pinjam']}</td>
                                    <td>{$row['tgl']}</td>
                                    <td>{$row['kode_buku']}</td>
                                    <td>{$row['nama_buku']}</td>
                                    <td>{$row['nim']}</td>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['keterangan']}</td>
                                    <td>{$row['qty']}</td>
                                    <td>
                                        <a href='edit.php?kode_pinjam={$row['kode_pinjam']}' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='delete.php?kode_pinjam={$row['kode_pinjam']}' class='btn btn-danger btn-sm'>Hapus</a>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
