<?php
include('../../../includes/db.php');

$updateSuccess = false; // Biến này sẽ xác định trạng thái cập nhật

if (isset($_POST["nhaxuatban_edit"])) {
    $NXB_Ma = $_POST['NXB_Ma'];
    $NXB_Ten = $_POST['NXB_Ten'];

    // Bảo vệ dữ liệu đầu vào
    $NXB_Ma = mysqli_real_escape_string($connection, $NXB_Ma);
    $NXB_Ten = mysqli_real_escape_string($connection, $NXB_Ten);

    // Thực hiện truy vấn cập nhật
    $sql = "UPDATE nhaxuatban SET NXB_Ten = '$NXB_Ten' WHERE NXB_Ma = '$NXB_Ma'";
    
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
                text: "Cập nhật nhà xuất bản thành công!",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "../../nhaxuatban_all.php"; // Điều hướng sau khi người dùng đóng thông báo
            });
        <?php endif; ?>
    });
</script>
