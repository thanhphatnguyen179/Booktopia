<?php 

// Kết nối cơ sở dữ liệu
include('../db.php'); 
// Bắt đầu session để có thể sử dụng session
session_start();

// check-promo-code.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the promotion code from the request
    $promoCode = $_POST['promo_code'];

    // Dummy data for valid promo codes (replace with your actual logic)
    $validPromoCodes = ['DISCOUNT10', 'FREESHIP', 'SALE20'];

    // Check if the promo code is valid
    if (in_array($promoCode, $validPromoCodes)) {
        // Return success response
        echo json_encode(['valid' => true]);
    } else {
        // Return failure response
        echo json_encode(['valid' => false]);
    }
}


?>