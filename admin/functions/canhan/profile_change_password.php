<?php
session_start();
include('../../../includes/db.php');

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $old_password = mysqli_real_escape_string($connection, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);
    
    // Lấy mật khẩu hiện tại từ cơ sở dữ liệu
    $ND_Ma = $_SESSION['ND_Ma'];
    $sql = "SELECT ND_MatKhau FROM nguoidung WHERE ND_Ma = '$ND_Ma'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_password = $row['ND_MatKhau'];

    // Kiểm tra mật khẩu cũ
    if (password_verify($old_password, $current_password)) {
        // Kiểm tra mật khẩu mới và xác nhận mật khẩu có khớp không
        if ($new_password == $confirm_password) {
            // Mã hóa mật khẩu mới
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Cập nhật mật khẩu mới vào cơ sở dữ liệu
            $update_sql = "UPDATE nguoidung SET ND_MatKhau = '$hashed_new_password' WHERE ND_Ma = '$ND_Ma'";
            if (mysqli_query($connection, $update_sql)) {
                echo "<div class='alert alert-success'>Mật khẩu đã được thay đổi thành công!</div>";
                header("Location: ../../profile_show.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Lỗi khi cập nhật mật khẩu. Vui lòng thử lại.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Mật khẩu mới và xác nhận mật khẩu không khớp.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Mật khẩu cũ không đúng.</div>";
    }
}
?>
