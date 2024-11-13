<?php
include('../db.php');

// Query untuk mengambil data produk
$sqlProduk = $conn->query("SELECT * FROM produk");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    // Cek stok produk
    $queryStok = $conn->query("SELECT stok, harga FROM produk WHERE id_produk = $id_produk");
    $produk = $queryStok->fetch_assoc();

    if ($jumlah > $produk['stok']) {
        $error = "Stok tidak mencukupi! Stok tersedia hanya " . $produk['stok'];
    } else {
        $total_harga = $produk['harga'] * $jumlah;

        // Kurangi stok produk
        $conn->query("UPDATE produk SET stok = stok - $jumlah WHERE id_produk = $id_produk");

        // Simpan transaksi
        $sqlInsert = "INSERT INTO transaksi (id_produk, jumlah, total_harga, tanggal) VALUES ($id_produk, $jumlah, $total_harga, '$tanggal')";
        if ($conn->query($sqlInsert)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Gagal menyimpan transaksi!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Transaksi</h2>
    
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="id_produk" class="form-label">Nama Produk</label>
            <select class="form-select" id="id_produk" name="id_produk" required>
                <option value="">Pilih Produk</option>
                <?php while ($row = $sqlProduk->fetch_assoc()) : ?>
                    <option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required hidden value="<?= date('Y-m-d') ?>">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
