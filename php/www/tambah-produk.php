<?php

include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST["nama_produk"];
    $kategori = $_POST["kategori"]; 
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $deskripsi  = $_POST["deskripsi"];

    $sql = "INSERT INTO produk VALUES (NULL, '$nama_produk','$kategori', $harga, $stok, '$deskripsi')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => true,'message' => 'Data Berhasil Ditambahkan'));
    } else {
        echo  json_encode(array("status" => false,'message' => "Error: " . $sql . "<br>" . $conn->error));
    }
    $conn->close();
}
?>