<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_pinjam = $_POST['kode_pinjam'];
    $kode_buku = $_POST['kode_buku'];
    $nim = $_POST['nim'];
    $tgl = $_POST['tgl'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    // Check stock availability
    $check_stock_sql = "SELECT stock FROM buku WHERE kode_buku = ?";
    $check_stock_stmt = $conn->prepare($check_stock_sql);
    $check_stock_stmt->bind_param("i", $kode_buku);
    $check_stock_stmt->execute();
    $check_stock_stmt->bind_result($stock);
    $check_stock_stmt->fetch();
    $check_stock_stmt->close();

    if ($stock < $qty) {
        echo "<script>alert('Stok buku kurang dari jumlah pinjam'); window.location.href='add.php';</script>";
    } else {
        $sql = "INSERT INTO pinjam (kode_pinjam, kode_buku, nim, tgl, keterangan, qty) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiissi", $kode_pinjam, $kode_buku, $nim, $tgl, $keterangan, $qty);

        if ($stmt->execute()) {
            // Update stock in buku table
            $update_stock_sql = "UPDATE buku SET stock = stock - ? WHERE kode_buku = ?";
            $update_stock_stmt = $conn->prepare($update_stock_sql);
            $update_stock_stmt->bind_param("ii", $qty, $kode_buku);
            $update_stock_stmt->execute();
            $update_stock_stmt->close();

            header("Location: list.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
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
    <title>Tambah Pinjam</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Tambah Pinjam</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="kode_pinjam">Kode Pinjam</label>
                <input type="text" class="form-control" id="kode_pinjam" name="kode_pinjam" required>
            </div>
            <div class="form-group">
                <label for="kode_buku">Nama Buku</label>
                <select class="form-control" id="kode_buku" name="kode_buku" required>
                    <?php
                    if ($result_buku->num_rows > 0) {
                        while($row = $result_buku->fetch_assoc()) {
                            echo "<option value='{$row['kode_buku']}'>{$row['nama_buku']}</option>";
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
                            echo "<option value='{$row['nim']}'>{$row['nama']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tgl">Tanggal</label>
                <input type="datetime-local" class="form-control" id="tgl" name="tgl" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="form-group">
                <label for="qty">Jumlah</label>
                <input type="number" class="form-control" id="qty" name="qty" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali ke Daftar Pinjam</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
