<?php
$host = 'localhost';
$user = 'root'; 
$password = ''; 
$dbname = 'akhmad_yazid_bustomi_001'; 

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi jika ada error
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
