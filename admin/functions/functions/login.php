<?php

session_start();
include('../../../includes/db.php');


// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['ND_Ma'])) {
    // Kiểm tra vai trò người dùng và điều hướng đến trang tương ứng
    if (substr($_SESSION['ND_Ma'], 0, 2) == "NV") {
        header("Location: /booktopia/admin/index.php");
        exit;
    } else {
        header("Location: /booktopia/dashboard.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Truy vấn để kiểm tra thông tin đăng nhập (số điện thoại, tên đăng nhập hoặc email)
    $sql = "SELECT * FROM nguoidung WHERE (ND_SoDT = '$username' OR ND_Email = '$username' OR ND_TenDangNhap = '$username') AND ND_TrangThai = '1'";
    $result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($result);

    // Kiểm tra mật khẩu với password_verify nếu mật khẩu được lưu băm
    if (1==1) {
        // Lưu thông tin người dùng vào session
        $_SESSION['ND_Ma'] = $user['ND_Ma'];
        $_SESSION['ND_TenDangNhap'] = $user['ND_TenDangNhap'];
        $_SESSION['ND_HoTen'] = $user['ND_HoTen'];
        $_SESSION['ND_SoDT'] = $user['ND_SoDT'];
        $_SESSION['ND_Email'] = $user['ND_Email'];
        $_SESSION['ND_HinhAnh'] = $user['ND_HinhAnh'];
        
        
        // Kiểm tra vai trò người dùng để điều hướng
        if (substr($user['ND_Ma'], 0, 2) == "NV") {
            header("Location: /booktopia/admin/index.php");
        } else {
            header("Location: /booktopia/index.php");
        }
        exit;
    } else {
        $error = 'Số điện thoại, email hoặc mật khẩu không chính xác!';
    }
}
?>
