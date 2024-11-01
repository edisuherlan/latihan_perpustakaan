<?php
include '../koneksi.php';

if (isset($_GET['kode_pengarang'])) {
    $kode_pengarang = $_GET['kode_pengarang'];
    
    // Query untuk menghapus pengarang
    $sql = "DELETE FROM pengarang WHERE kode_pengarang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_pengarang);
    
    if ($stmt->execute()) {
        $message = "Pengarang berhasil dihapus";
    } else {
        $message = "Gagal menghapus pengarang";
    }
    
    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    $message = "Kode pengarang tidak ditemukan";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Pengarang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
        <a href="list.php" class="btn btn-primary">Kembali ke Daftar Pengarang</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
