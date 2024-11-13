<?php
include('../../../includes/db.php');

// Khởi tạo biến thông báo
$error = false;
$success = false;

if (isset($_POST["tacgia_add"])) {
    // Lấy dữ liệu từ biểu mẫu
    $TG_Ma = $_POST['TG_Ma']; // Mã nhà xuất bản
    $TG_Ten = trim($_POST['TG_Ten']); // Tên nhà xuất bản

    // Kiểm tra nếu TG_Ten rỗng
    if (empty($TG_Ten)) {
        $error = "Tên tác giả không được để trống.";
    } else {
        // Bảo vệ dữ liệu đầu vào khỏi SQL injection
        $TG_Ma = mysqli_real_escape_string($connection, $TG_Ma);
        $TG_Ten = mysqli_real_escape_string($connection, $TG_Ten);

        // Truy vấn INSERT INTO để thêm nhà xuất bản mới
        $sql = "INSERT INTO tacgia (TG_Ma, TG_Ten) VALUES ('$TG_Ma', '$TG_Ten')";

        // Thực hiện truy vấn
        if (mysqli_query($connection, $sql)) {
            $success = "Thêm nhà xuất bản mới thành công!";
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
                window.location.href = "../../tacgia_all.php"; // Điều hướng sau khi thêm thành công
            });
        <?php endif; ?>
    });
</script>
