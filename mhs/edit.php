<?php
include '../koneksi.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    
    // Ambil data mahasiswa berdasarkan nim
    $sql = "SELECT * FROM mhs WHERE nim = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $mhs = $result->fetch_assoc();
    } else {
        echo "<script>alert('Mahasiswa tidak ditemukan'); window.location.href='list.php';</script>";
        exit();
    }
    
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    
    // Update data mahasiswa
    $sql = "UPDATE mhs SET nama = ?, prodi = ? WHERE nim = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama, $prodi, $nim);
    
    if ($stmt->execute()) {
        echo "<script>alert('Mahasiswa berhasil diperbarui'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui mahasiswa'); window.location.href='list.php';</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit Mahasiswa</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $mhs['nim']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $mhs['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="<?php echo $mhs['prodi']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Mahasiswa</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
