<?php
include '../koneksi.php';

if (isset($_GET['kode_kembali'])) {
    $kode_kembali = $_GET['kode_kembali'];
    
    // Ambil data kembali berdasarkan kode_kembali
    $sql = "SELECT kembali.*, buku.nama_buku, mhs.nama FROM kembali 
            JOIN buku ON kembali.kode_buku = buku.kode_buku 
            JOIN mhs ON kembali.nim = mhs.nim 
            WHERE kode_kembali = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kode_kembali);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $kembali = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data kembali tidak ditemukan'); window.location.href='list.php';</script>";
        exit();
    }
    
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_kembali = $_POST['kode_kembali'];
    $kode_buku = $_POST['kode_buku'];
    $nim = $_POST['nim'];
    $tgl = $_POST['tgl'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    
    // Update data kembali
    $sql = "UPDATE kembali SET kode_buku = ?, nim = ?, tgl = ?, keterangan = ?, qty = ? WHERE kode_kembali = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissii", $kode_buku, $nim, $tgl, $keterangan, $qty, $kode_kembali);
    
    if ($stmt->execute()) {
        echo "<script>alert('Data kembali berhasil diperbarui'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data kembali'); window.location.href='list.php';</script>";
    }
    
    $stmt->close();
}

// Fetch buku and mahasiswa data for dropdowns
$sql_buku = "SELECT kode_buku, nama_buku FROM buku";
$result_buku = $conn->query($sql_buku);

$sql_mhs = "SELECT nim, nama FROM mhs";
$result_mhs = $conn->query($sql_mhs);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kembali</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Kembali</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="kode_kembali">Kode Kembali</label>
                <input type="text" class="form-control" id="kode_kembali" name="kode_kembali" value="<?php echo $kembali['kode_kembali']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="kode_buku">Nama Buku</label>
                <select class="form-control" id="kode_buku" name="kode_buku" required>
                    <?php
                    if ($result_buku->num_rows > 0) {
                        while($row = $result_buku->fetch_assoc()) {
                            $selected = ($row['kode_buku'] == $kembali['kode_buku']) ? 'selected' : '';
                            echo "<option value='{$row['kode_buku']}' $selected>{$row['nama_buku']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nim">Nama Mahasiswa</label>
                <select class="form-control" id="nim" name="nim" required>
                    <?php
                    if ($result_mhs->num_rows > 0) {
                        while($row = $result_mhs->fetch_assoc()) {
                            $selected = ($row['nim'] == $kembali['nim']) ? 'selected' : '';
                            echo "<option value='{$row['nim']}' $selected>{$row['nama']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tgl">Tanggal</label>
                <input type="datetime-local" class="form-control" id="tgl" name="tgl" value="<?php echo $kembali['tgl']; ?>">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $kembali['keterangan']; ?>">
            </div>
            <div class="form-group">
                <label for="qty">Jumlah</label>
                <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $kembali['qty']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Kembali</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
