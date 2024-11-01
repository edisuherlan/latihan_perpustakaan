<?php
include '../koneksi.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Hapus data mahasiswa berdasarkan nim
    $sql = "DELETE FROM mhs WHERE nim = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nim);

    if ($stmt->execute()) {
        $message = "Mahasiswa berhasil dihapus";
    } else {
        $message = "Gagal menghapus mahasiswa";
    }

    $stmt->close();
} else {
    $message = "NIM tidak ditemukan";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
        <a href="list.php" class="btn btn-primary">Kembali ke Daftar Mahasiswa</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
