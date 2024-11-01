<?php
include '../koneksi.php';


if (isset($_GET['kode_buku'])) {
    $kode_buku = $_GET['kode_buku'];
    
    // Ambil data buku berdasarkan kode_buku
    $sql = "SELECT * FROM buku WHERE kode_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_buku);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $buku = $result->fetch_assoc();
    } else {
        echo "<script>alert('Buku tidak ditemukan'); window.location.href='list.php';</script>";
        exit();
    }
    
    $stmt->close();
}

// Ambil data pengarang dari database
$sql_pengarang = "SELECT kode_pengarang, nama_pengarang FROM pengarang";
$result_pengarang = $conn->query($sql_pengarang);

// Ambil data lokasi dari database
$sql_lokasi = "SELECT kode_lokasi, nama_lokasi FROM lokasi";
$result_lokasi = $conn->query($sql_lokasi);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_buku = $_POST['kode_buku'];
    $nama_buku = $_POST['nama_buku'];
    $kode_pengarang = $_POST['kode_pengarang'];
    $stock = $_POST['stock'];
    $kode_lokasi = $_POST['kode_lokasi'];
    
    // Update data buku
    $sql = "UPDATE buku SET nama_buku = ?, kode_pengarang = ?, stock = ?, kode_lokasi = ? WHERE kode_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiii", $nama_buku, $kode_pengarang, $stock, $kode_lokasi, $kode_buku);
    
    if ($stmt->execute()) {
        echo "<script>alert('Buku berhasil diperbarui'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui buku'); window.location.href='list.php';</script>";
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
    <title>Edit Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit Buku</h1>
        <form method="post" action="">
            <input type="hidden" name="kode_buku" value="<?php echo $buku['kode_buku']; ?>">
            <div class="form-group">
                <label for="nama_buku">Nama Buku:</label>
                <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?php echo $buku['nama_buku']; ?>">
            </div>
            <div class="form-group">
                <label for="kode_pengarang">Nama Pengarang:</label>
                <select class="form-control" id="kode_pengarang" name="kode_pengarang">
                    <?php
                    if ($result_pengarang->num_rows > 0) {
                        while($row = $result_pengarang->fetch_assoc()) {
                            $selected = ($row['kode_pengarang'] == $buku['kode_pengarang']) ? 'selected' : '';
                            echo "<option value='{$row['kode_pengarang']}' $selected>{$row['nama_pengarang']}</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada pengarang</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $buku['stock']; ?>">
            </div>
            <div class="form-group">
                <label for="kode_lokasi">Nama Lokasi:</label>
                <select class="form-control" id="kode_lokasi" name="kode_lokasi">
                    <?php
                    if ($result_lokasi->num_rows > 0) {
                        while($row = $result_lokasi->fetch_assoc()) {
                            $selected = ($row['kode_lokasi'] == $buku['kode_lokasi']) ? 'selected' : '';
                            echo "<option value='{$row['kode_lokasi']}' $selected>{$row['nama_lokasi']}</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada lokasi</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Buku</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
