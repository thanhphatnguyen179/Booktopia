<?php
include('../../../includes/db.php');

$updateSuccess = false; // Biến này sẽ xác định trạng thái cập nhật

if (isset($_POST["chude_edit"])) {
    $cd_ma = $_POST['cd_ma'];
    $cd_ten = $_POST['cd_ten'];

    // Bảo vệ dữ liệu đầu vào
    $cd_ma = mysqli_real_escape_string($connection, $cd_ma);
    $cd_ten = mysqli_real_escape_string($connection, $cd_ten);

    // Thực hiện truy vấn cập nhật
    $sql = "UPDATE chude SET CD_Ten = '$cd_ten' WHERE CD_Ma = '$cd_ma'";
    
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
                window.location.href = "../../chude_all.php"; // Điều hướng sau khi người dùng đóng thông báo
            });
        <?php endif; ?>
    });
</script>
