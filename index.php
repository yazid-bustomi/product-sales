<?php
include 'db.php';

$produkCount = $conn->query("SELECT COUNT(*) AS total FROM produk")->fetch_assoc()['total'];

$transaksiCount = $conn->query("SELECT COUNT(*) AS total FROM transaksi")->fetch_assoc()['total'];

// Query produk untuk Chart
$produkData = $conn->query("SELECT nama_produk, stok FROM produk");
$produkLabels = [];
$produkStok = [];

while ($row = $produkData->fetch_assoc()) {
    $produkLabels[] = $row['nama_produk'];
    $produkStok[] = $row['stok'];
}

// Query transaksi untuk Chart

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Icon Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="produk/index.php" class="text-decoration-none">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Produk <i class="fas fa-box"></i></h5>
                            <p class="card-text display-4"><?= $produkCount ?></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="transaksi/index.php" class="text-decoration-none">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Transaksi <i class="fas fa-shopping-cart"></i></h5>
                            <p class="card-text display-4"><?= $transaksiCount ?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Grafik Produk
                    </div>
                    <div class="card-body">
                        <canvas id="produkChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Grafik Transaksi
                    </div>
                    <div class="card-body">
                        <canvas id="transaksiChart"></canvas>
                    </div>
                </div>
            </div>

        </div>




    </div>

    <script>
        const ctProd = document.getElementById('produkChart').getContext('2d');
        const produkChart = new Chart(ctProd, {
            type: 'bar',
            data: {
                labels: <?= json_encode($produkLabels) ?>,
                datasets: [{
                    label: 'Stok Produk',
                    data: <?= json_encode($produkStok) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>