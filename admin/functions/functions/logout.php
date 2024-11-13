<?php
    session_start();

    // Xóa tất cả các biến session
    $_SESSION['ND_Ma'] = null;
    $_SESSION['ND_TenDangNhap'] = null;
    $_SESSION['ND_HoTen'] = null;
    $_SESSION['ND_SoDT'] = null;
    $_SESSION['ND_Email'] = null;
    $_SESSION['ND_HinhAnh'] = null;

    // Hoặc có thể dùng session_unset() để xóa tất cả biến session
    session_unset();

    // Hủy session
    session_destroy();

    // Xóa cookie session (nếu có)
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    // Chuyển hướng người dùng về trang đăng nhập hoặc trang chủ
    header("Location: /booktopia/login.php");
    exit;
?>
