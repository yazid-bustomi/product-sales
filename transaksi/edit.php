<?php
include('../db.php');

// Get data produk untuk menu edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM transaksi WHERE id_transaksi = $id";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error: " . $conn->error);
    }
    $row = $result->fetch_assoc();

    $sql_produk = "SELECT id_produk, nama_produk, harga, stok FROM produk";
    $result_produk = $conn->query($sql_produk);
}

//  Edit dari form yang sudah di submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];
    $tanggal = $_POST['tanggal'];

    // query transaksi
    $queryTransaksi = $conn->query("SELECT jumlah FROM transaksi WHERE id_transaksi = $id");
    $transaksi = $queryTransaksi->fetch_assoc();
    $jumlah_awal = $transaksi['jumlah'];

    // query stok
    $queryStok = $conn->query("SELECT stok FROM produk WHERE id_produk = $id_produk");
    $produk = $queryStok->fetch_assoc();
    $stok_awal = $produk['stok'];

    // Hitung selisih dan jumlahkan stok baru
    $selisih = $jumlah_awal - $jumlah;   // jumlah awal produk, dikurangi jumlah baru hasil edit
    $stok_baru = $stok_awal + $selisih;

    if ($stok_baru < 0) {
        $error = "Stok hanya tersedia  " . $produk['stok'];
    } else {
        // Update stok produk
        $conn->query("UPDATE produk SET stok = $stok_baru WHERE id_produk = $id_produk");

        // Update transaksi
        $sql = "UPDATE transaksi SET id_produk = '$id_produk', jumlah = '$jumlah', total_harga = '$total_harga', tanggal = '$tanggal' WHERE id_transaksi = $id";
        if ($conn->query(query: $sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- Icon Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Transaksi</h2>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id_produk" class="form-label">Nama Produk</label>
                <select class="form-select" id="id_produk" name="id_produk" required>
                    <option value="">Pilih Produk</option>
                    <?php
                    while ($prod = $result_produk->fetch_assoc()) :
                    ?>
                        <option value="<?= $prod['id_produk'] ?>" data-harga="<?= $prod['harga'] ?>" <?= ($prod['id_produk'] == $row['id_produk']) ? 'selected' : '' ?>>
                            <?= $prod['nama_produk'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $row['jumlah'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?= $row['total_harga'] ?>" required readonly>
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
</body>

</html>