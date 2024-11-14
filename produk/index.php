<?php
include '../db.php';

// Query tabel produk
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Icon Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Daftar Produk</h2>

        <div class="row">
            <div class="col-md-4">
                <a href="create.php" class="btn btn-primary mb-3 ms-3"><i class="fas fa-plus"></i> Tambah Produk</a>
            </div>
            <div class="col-md-8 text-md-end">
                <a href="../index.php" class="btn btn-success mb-3 me-4"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="../transaksi/index.php" class="btn btn-info mb-3 me-3"><i class="fas fa-shopping-cart"></i> Transaksi</a>
            </div>
        </div>

        <table class="table table-bordered" id="tableProduk">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $num ?></td>
                        <td><?= $row['nama_produk'] ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id_produk'] ?>" class="btn btn-warning btn-sm me-2"><i class="fas fa-edit"></i> Edit</a>
                            <a href="delete.php?id=<?= $row['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php $num++ ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#tableProduk').DataTable();
        });
    </script>
</body>

</html>