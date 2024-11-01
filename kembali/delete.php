<?php
include '../koneksi.php';

if (isset($_GET['kode_kembali'])) {
    $kode_kembali = $_GET['kode_kembali'];

    // Hapus data kembali berdasarkan kode_kembali
    $sql = "DELETE FROM kembali WHERE kode_kembali = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_kembali);

    if ($stmt->execute()) {
        $message = "Data kembali berhasil dihapus";
    } else {
        $message = "Gagal menghapus data kembali";
    }

    $stmt->close();
} else {
    $message = "Kode kembali tidak ditemukan";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Kembali</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
        <a href="list.php" class="btn btn-primary">Kembali ke Daftar</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
