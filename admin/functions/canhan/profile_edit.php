
<?php
session_start();
include('../../../includes/db.php');

// Kiểm tra xem có yêu cầu gửi dữ liệu từ form không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu người dùng hiện tại từ session
    $ND_Ma = $_SESSION['ND_Ma'];
    $ND_TenDangNhap = mysqli_real_escape_string($connection, $_POST['ND_TenDangNhap']);
    $ND_HoTen = mysqli_real_escape_string($connection, $_POST['ND_HoTen']);
    $ND_SoDT = mysqli_real_escape_string($connection, $_POST['ND_SoDT']);
    $ND_Email = mysqli_real_escape_string($connection, $_POST['ND_Email']);
    $ND_NgaySinh = mysqli_real_escape_string($connection, $_POST['ND_NgaySinh']);
    $ND_GioiTinh = mysqli_real_escape_string($connection, $_POST['ND_GioiTinh']);

    // Xử lý hình ảnh
    $ND_HinhAnh = ''; // Mặc định là rỗng nếu không có ảnh tải lên
    if (isset($_FILES['ND_HinhAnh']) && $_FILES['ND_HinhAnh']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["ND_HinhAnh"]["name"]);
        // Kiểm tra nếu tệp là hình ảnh hợp lệ
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["ND_HinhAnh"]["tmp_name"]);
        if ($check !== false) {
            // Di chuyển tệp lên thư mục lưu trữ
            if (move_uploaded_file($_FILES["ND_HinhAnh"]["tmp_name"], $target_file)) {
                $ND_HinhAnh = "uploads/" . basename($_FILES["ND_HinhAnh"]["name"]);
            } else {
                echo "<script>alert('Không thể tải ảnh lên!'); window.location.href = '../../profile_edit.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Vui lòng chọn một ảnh hợp lệ!'); window.location.href = '../../profile_edit.php';</script>";
            exit();
        }
    } else {
        // Nếu không có hình ảnh mới, giữ lại ảnh cũ từ CSDL
        $sql_current_image = "SELECT ND_HinhAnh FROM nguoidung WHERE ND_Ma = '$ND_Ma'";
        $result_current_image = mysqli_query($connection, $sql_current_image);
        
        if ($result_current_image) {
            $row_current_image = mysqli_fetch_assoc($result_current_image);
            $ND_HinhAnh = $row_current_image['ND_HinhAnh'];
        } else {
            echo "<script>alert('Có lỗi xảy ra khi lấy ảnh cũ!'); window.location.href = '../../profile_edit.php';</script>";
            exit();
        }
    }

    // Cập nhật thông tin người dùng vào cơ sở dữ liệu
    $sql_update = "UPDATE nguoidung SET 
                   ND_TenDangNhap = '$ND_TenDangNhap',
                   ND_HoTen = '$ND_HoTen',
                   ND_SoDT = '$ND_SoDT',
                   ND_Email = '$ND_Email',
                   ND_NgaySinh = '$ND_NgaySinh',
                   ND_GioiTinh = '$ND_GioiTinh',
                   ND_HinhAnh = '$ND_HinhAnh' 
                   WHERE ND_Ma = '$ND_Ma'";

if (mysqli_query($connection, $sql_update)) {
    // Chuyển hướng đến trang profile_show.php sau khi cập nhật thành công
    header("Location: ../../profile_show.php");
    exit();
} else {
    // Chuyển hướng đến trang profile_edit.php nếu có lỗi xảy ra
    header("Location: ../../profile_edit.php");
    exit();
}
} else {
// Nếu yêu cầu không hợp lệ, chuyển hướng về trang profile_edit.php
header("Location: ../../profile_edit.php");
exit();
}

?>
