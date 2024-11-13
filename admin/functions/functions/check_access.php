<?php
session_start();

// Kiểm tra nếu chưa đăng nhập
if (!isset($_SESSION['ND_Ma'])) {
    // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    header("Location: /login.php");
    exit;
}

// Nếu đã đăng nhập, tiếp tục hiển thị nội dung của trang
if (substr($_SESSION['ND_Ma'], 0,2 ) != "NV") {
    // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    header("Location: /login.php");
    exit;
}



?>
