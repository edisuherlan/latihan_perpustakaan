<?php
include '../koneksi.php';

if (isset($_GET['kode_pinjam'])) {
    $kode_pinjam = $_GET['kode_pinjam'];

    // Hapus data pinjam berdasarkan kode_pinjam
    $sql = "DELETE FROM pinjam WHERE kode_pinjam = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_pinjam);

    if ($stmt->execute()) {
        $message = "Data pinjam berhasil dihapus";
    } else {
        $message = "Gagal menghapus data pinjam";
    }

    $stmt->close();
} else {
    $message = "Kode pinjam tidak ditemukan";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Pinjam</title>
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
