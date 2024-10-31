<?php
include('../../../includes/db.php');

$updateSuccess = false; // Biến này sẽ xác định trạng thái cập nhật

if (isset($_POST["nhacungcap_edit"])) {
    $NCC_Ma = $_POST['NCC_Ma'];
    $NCC_Ten = $_POST['NCC_Ten'];

    // Bảo vệ dữ liệu đầu vào
    $NCC_Ma = mysqli_real_escape_string($connection, $NCC_Ma);
    $NCC_Ten = mysqli_real_escape_string($connection, $NCC_Ten);

    // Thực hiện truy vấn cập nhật
    $sql = "UPDATE nhacungcap SET NCC_Ten = '$NCC_Ten' WHERE NCC_Ma = '$NCC_Ma'";
    
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
                text: "Cập nhật chủ đề thành công!",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "../../nhacungcap_all.php"; // Điều hướng sau khi người dùng đóng thông báo
            });
        <?php endif; ?>
    });
</script>
