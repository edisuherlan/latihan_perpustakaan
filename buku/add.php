<?php
include '../koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_buku = $_POST['kode_buku'];
    $nama_buku = $_POST['nama_buku'];
    $kode_pengarang = $_POST['kode_pengarang'];
    $stock = $_POST['stock'];
    $kode_lokasi = $_POST['kode_lokasi'];

    $sql = "INSERT INTO buku (kode_buku, nama_buku, kode_pengarang, stock, kode_lokasi) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiii", $kode_buku, $nama_buku, $kode_pengarang, $stock, $kode_lokasi);

    if ($stmt->execute()) {
        header("Location: list.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Ambil data pengarang dari database
$sql_pengarang = "SELECT kode_pengarang, nama_pengarang FROM pengarang";
$result_pengarang = $conn->query($sql_pengarang);

// Ambil data lokasi dari database
$sql_lokasi = "SELECT kode_lokasi, nama_lokasi FROM lokasi";
$result_lokasi = $conn->query($sql_lokasi);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Buku</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="kode_buku">Kode Buku</label>
                <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>
            </div>
            <div class="form-group">
                <label for="nama_buku">Nama Buku</label>
                <input type="text" class="form-control" id="nama_buku" name="nama_buku">
            </div>
            <div class="form-group">
                <label for="kode_pengarang">Kode Pengarang</label>
                <select class="form-control" id="kode_pengarang" name="kode_pengarang">
                    <?php
                    if ($result_pengarang->num_rows > 0) {
                        while($row = $result_pengarang->fetch_assoc()) {
                            echo "<option value='{$row['kode_pengarang']}'>{$row['nama_pengarang']}</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada pengarang</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock">
            </div>
            <div class="form-group">
                <label for="kode_lokasi">Kode Lokasi</label>
                <select class="form-control" id="kode_lokasi" name="kode_lokasi">
                    <?php
                    if ($result_lokasi->num_rows > 0) {
                        while($row = $result_lokasi->fetch_assoc()) {
                            echo "<option value='{$row['kode_lokasi']}'>{$row['nama_lokasi']}</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada lokasi</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Buku</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
