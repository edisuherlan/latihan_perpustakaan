<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'config/navbar.php'; ?>
    <div class="container">
        <h1 class="mt-4">Perpustakaan Management System</h1>
        <ul class="list-group mt-3">
            <li class="list-group-item"><a href="buku/list.php">Manajemen Buku</a></li>
            <li class="list-group-item"><a href="pengarang/list.php">Manajemen Pengarang</a></li>
            <li class="list-group-item"><a href="mhs/list.php">Manajemen Mahasiswa</a></li>
            <li class="list-group-item"><a href="lokasi/list.php">Manajemen Lokasi</a></li>
            <li class="list-group-item"><a href="pinjam/list.php">Manajemen Pinjam</a></li>
            <li class="list-group-item"><a href="kembali/list.php">Manajemen Kembali</a></li>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
