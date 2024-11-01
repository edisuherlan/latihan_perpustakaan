<?php
include '../koneksi.php';

if (isset($_GET['kode_lokasi'])) {
    $kode_lokasi = $_GET['kode_lokasi'];
    
    // Ambil data lokasi dari database
    $sql = "SELECT * FROM lokasi WHERE kode_lokasi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_lokasi);
    $stmt->execute();
    $result = $stmt->get_result();
    $lokasi = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_lokasi = $_POST['nama_lokasi'];
        
        // Query untuk mengupdate lokasi
        $sql_update = "UPDATE lokasi SET nama_lokasi = ? WHERE kode_lokasi = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $nama_lokasi, $kode_lokasi);
        
        if ($stmt_update->execute()) {
            echo "<script>alert('Lokasi berhasil diupdate'); window.location.href='list.php';</script>";
        } else {
            echo "<script>alert('Gagal mengupdate lokasi'); window.location.href='list.php';</script>";
        }
        
        // Tutup statement update
        $stmt_update->close();
    }
    
    // Tutup statement select
    $stmt->close();
} else {
    echo "<script>alert('Kode lokasi tidak ditemukan'); window.location.href='list.php';</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lokasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit Lokasi</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="kode_lokasi">Kode Lokasi</label>
                <input type="text" class="form-control" id="kode_lokasi" name="kode_lokasi" value="<?php echo $lokasi['kode_lokasi']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama_lokasi">Nama Lokasi</label>
                <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" value="<?php echo $lokasi['nama_lokasi']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Lokasi</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
