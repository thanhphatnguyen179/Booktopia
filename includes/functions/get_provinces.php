<?php
// Kết nối cơ sở dữ liệu
include('../db.php'); 

$query = "SELECT TTP_Ma, TTP_Ten FROM tinh_thanhpho";
$result = mysqli_query($connection, $query);

$provinces = [];
while ($row = mysqli_fetch_assoc($result)) {
    $provinces[] = $row;
}

echo json_encode($provinces);
?>
