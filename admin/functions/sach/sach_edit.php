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
    $s_tennguoidich = isset($_POST['s_tennguoidich']) ? $_POST['s_tennguoidich'] : ""; // Người dịch
    $s_trongluong = isset($_POST['s_trongluong']) ? $_POST['s_trongluong'] : ""; // Trọng lượng
    $s_kichthuoc = isset($_POST['s_kichthuoc']) ? $_POST['s_kichthuoc'] : ""; // Kích thước
    $s_sotrang = isset($_POST['s_sotrang']) ? (int) $_POST['s_sotrang'] : ""; // Số trang
    $s_hinhthuc = isset($_POST['s_hinhthuc']) ? $_POST['s_hinhthuc'] : ""; // Hình thức
    $s_mota = isset($_POST['s_mota']) ? $_POST['s_mota'] : ""; // Mô tả
    $tg_ma = $_POST['TG_Ma']; // Mã tác giả
    $nxb_ma = $_POST['NXB_Ma']; // Mã nhà xuất bản
    $ncc_ma = $_POST['NCC_Ma']; // Mã nhà cung cấp
    $cd_ma = $_POST['CD_Ma']; // Mã chủ đề
    $s_dongia = (int) $_POST['s_dongia'];

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
        $s_dongia = mysqli_real_escape_string($connection, $s_dongia);


        // Lấy đường dẫn hình ảnh cũ từ CSDL
        $sql_hinhanh_cu = "SELECT S_HinhAnh FROM sach WHERE S_Ma = '$s_ma'";
        $result_hinhanh_cu = mysqli_query($connection, $sql_hinhanh_cu);
        $row_hinhanh_cu = mysqli_fetch_array($result_hinhanh_cu);

        // Nếu không có hình ảnh mới, sử dụng hình ảnh cũ
        if ($_FILES['s_hinhanh']['error'] == 4) { // Không có file hình ảnh
            $s_hinhanh_path = $row_hinhanh_cu['S_HinhAnh'];
        } else {
            // Nếu có hình ảnh mới
            $target_dir = "../../../assets/images/book/"; // Thư mục lưu hình ảnh
            $imageFileType = strtolower(pathinfo($s_hinhanh["name"], PATHINFO_EXTENSION));
            $target_file = $target_dir . $s_ma . "." . $imageFileType; // Đổi tên file thành mã sách

            // Kiểm tra định dạng file (chỉ cho phép jpg, png, jpeg, webp)
            $allowedTypes = array("jpg", "jpeg", "png", "webp");
            if (!in_array($imageFileType, $allowedTypes)) {
                $error = "Chỉ chấp nhận các định dạng hình ảnh JPG, JPEG, PNG, WEBP.";
            } else {
                // Kiểm tra xem hình ảnh mới có giống hình ảnh cũ không
                if ($row_hinhanh_cu['S_HinhAnh'] == "assets/images/book/" . $s_ma . "." . $imageFileType) {
                    // Nếu hình ảnh giống nhau, không cập nhật
                    $s_hinhanh_path = $row_hinhanh_cu['S_HinhAnh'];
                } else {
                    // Di chuyển tệp hình ảnh vào thư mục
                    if (move_uploaded_file($s_hinhanh["tmp_name"], $target_file)) {
                        // Cập nhật đường dẫn hình ảnh vào cơ sở dữ liệu
                        $s_hinhanh_path = "assets/images/book/" . $s_ma . "." . $imageFileType;
                    } else {
                        $error = "Lỗi khi tải lên hình ảnh.";
                    }
                }
            }
        }

        if (!$error) {
            // Truy vấn UPDATE để cập nhật thông tin sách
            $sql_update = "UPDATE sach SET 
                            S_Ten = '$s_ten', 
                            S_HinhAnh = '$s_hinhanh_path', 
                            S_NamXuatBan = '$s_namxuatban', 
                            S_NgonNgu = '$s_ngonngu', 
                            S_TenNguoiDich = '$s_tennguoidich', 
                            S_TrongLuong = '$s_trongluong', 
                            S_KichThuoc = '$s_kichthuoc', 
                            S_SoTrang = '$s_sotrang', 
                            S_HinhThuc = '$s_hinhthuc', 
                            S_MoTa = '$s_mota', 
                            TG_Ma = '$tg_ma', 
                            NXB_Ma = '$nxb_ma', 
                            NCC_Ma = '$ncc_ma', 
                            CD_Ma = '$cd_ma',
                            S_ThoiGianCapNhat = NOW()

                          WHERE S_Ma = '$s_ma'";

            // Thực hiện truy vấn
            if (mysqli_query($connection, $sql_update)) {
                $success = "Cập nhật sách thành công!";
            } else {
                $error = "Lỗi: " . mysqli_error($connection); // Hiển thị lỗi nếu có
            }

            // Thêm giá niêm yết mới
            $sql_gianiemyet = "INSERT INTO gianiemyet (S_Ma, GNY_NgayHieuLuc, GNY_DonGia) 
                               VALUES ('$s_ma', current_timestamp(), $s_dongia)";
            $result_gia = mysqli_query($connection, $sql_gianiemyet);

            if (!$result_gia) {
                die('Error: ' . mysqli_error($connection));
            }
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
