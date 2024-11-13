<?php
// check_username.php

// Kết nối cơ sở dữ liệu
include('../../../includes/db.php');

// Lấy tên đăng nhập từ yêu cầu POST
if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);

    // Kiểm tra định dạng tên đăng nhập (ví dụ: dài tối thiểu 4 ký tự, chỉ chứa chữ cái và số)
    if (strlen($username) < 4 || !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        echo json_encode(["status" => "invalid_format"]);
        exit;
    }

    // Kiểm tra xem tên đăng nhập đã có trong cơ sở dữ liệu chưa
    $sql = "SELECT ND_TenDangNhap FROM nguoidung WHERE ND_TenDangNhap = '$username'";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        die('Query Error: ' . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) > 0) {
        // Tên đăng nhập đã tồn tại
        echo json_encode(["status" => "taken"]);
    } else {
        // Tên đăng nhập chưa tồn tại
        echo json_encode(["status" => "available"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No username provided"]);
}
?>
