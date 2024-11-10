<?php
include('../../../includes/db.php');

$updateSuccess = false; // Biến này sẽ xác định trạng thái cập nhật

if (isset($_POST["tacgia_edit"])) {
    $TG_Ma = $_POST['TG_Ma'];
    $TG_Ten = $_POST['TG_Ten'];

    // Bảo vệ dữ liệu đầu vào
    $TG_Ma = mysqli_real_escape_string($connection, $TG_Ma);
    $TG_Ten = mysqli_real_escape_string($connection, $TG_Ten);

    // Thực hiện truy vấn cập nhật
    $sql = "UPDATE tacgia SET TG_Ten = '$TG_Ten' WHERE TG_Ma = '$TG_Ma'";
    
    if (mysqli_query($connection, $sql)) {
        $updateSuccess = true; // Đánh dấu cập nhật thành công
    } else {
        echo "Lỗi: " . mysqli_error($connection);
    }
}

// Đóng kết nối
$connection->close();
?>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if ($updateSuccess): ?> // Kiểm tra xem cập nhật thành công
            swal({
                title: "Thành công!",
                text: "Cập nhật tác giả thành công!",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "../../tacgia_all.php"; // Điều hướng sau khi người dùng đóng thông báo
            });
        <?php endif; ?>
    });
</script>
