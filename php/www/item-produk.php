<?php

include "koneksi.php";

$id_produk = $_GET["id_produk"];
$sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
$result = $conn->query($sql);
if ($result->num_rows > 0) {    
    $data = $result->fetch_assoc();
    echo json_encode(array("status" => true, 'message' => "Data Tersedia", "data" => $data));
} else {
    echo json_encode(array("status" => false, 'message' => "Data Tidak Tersedia"));
}
$conn->close();
