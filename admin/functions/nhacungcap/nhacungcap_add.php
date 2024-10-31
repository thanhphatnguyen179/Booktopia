<?php
include('../../../includes/db.php');

// Khởi tạo biến thông báo
$error = false;
$success = false;

if (isset($_POST["nhacungcap_add"])) {
    // Lấy dữ liệu từ biểu mẫu
    $ncc_ma = $_POST['ncc_ma']; // Mã nhà cung cấp
    $ncc_ten = trim($_POST['ncc_ten']); // Tên nhà cung cấp

    // Kiểm tra nếu ncc_ten rỗng
    if (empty($ncc_ten)) {
        $error = "Tên nhà cung cấp không được để trống.";
    } else {
        // Bảo vệ dữ liệu đầu vào khỏi SQL injection
        $ncc_ma = mysqli_real_escape_string($connection, $ncc_ma);
        $ncc_ten = mysqli_real_escape_string($connection, $ncc_ten);

        // Truy vấn INSERT INTO để thêm nhà cung cấp mới
        $sql = "INSERT INTO nhacungcap (NCC_Ma, NCC_Ten) VALUES ('$ncc_ma', '$ncc_ten')";

        // Thực hiện truy vấn
        if (mysqli_query($connection, $sql)) {
            $success = "Thêm nhà cung cấp mới thành công!";
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
                window.location.href = "../../nhacungcap_all.php"; // Điều hướng sau khi thêm thành công
            });
        <?php endif; ?>
    });
</script>
