<?php
// Kết nối cơ sở dữ liệu
include('../db.php');

$provinceId = $_GET['provinceId'];

// Lấy thông tin thành phố và đơn giá vận chuyển
$query = "
    SELECT TTP_Ma, TTP_Ten, TTP_DonGia 
    FROM tinh_thanhpho 
    WHERE TTP_Ma = '$provinceId'
";

$result = mysqli_query($connection, $query);


$shippingCost = 0;

if ($row = mysqli_fetch_assoc($result)) {
   
    $shippingCost = $row['TTP_DonGia']; // Get the shipping cost for the province
}

// Add the shipping cost to the response
$response = [
    
    'shippingCost' => $shippingCost,
];

echo json_encode($response);
?>
