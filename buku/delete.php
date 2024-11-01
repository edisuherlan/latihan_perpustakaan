<?php
include '../koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php
    if (isset($_GET['kode_buku'])) {
        $kode_buku = $_GET['kode_buku'];
        
        // Query untuk menghapus buku
        $sql = "DELETE FROM buku WHERE kode_buku = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $kode_buku);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>Buku berhasil dihapus</div>";
            echo "<script>setTimeout(function(){ window.location.href='list.php'; }, 2000);</script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Gagal menghapus buku</div>";
            echo "<script>setTimeout(function(){ window.location.href='list.php'; }, 2000);</script>";
        }
        
        // Tutup statement dan koneksi
        $stmt->close();
        $conn->close();
    } else {
        echo "<div class='alert alert-warning' role='alert'>Kode buku tidak ditemukan</div>";
        echo "<script>setTimeout(function(){ window.location.href='list.php'; }, 2000);</script>";
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
