<?php 
include '../db.php';

// Menangkap ID
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Query Delete
    $sql = "DELETE FROM transaksi WHERE id_transaksi = $id";

    if($conn->query($sql) == TRUE){
        header("Location: index.php");
        exit();
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
}else{
    echo "Transaksi tidak di temukan";
    exit();
}

?>