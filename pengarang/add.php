<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_pengarang = $_POST['kode_pengarang'];
    $nama_pengarang = $_POST['nama_pengarang'];
    
    // Query untuk menambahkan pengarang baru
    $sql = "INSERT INTO pengarang (kode_pengarang, nama_pengarang) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $kode_pengarang, $nama_pengarang);
    
    if ($stmt->execute()) {
        echo "<script>alert('Pengarang berhasil ditambahkan'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pengarang'); window.location.href='list.php';</script>";
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
    <title>Tambah Pengarang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Tambah Pengarang</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="kode_pengarang">Kode Pengarang</label>
                <input type="text" class="form-control" id="kode_pengarang" name="kode_pengarang" required>
            </div>
            <div class="form-group">
                <label for="nama_pengarang">Nama Pengarang</label>
                <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Pengarang</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
