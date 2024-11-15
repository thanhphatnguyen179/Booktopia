<?php 
// Kết nối cơ sở dữ liệu
include('../db.php'); 
// Bắt đầu session để có thể sử dụng session
session_start();

$success = true;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Import SweetAlert2 for alerts
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    // Receive data from form
    $KH_Ma = $_POST['KH_Ma'] ?? '';
    $KH_Email = $_POST['KH_Email'] ?? '';
    $KH_SoDienThoai = $_POST['KH_SoDienThoai'] ?? '';
    $isDC_MacDinh = $_POST['isDC_MacDinh'] ?? '';
    $DC_Ma = $_POST['DC_Ma'] ?? '';

    $TTP_Ma = $_POST['TTP_Ma'] ?? '';
    $QH_Ma = $_POST['QH_Ma'] ?? '';
    $XPTT_Ma = $_POST['XPTT_Ma'] ?? '';
    $DC_SoNha = $_POST['DC_SoNha'] ?? '';
    $DC_SoTienVanChuyen = $_POST['DC_SoTienVanChuyen'] ?? '';
    $checkout_KM_Ma = $_POST['checkout_KM_Ma'] ?? '';

    $KM_TongSoTien = $_POST['KM_TongSoTien'] ?? '';
    $HTTT_Ma = $_POST['submit_HTTT_Ma'] ?? '';

    $LIST_BOOK = $_POST['LIST_BOOK'] ?? [];
    $List_Book_Quanlity = $_POST['List_Book_Quanlity'] ?? [];
    $List_Book_Price = $_POST['List_Book_Price'] ?? [];

    if ($isDC_MacDinh != 1) {
        $result_diachi_new = mysqli_query($connection, "SELECT DC_Ma FROM diachi ORDER BY DC_Ma DESC LIMIT 1");
        if ($result_diachi_new&& mysqli_num_rows($result_diachi_new) > 0) {
            $row = mysqli_fetch_assoc($result_diachi_new);
            $currentDC_Ma = $row['DC_Ma'];
            $newDC_Ma = 'DC' . str_pad((int)substr($currentDC_Ma, 2) + 1, 8, '0', STR_PAD_LEFT);
            
        } else {
            $newDC_Ma = 'DC00000001'; // Nếu không có dữ liệu, bắt đầu từ DC00000001
        }
        $DC_Ma = $newDC_Ma;
        // Tạo câu truy vấn INSERT
        $insertQuery_diachi_new = "INSERT INTO diachi (DC_Ma, TTP_Ma, QH_Ma, XPTT_Ma, DC_SoNha, ND_Ma, DC_MacDinh)
                        VALUES ('$newDC_Ma', '$TTP_Ma', '$QH_Ma', '$XPTT_Ma', '$DC_SoNha', '$KH_Ma', 0)";

        mysqli_query($connection, $insertQuery_diachi_new);

    }
   
    
    $totalPrice = 0;

    foreach ($List_Book_Quanlity as $index => $num_book) {
        $price_book = $List_Book_Price[$index]; // Lấy giá tương ứng từ $List_Book_Price
        $totalPrice += $num_book * $price_book; // Tính tổng từng sách và cộng dồn vào $totalPrice
    }
    $totalPrice += $DC_SoTienVanChuyen - $KM_TongSoTien;

    


    // Lấy tháng và năm hiện tại
    $currentMonth = date('m'); // Tháng hiện tại (2 chữ số)
    $currentYear = date('y'); // 2 số cuối của năm hiện tại

    // Tạo tiền tố mã
    $prefix = "HD" . $currentMonth . $currentYear;

    // Truy vấn mã hóa đơn lớn nhất hiện tại
    $query = "SELECT HD_Ma 
            FROM hoadon 
            WHERE HD_Ma LIKE '$prefix%' 
            ORDER BY HD_Ma DESC 
            LIMIT 1";
    $result = mysqli_query($connection, $query);

    // Tính toán số tăng dần
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastHD_Ma = $row['HD_Ma'];

        // Lấy 4 chữ số cuối và tăng dần
        $lastNumber = (int)substr($lastHD_Ma, -4);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1; // Nếu chưa có hóa đơn nào, bắt đầu từ 1
    }

    // Định dạng số tăng dần thành 4 chữ số
    $newHD_Ma = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

    

    $sql_hoadon = "
        INSERT INTO `hoadon`(
            `HD_Ma`,
            `HD_NgayLap`,
            `HD_TongTien`,
            `KH_Ma`,
            `NV_Ma`,
            `KM_ID`,
            `DC_Ma`,
            `TT_Ma`,
            `HTTT_Ma`
            )
            VALUES(
                '$newHD_Ma',
                NOW(),
                '$totalPrice',
                '$KH_Ma',
                '',
                '',
                '$DC_Ma',
                'TT00000001',
                '$HTTT_Ma'
            )";
    
    $result_hoadon = mysqli_query($connection, $sql_hoadon);
    // Kiểm tra xem câu lệnh SQL có thực thi thành công không
    if (!$result_hoadon) {
        
        // Nếu có lỗi, hiển thị thông báo lỗi
        $success = false;
    }

    foreach ($LIST_BOOK as $index => $id_book) { 
        $soluong = $List_Book_Quanlity[$index];
        $dongia = $List_Book_Price[$index];
        $sql_CTHD = "
        
            INSERT INTO `chitiethd`(
                `HD_Ma`,
                `S_Ma`,
                `CTHD_SoLuong`,
                `CTHD_DonGia`
            )
            VALUES(
                '$newHD_Ma',
                '$id_book',
                '$soluong',
                '$dongia'
            )";
        $result_CTHD = mysqli_query($connection, $sql_CTHD);
        if (!$result_CTHD) {
            $success = false;
        }

    }

    foreach ($LIST_BOOK as $index => $id_book) { 
        // Truy vấn số lượng sản phẩm trong giỏ hàng
        $sql_giohang = "SELECT `GH_SoLuong` FROM `giohang` WHERE KH_Ma = '$KH_Ma' AND S_Ma = '$id_book'";
        $result_giohang = mysqli_query($connection, $sql_giohang);
    
        // Kiểm tra kết quả truy vấn
        if ($result_giohang && mysqli_num_rows($result_giohang) > 0) {
            // Lấy dữ liệu từ kết quả truy vấn
            $row_giohang = mysqli_fetch_assoc($result_giohang);
            $soluong_giohang = $row_giohang['GH_SoLuong'];
    
            // Nếu số lượng giỏ hàng bằng số lượng đặt, xóa sản phẩm khỏi giỏ hàng
            if ($soluong_giohang == $List_Book_Quanlity[$index]) {
                $sql_delete = "DELETE FROM `giohang` WHERE KH_Ma = '$KH_Ma' AND S_Ma = '$id_book'";
                $result_delete = mysqli_query($connection, $sql_delete);
                if (!$result_delete) {
                    // Nếu có lỗi khi xóa, đặt success thành false
                    $success = false;
                }
            } else {
                // Nếu số lượng giỏ hàng khác với số lượng đặt, cập nhật lại số lượng
                $new_quantity = $List_Book_Quanlity[$index] - $soluong_giohang;
                $sql_update = "UPDATE `giohang` SET `GH_SoLuong`='$new_quantity' WHERE KH_Ma = '$KH_Ma' AND S_Ma = '$id_book'";
                $result_update = mysqli_query($connection, $sql_update);
    
                if (!$result_update) {
                    // Nếu có lỗi khi cập nhật, đặt success thành false
                    $success = false;
                }
            }
        } else {
            // Nếu không có kết quả trong giỏ hàng, đặt success thành false
            $success = false;
        }
    }
    



    //Lỗi nè 
    echo "<h1 style='color: white;'>ThanhCong</h1>";
    // If order is successful, display success message and redirect
    if ($success) {
        echo "<script>
                Swal.fire({
                    title: 'Đặt hàng thành công!',
                    text: 'Quý khách đã đặt hàng thành công.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '../../shop.php';
                    }
                });
              </script>";
    }


}
?>
