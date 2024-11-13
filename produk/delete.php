<?php
include('../db.php'); 

// Menangkap Id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk delete
    $sql = "DELETE FROM produk WHERE id_produk = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID produk tidak ditemukan.";
    exit();
}
?>
