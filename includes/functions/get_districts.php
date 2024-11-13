<?php
// Kết nối cơ sở dữ liệu
include('../db.php'); 

$provinceId = $_GET['provinceId'];
$query = "SELECT QH_Ma, QH_Ten FROM quanhuyen WHERE TTP_Ma = '$provinceId'";
$result = mysqli_query($connection, $query);

$districts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $districts[] = $row;
}

echo json_encode($districts);
?>
