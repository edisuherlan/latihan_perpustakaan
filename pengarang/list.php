<?php
include '../koneksi.php';

// Ambil semua data pengarang
$sql = "SELECT * FROM pengarang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Daftar Pengarang</h1>
        <a href="add.php" class="btn btn-primary mb-3">Tambah Pengarang</a>
        <a href="../index.php" class="btn btn-secondary mb-3">Kembali ke Halaman Utama</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode Pengarang</th>
                    <th>Nama Pengarang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['kode_pengarang']}</td>
                                <td>{$row['nama_pengarang']}</td>
                                <td>
                                    <a href='edit.php?kode_pengarang={$row['kode_pengarang']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete.php?kode_pengarang={$row['kode_pengarang']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengarang ini?\")'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Tidak ada data pengarang</td></tr>";
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

<?php
// Tutup koneksi
$conn->close();
?>
