<?php 
include('../db.php'); 
header('Content-Type: application/json');

$response = ["status" => "", "message" => ""];

if (isset($_POST['S_Ma']) && isset($_POST['S_SoLuong']) && isset($_POST['ND_Ma'])) {
    $S_Ma = $_POST['S_Ma'];
    $S_SoLuong = (int) $_POST['S_SoLuong'];
    $ND_Ma = $_POST['ND_Ma'];

    $sql_check = "SELECT * FROM giohang WHERE S_Ma = '$S_Ma' AND KH_Ma = '$ND_Ma'";
    $result_check = mysqli_query($connection, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        $row = mysqli_fetch_assoc($result_check);
        $new_quantity = $row['GH_SoLuong'] + $S_SoLuong;

        $sql_update = "UPDATE giohang SET GH_SoLuong = $new_quantity WHERE S_Ma = '$S_Ma' AND KH_Ma = '$ND_Ma'";
        if (mysqli_query($connection, $sql_update)) {
            $response["status"] = "success";
            $response["message"] = "Đã cập nhật giỏ hàng thành công!";
        } else {
            $response["status"] = "error";
            $response["message"] = "Lỗi khi cập nhật giỏ hàng!";
        }
    } else {
        $sql_insert = "INSERT INTO giohang (S_Ma, GH_SoLuong, KH_Ma) VALUES ('$S_Ma', $S_SoLuong, '$ND_Ma')";
        if (mysqli_query($connection, $sql_insert)) {
            $response["status"] = "success";
            $response["message"] = "Đã thêm vào giỏ hàng thành công!";
        } else {
            $response["status"] = "error";
            $response["message"] = "Lỗi khi thêm vào giỏ hàng!";
        }
    }

    mysqli_close($connection);
} else {
    $response["status"] = "error";
    $response["message"] = "Vui lòng cung cấp đầy đủ dữ liệu!";
}

echo json_encode($response);
?>
