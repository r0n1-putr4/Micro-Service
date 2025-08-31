<?php

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST["id_produk"];
    $sql = "DELETE FROM produk WHERE id_produk = $id_produk";
    $result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => true, 'message' => "Data Berhasil Dihapus"));
    } else {
        echo json_encode(array("status" => false, 'message' => "Data Tidak Tersedia"));
    }
    $conn->close();
}
