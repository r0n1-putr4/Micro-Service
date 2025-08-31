<?php

include "koneksi.php";

$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(array("status" => true,"message" => "Data Tersedia" ,"data" => $data));
} else {
    echo json_encode(array('status'=>false,'message' => "Data Tidak Tersedia"));
}
$conn->close();
