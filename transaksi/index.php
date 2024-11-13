<?php
include '../db.php';

$sql = "SELECT * FROM transaksi";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Icon Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Daftar Transaksi</h2>
        <div class="row">
            <div class="col-md-4">
                <a href="create.php" class="btn btn-info mb-3"><i class="fas fa-cart-plus"></i> Tambah Transaksi</a>
            </div>
            <div class="col-md-8 text-md-end">
                <a href="../index.php" class="btn btn-success mb-3 me-4"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="../produk/" class="btn btn-primary mb-3 me-3"><i class="fas fa-box"></i> Produk</a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['id_produk'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td><?= $row['total_harga'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $row['id_transaksi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $no++ ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>