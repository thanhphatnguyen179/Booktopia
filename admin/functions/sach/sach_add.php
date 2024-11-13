<?php
include('../../../includes/db.php');

// Khởi tạo biến thông báo
$error = false;
$success = false;

if (isset($_POST["sach_add"])) {
    // Lấy dữ liệu từ biểu mẫu
    $s_ma = $_POST['s_ma']; // Mã sách
    $s_ten = trim($_POST['s_ten']); // Tên sách
    $s_hinhanh = $_FILES['s_hinhanh']; // Hình ảnh (optional)
    $s_namxuatban = $_POST['s_namxuatban']; // Năm xuất bản
    $s_ngonngu = isset($_POST['s_ngonngu']) ? $_POST['s_ngonngu'] : ""; // Ngôn ngữ
    $s_tennguoidich = isset($_POST['s_tennguoidich']) ? $_POST['s_tennguoidich'] : ""; // Ngôn ngữ
    $s_trongluong = isset($_POST['s_trongluong']) ? $_POST['s_trongluong'] : ""; // Trọng lượng
    $s_kichthuoc = isset($_POST['s_kichthuoc']) ? $_POST['s_kichthuoc'] : ""; // Kích thước
    $s_sotrang =  isset($_POST['s_sotrang']) ? $_POST['s_sotrang'] : ""; // Số trang
    $s_hinhthuc = isset($_POST['s_hinhthuc']) ? $_POST['s_hinhthuc'] : ""; // Hình thức
    $s_mota = isset($_POST['s_mota']) ? $_POST['s_mota'] : ""; // Mô tả
    $tg_ma = $_POST['TG_Ma']; // Mã tác giả
    $nxb_ma = $_POST['NXB_Ma']; // Mã nhà xuất bản
    $ncc_ma = $_POST['NCC_Ma']; // Mã nhà cung cấp
    $cd_ma = $_POST['CD_Ma']; // Mã chu de
    $s_sotrang =  (int) $_POST['s_sotrang'] ;

    $s_dongia = (int) $_POST['s_dongia'];

    $K_Ma = $_POST["K_Ma"];
    $s_soluong = (int) $_POST['s_soluong'];

    // Kiểm tra nếu tên sách rỗng
    if (empty($s_ten)) {
        $error = "Tên sách không được để trống.";
    } else {
        // Bảo vệ dữ liệu đầu vào khỏi SQL injection
        $s_ma = mysqli_real_escape_string($connection, $s_ma);
        $s_ten = mysqli_real_escape_string($connection, $s_ten);
        
        $s_namxuatban = mysqli_real_escape_string($connection, $s_namxuatban);
        $s_ngonngu = mysqli_real_escape_string($connection, $s_ngonngu);
        $s_tennguoidich = mysqli_real_escape_string($connection, $s_tennguoidich);
        $s_trongluong = mysqli_real_escape_string($connection, $s_trongluong);
        $s_kichthuoc = mysqli_real_escape_string($connection, $s_kichthuoc);
        $s_sotrang = mysqli_real_escape_string($connection, $s_sotrang);
        $s_hinhthuc = mysqli_real_escape_string($connection, $s_hinhthuc);
        $s_mota = mysqli_real_escape_string($connection, $s_mota);
        $tg_ma = mysqli_real_escape_string($connection, $tg_ma);
        $nxb_ma = mysqli_real_escape_string($connection, $nxb_ma);
        $ncc_ma = mysqli_real_escape_string($connection, $ncc_ma);
        $cd_ma = mysqli_real_escape_string($connection, $cd_ma);
        $s_dongia = mysqli_real_escape_string($connection,  $s_dongia);

        $K_Ma = mysqli_real_escape_string($connection, $K_Ma);
        $s_soluong = mysqli_real_escape_string($connection, $s_soluong);
        // Kiểm tra hình ảnh đã được chọn chưa
        if ($s_hinhanh['error'] == 0) {
            $target_dir = "../../../assets/images/book/"; // Thư mục lưu hình ảnh
            $target_file = $target_dir . $s_ma . "." . pathinfo($s_hinhanh["name"], PATHINFO_EXTENSION); // Đổi tên file thành mã sách

            // Kiểm tra định dạng file (ví dụ chỉ cho phép jpg, png, jpeg)
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowedTypes = array("jpg", "jpeg", "png", "webp");

            if (!in_array($imageFileType, $allowedTypes)) {
                $error = "Chỉ chấp nhận các định dạng hình ảnh JPG, JPEG, PNG.";
            } else {
                // Di chuyển tệp hình ảnh vào thư mục
                if (move_uploaded_file($s_hinhanh["tmp_name"], $target_file)) {
                    // Cập nhật đường dẫn hình ảnh vào cơ sở dữ liệu
                    $s_hinhanh_path = "assets/images/book/" . $s_ma . "." . $imageFileType;
                } else {
                    $error = "Lỗi khi tải lên hình ảnh.";
                }
            }
        } else {
            $s_hinhanh_path = "../../assets/images/book/no_image.jpg"; // Nếu không có hình ảnh, để trống
        }
        // Truy vấn INSERT INTO để thêm sách mới
        $sql = "INSERT INTO sach (S_Ma, S_Ten, S_HinhAnh, S_NamXuatBan, S_NgonNgu, S_TenNguoiDich, 
        S_TrongLuong, S_KichThuoc, S_SoTrang, S_HinhThuc, S_MoTa, S_ThoiGianTao, S_TrangThai, TG_Ma, NXB_Ma, NCC_Ma, CD_Ma) 
        VALUES ('$s_ma', '$s_ten', '$s_hinhanh_path', '$s_namxuatban', '$s_ngonngu', '$s_tennguoidich', 
        '$s_trongluong', '$s_kichthuoc', '$s_sotrang', '$s_hinhthuc', '$s_mota', current_timestamp(), 1,
        '$tg_ma', '$nxb_ma', '$ncc_ma', '$cd_ma')";


        

        // Thực hiện truy vấn
        if (mysqli_query($connection, $sql)) {
            $success = "Thêm sách mới thành công!";
        } else {
            $error = "Lỗi: " . mysqli_error($connection); // Hiển thị lỗi nếu có
        }

        $sql_gianiemyet = "INSERT INTO gianiemyet (S_Ma, GNY_NgayHieuLuc, GNY_DonGia) 
                  VALUES ('$s_ma', current_timestamp(), $s_dongia)";
        $result_gia = mysqli_query($connection, $sql_gianiemyet);

        if (!$result_gia) {
            die('Error: ' . mysqli_error($connection));
        }


        $sql_tonkho = "INSERT INTO `tonkho`(`S_Ma`, `K_Ma`, `SoLuong`) VALUES ('$s_ma','$K_Ma','$s_soluong')";

        $result_tonkho = mysqli_query($connection, $sql_tonkho);

        if (!$result_tonkho) {
            die('Error: ' . mysqli_error($connection));
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
                window.location.href = "../../sach_all.php"; // Điều hướng sau khi thêm thành công
            });
        <?php endif; ?>
    });
</script>
