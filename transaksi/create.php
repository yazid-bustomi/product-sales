<?php
include('../db.php');

// Query untuk mengambil data produk
$sqlProduk = $conn->query("SELECT * FROM produk");

// Input dari resquest form yang di terima
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    // Get stok produk
    $queryStok = $conn->query("SELECT stok, harga FROM produk WHERE id_produk = $id_produk");
    $produk = $queryStok->fetch_assoc();

    // Cek stok produk
    if ($jumlah > $produk['stok']) {
        $error = "Stok hanya tersedia  " . $produk['stok'];
    } else {
        // jumlahkan harga produk x jumlah barang
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Icon Font Awesome -->
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
                    <option value="<?= $row['id_produk'] ?>" data-harga="<?= $row['harga'] ?>"><?= $row['nama_produk']?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="total_harga" class="form-label">Total Harga</label>
            <input type="number" class="form-control" id="total_harga" name="total_harga" required readonly >
        </div>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required hidden value="<?= date('Y-m-d') ?>">
        <button type="submit" class="btn btn-primary me-3"><i class="fas fa-save"></i> Simpan</button>
        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </form>
</div>

<script>
document.getElementById('id_produk').addEventListener('change', calculateTotal);
document.getElementById('jumlah').addEventListener('input', calculateTotal);

// Fungsi hitung total harga dari barang yang sudah di pilih
function calculateTotal() {
    var idProduk = document.getElementById('id_produk').value;
    var jumlah = document.getElementById('jumlah').value;
    
    var harga = document.querySelector(`#id_produk option[value='${idProduk}']`).getAttribute('data-harga');
    
    if (idProduk && jumlah) {
        var totalHarga = harga * jumlah;
        document.getElementById('total_harga').value = totalHarga;
    } else {
        document.getElementById('total_harga').value = '';
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
