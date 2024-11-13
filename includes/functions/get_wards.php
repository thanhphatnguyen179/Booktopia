<?php
// Kết nối cơ sở dữ liệu
include('../db.php'); 

$districtId = $_GET['districtId'];
$query = "SELECT XPTT_Ma, XPTT_Ten FROM xa_phuong_thitran WHERE QH_Ma = '$districtId'";
$result = mysqli_query($connection, $query);

$wards = [];
while ($row = mysqli_fetch_assoc($result)) {
    $wards[] = $row;
}

echo json_encode($wards);
?>
