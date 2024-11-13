<?php 
include('../../../includes/db.php');

// Kiểm tra xem có nhận được giá trị k_ma từ AJAX không
if (isset($_POST['k_ma'])) {
    // Nhận giá trị k_ma từ AJAX
    $k_ma = $_POST['k_ma'];

    // Sử dụng prepared statement để tránh SQL injection
    $query = "SELECT SoLuong FROM tonkho WHERE K_Ma = ?";
    $stmt = $connection->prepare($query);
    
    // Ràng buộc tham số vào câu lệnh
    $stmt->bind_param("s", $k_ma);
    
    // Thực thi câu lệnh
    $stmt->execute();
    
    // Lấy kết quả
    $result = $stmt->get_result();

    // Kiểm tra và trả về số lượng nếu có kết quả
    if ($row = $result->fetch_assoc()) {
        echo $row['SoLuong'];
    } else {
        echo "0"; // Trả về 0 nếu không có kết quả
    }

    // Đóng prepared statement
    $stmt->close();
}
?>
