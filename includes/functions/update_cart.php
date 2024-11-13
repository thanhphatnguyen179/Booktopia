<?php 

// Kết nối cơ sở dữ liệu
include('../db.php'); 
// Bắt đầu session để có thể sử dụng session
session_start();

// Kiểm tra nếu có gửi dữ liệu qua POST
if (isset($_POST['quantities'])) {
    // Chuyển đổi JSON thành mảng PHP
    $quantities = json_decode($_POST['quantities'], true); 


    // Kiểm tra và cập nhật số lượng giỏ hàng
    if (isset($_SESSION['ND_Ma'])) {
        $KH_Ma = $_SESSION['ND_Ma']; // Lấy ID khách hàng từ session

        // Cập nhật số lượng cho mỗi sản phẩm trong giỏ hàng
        foreach ($quantities as $S_Ma => $quantity) {
            $quantity = intval($quantity); // Chuyển giá trị số lượng thành số nguyên

            // Làm sạch giá trị $S_Ma để bảo vệ khỏi SQL Injection
            $S_Ma = trim($S_Ma);
            
            // Câu lệnh SQL
            $sql = "UPDATE `giohang` SET `GH_SoLuong` = $quantity WHERE `S_Ma` = '$S_Ma' AND `KH_Ma` = '$KH_Ma'";

            // Thực thi câu lệnh SQL
            if (!mysqli_query($connection, $sql)) {
                // Nếu có lỗi trong câu lệnh SQL
                echo json_encode(['message' => 'Lỗi trong việc cập nhật giỏ hàng.']);
                exit;
            }
        }
    } else {
        // Nếu chưa có session ND_Ma, không thực hiện truy vấn
        echo json_encode(['message' => 'Lỗi: Không tìm thấy thông tin khách hàng.']);
        exit;
    }

    // Xóa các sản phẩm không còn trong giỏ hàng
    $KH_Ma = $_SESSION['ND_Ma']; // Đảm bảo KH_Ma đã được gán đúng từ session
    $sql_check = "SELECT `S_Ma` FROM `giohang` WHERE KH_Ma = '$KH_Ma'";
    $result_check = mysqli_query($connection, $sql_check);

    
    
        $existing_items = [];

        // Lấy tất cả mã sản phẩm trong giỏ hàng của khách hàng
        while ($row_check = mysqli_fetch_assoc($result_check)) {
            $existing_items[] = $row_check['S_Ma'];
        }

        // Làm sạch dữ liệu từ cart
        $updated_items = array_map('trim', array_keys($quantities));

        // Mảng lưu các sản phẩm cần xóa
        $items_to_delete = [];

        // Duyệt qua tất cả sản phẩm trong cơ sở dữ liệu
        foreach ($existing_items as $existing_item) {
            // Làm sạch dữ liệu trong cơ sở dữ liệu
            $existing_item = trim($existing_item);

            // Kiểm tra nếu sản phẩm không có trong danh sách cập nhật (updated_items)
            if (!in_array($existing_item, $updated_items)) {
                // Thêm sản phẩm vào mảng cần xóa
                $items_to_delete[] = $existing_item;
            }
        }
    



        if (!empty($items_to_delete)) {
            // Duyệt qua từng sản phẩm trong danh sách cần xóa và thực hiện câu lệnh DELETE
            foreach ($items_to_delete as $S_Ma_Xoa) {
                // Câu lệnh DELETE cho từng sản phẩm
                $S_Ma_Xoa = trim($S_Ma_Xoa);
                $KH_Ma = trim($KH_Ma);
                $delete_sql = "DELETE FROM `giohang` WHERE `KH_Ma` = '$KH_Ma' AND `S_Ma` = '$S_Ma_Xoa'";
        
                // Thực hiện câu lệnh SQL
                if (!mysqli_query($connection, $delete_sql)) {
                    // Nếu có lỗi trong câu lệnh SQL
                    echo json_encode(['message' => 'Lỗi trong việc xóa sản phẩm khỏi giỏ hàng.']);
                    exit;
                }
            }
        }

        
            $message = "Cập nhật giỏ hàng thành công ";

            // Return the response for AJAX
            echo json_encode(['message' => $message]);

}
?>
