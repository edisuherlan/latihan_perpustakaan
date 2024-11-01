<?php
include '../koneksi.php';

if (isset($_GET['kode_pengarang'])) {
    $kode_pengarang = $_GET['kode_pengarang'];
    
    // Ambil data pengarang berdasarkan kode_pengarang
    $sql = "SELECT * FROM pengarang WHERE kode_pengarang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_pengarang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $pengarang = $result->fetch_assoc();
    } else {
        echo "<script>alert('Pengarang tidak ditemukan'); window.location.href='list.php';</script>";
        exit();
    }
    
    $stmt->close();
} else {
    echo "<script>alert('Kode pengarang tidak ditemukan'); window.location.href='list.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_pengarang = $_POST['kode_pengarang'];
    $nama_pengarang = $_POST['nama_pengarang'];
    
    // Update data pengarang
    $sql = "UPDATE pengarang SET nama_pengarang = ? WHERE kode_pengarang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nama_pengarang, $kode_pengarang);
    
    if ($stmt->execute()) {
        echo "<script>alert('Pengarang berhasil diperbarui'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui pengarang'); window.location.href='list.php';</script>";
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
    <title>Edit Pengarang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit Pengarang</h1>
        <form method="post" action="">
            <input type="hidden" name="kode_pengarang" value="<?php echo $pengarang['kode_pengarang']; ?>">
            <div class="form-group">
                <label for="nama_pengarang">Nama Pengarang</label>
                <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" value="<?php echo $pengarang['nama_pengarang']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Pengarang</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
