<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_lokasi = $_POST['kode_lokasi'];
    $nama_lokasi = $_POST['nama_lokasi'];
    
    // Query untuk menambahkan lokasi baru
    $sql = "INSERT INTO lokasi (kode_lokasi, nama_lokasi) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $kode_lokasi, $nama_lokasi);
    
    if ($stmt->execute()) {
        echo "<script>alert('Lokasi berhasil ditambahkan'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan lokasi'); window.location.href='list.php';</script>";
    }
    
    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Tambah Lokasi</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="kode_lokasi">Kode Lokasi</label>
                <input type="text" class="form-control" id="kode_lokasi" name="kode_lokasi" required>
            </div>
            <div class="form-group">
                <label for="nama_lokasi">Nama Lokasi</label>
                <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Lokasi</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
