<?php
include('../../../includes/db.php');

// Khởi tạo biến thông báo
$error = false;
$success = false;

if (isset($_POST["chude_add"])) {
    // Lấy dữ liệu từ biểu mẫu
    $cd_ma = $_POST['cd_ma']; // Mã chủ đề
    $cd_ten = trim($_POST['cd_ten']); // Tên chủ đề

    // Kiểm tra nếu cd_ten rỗng
    if (empty($cd_ten)) {
        $error = "Tên chủ đề không được để trống.";
    } else {
        // Bảo vệ dữ liệu đầu vào khỏi SQL injection
        $cd_ma = mysqli_real_escape_string($connection, $cd_ma);
        $cd_ten = mysqli_real_escape_string($connection, $cd_ten);

        // Truy vấn INSERT INTO để thêm chủ đề mới
        $sql = "INSERT INTO chude (CD_Ma, CD_Ten) VALUES ('$cd_ma', '$cd_ten')";

        // Thực hiện truy vấn
        if (mysqli_query($connection, $sql)) {
            $success = "Thêm chủ đề mới thành công!";
        } else {
            $error = "Lỗi: " . mysqli_error($connection); // Hiển thị lỗi nếu có
        }
    }
}

// Đóng kết nối
$connection->close();
?>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if ($error): ?> // Kiểm tra có lỗi
            swal({
                title: "Lỗi",
                text: "<?php echo $error; ?>",
                icon: "error",
                button: "OK",
            });
        <?php elseif ($success): ?> // Kiểm tra thành công
            swal({
                title: "Thành công",
                text: "<?php echo $success; ?>",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "../../chude_all.php"; // Điều hướng sau khi thêm thành công
            });
        <?php endif; ?>
    });
</script>
