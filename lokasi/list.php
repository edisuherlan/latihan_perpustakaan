<?php
include '../koneksi.php';

// Query untuk mengambil data lokasi
$sql = "SELECT * FROM lokasi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Daftar Lokasi</h1>
        <a href="../index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
        <a href="add.php" class="btn btn-primary mb-3">Tambah Lokasi</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Kode Lokasi</th>
                    <th>Nama Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['kode_lokasi']}</td>";
                        echo "<td>{$row['nama_lokasi']}</td>";
                        echo "<td>
                                <a href='edit.php?kode_lokasi={$row['kode_lokasi']}' class='btn btn-warning btn-sm'>Edit</a> 
                                <a href='delete.php?kode_lokasi={$row['kode_lokasi']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus lokasi ini?\")'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Tidak ada data lokasi</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary">Kembali ke Beranda</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
