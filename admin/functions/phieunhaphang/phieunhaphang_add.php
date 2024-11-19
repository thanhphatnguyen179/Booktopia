<?php
// Bao gồm kết nối cơ sở dữ liệu
include('../../../includes/db.php');

// Biến để lưu thông tin lỗi
$error = false;
$errorMessage = "";

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy các giá trị từ các trường ẩn trong form
    $PNH_Ma = isset($_POST['PNH_Ma']) ? $_POST['PNH_Ma'] : '';
    $NV_Ma = isset($_POST['NV_Ma']) ? $_POST['NV_Ma'] : '';
    $K_Ma = isset($_POST['K_Ma']) ? $_POST['K_Ma'] : '';
    
    // Lấy các mảng giá trị từ các trường ẩn S_Ma, CTPNH_SoLuong, CTPNH_DonGia
    $S_Ma = isset($_POST['S_Ma']) ? $_POST['S_Ma'] : [];
    $CTPNH_SoLuong = isset($_POST['CTPNH_SoLuong']) ? $_POST['CTPNH_SoLuong'] : [];
    $CTPNH_DonGia = isset($_POST['CTPNH_DonGia']) ? $_POST['CTPNH_DonGia'] : [];

    // Kiểm tra nếu các giá trị cần thiết chưa được cung cấp
    if (empty($PNH_Ma) || empty($NV_Ma) || empty($K_Ma) || empty($S_Ma) || empty($CTPNH_SoLuong) || empty($CTPNH_DonGia)) {
        $error = true;
        $errorMessage = "Vui lòng điền đầy đủ thông tin phiếu nhập hàng.";
    }

    if (!$error) {
        // Tính toán tổng tiền (giả sử tính tổng dựa trên CTPNH_SoLuong và CTPNH_DonGia)
        $tongTien = 0;
        foreach ($CTPNH_SoLuong as $index => $soLuong) {
            $tongTien += $soLuong * $CTPNH_DonGia[$index];
        }

        // Lấy ngày nhập hiện tại
        $PNH_NgayNhap = date('Y-m-d H:i:s'); // Định dạng ngày giờ

        // Truy vấn chèn vào bảng phieunhaphang
        $queryPhieuNhap = "INSERT INTO `phieunhaphang`(`PNH_Ma`, `PNH_NgayNhap`, `PNH_TongTien`, `NV_Ma`, `K_Ma`) 
                           VALUES ('$PNH_Ma', '$PNH_NgayNhap', '$tongTien', '$NV_Ma', '$K_Ma')";
        
        if (mysqli_query($connection, $queryPhieuNhap)) {
            $successMessage = "Thêm phiếu nhập hàng thành công.";
        } else {
            $error = true;
            $errorMessage = "Lỗi khi thêm phiếu nhập hàng: " . mysqli_error($connection);
        }

        // Lặp qua từng sản phẩm để chèn vào bảng chitietpnh
        foreach ($S_Ma as $index => $s_ma) {
            $soLuong = $CTPNH_SoLuong[$index];
            $donGia = $CTPNH_DonGia[$index];
            
            // Truy vấn chèn vào bảng chitietpnh
            $queryChiTiet = "INSERT INTO `chitietpnh`(`S_Ma`, `PNH_Ma`, `CTPNH_SoLuong`, `CTPNH_DonGia`) 
                             VALUES ('$s_ma', '$PNH_Ma', '$soLuong', '$donGia')";
            
            if (!mysqli_query($connection, $queryChiTiet)) {
                $error = true;
                $errorMessage = "Lỗi khi thêm chi tiết phiếu nhập cho sản phẩm $s_ma: " . mysqli_error($connection);
                break; // Nếu có lỗi, thoát khỏi vòng lặp
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Nội dung form ở đây -->

    <?php if ($error): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Có lỗi xảy ra!',
                text: '<?php echo $errorMessage; ?>',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            }).then(function() {
                window.location.href = '/booktopia/admin/index.php'; // Redirect sau khi thông báo lỗi
            });
        </script>
    <?php elseif ($successMessage): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '<?php echo $successMessage; ?>',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            }).then(function() {
                window.location.href = '/booktopia/admin/index.php'; // Redirect sau khi thông báo thành công
            });
        </script>
    <?php endif; ?>

</body>
</html>