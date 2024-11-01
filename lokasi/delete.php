<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Lokasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        if (isset($_GET['kode_lokasi'])) {
            $kode_lokasi = $_GET['kode_lokasi'];
            
            // Query untuk menghapus lokasi
            $sql = "DELETE FROM lokasi WHERE kode_lokasi = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $kode_lokasi);
            
            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">Lokasi berhasil dihapus</div>';
                echo '<meta http-equiv="refresh" content="2;url=list.php">';
            } else {
                echo '<div class="alert alert-danger" role="alert">Gagal menghapus lokasi</div>';
                echo '<meta http-equiv="refresh" content="2;url=list.php">';
            }
            
            // Tutup statement dan koneksi
            $stmt->close();
            $conn->close();
        } else {
            echo '<div class="alert alert-warning" role="alert">Kode lokasi tidak ditemukan</div>';
            echo '<meta http-equiv="refresh" content="2;url=list.php">';
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
