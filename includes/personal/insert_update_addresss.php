<?php 
include('../db.php');
session_start();

if (isset($_POST["TTP_Ma"], $_POST["QH_Ma"], $_POST["XPTT_Ma"], $_POST["DC_SoNha"])) {
    $TTP_Ma = $_POST["TTP_Ma"];
    $QH_Ma = $_POST["QH_Ma"];
    $XPTT_Ma = $_POST["XPTT_Ma"];
    $DC_SoNha = $_POST["DC_SoNha"];
    $ND_Ma = $_SESSION['ND_Ma'];
    
    // Kiểm tra xem người dùng đã có địa chỉ mặc định hay chưa
    $sql_check = "SELECT DC_Ma FROM diachi WHERE ND_Ma = '$ND_Ma' AND DC_MacDinh = 1";
    $result_check = mysqli_query($connection, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Nếu đã có địa chỉ mặc định, thực hiện cập nhật
        $sql_update = "
            UPDATE diachi 
            SET TTP_Ma = '$TTP_Ma', QH_Ma = '$QH_Ma', XPTT_Ma = '$XPTT_Ma', DC_SoNha = '$DC_SoNha' 
            WHERE ND_Ma = '$ND_Ma' AND DC_MacDinh = 1
        ";
        if (mysqli_query($connection, $sql_update)) {
            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "Đã cập nhật địa chỉ thành công!"
            ];
        } else {
            $_SESSION['alert'] = [
                "type" => "error",
                "message" => "Lỗi khi cập nhật địa chỉ: " . mysqli_error($connection)
            ];
        }
    } else {
        // Nếu chưa có địa chỉ mặc định, thực hiện thêm mới
        $sql_max_id = "SELECT MAX(DC_Ma) AS max_id FROM diachi";
        $result_max_id = mysqli_query($connection, $sql_max_id);
        $row_max_id = mysqli_fetch_assoc($result_max_id);

        if ($row_max_id['max_id']) {
            $new_id_num = (int)substr($row_max_id['max_id'], 2) + 1;
            $DC_Ma = 'DC' . str_pad($new_id_num, 8, '0', STR_PAD_LEFT);
        } else {
            $DC_Ma = 'DC00000001';
        }

        $sql_insert = "
            INSERT INTO diachi (DC_Ma, TTP_Ma, QH_Ma, XPTT_Ma, DC_SoNha, ND_Ma, DC_MacDinh) 
            VALUES ('$DC_Ma', '$TTP_Ma', '$QH_Ma', '$XPTT_Ma', '$DC_SoNha', '$ND_Ma', 1)
        ";
        if (mysqli_query($connection, $sql_insert)) {
            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "Đã thêm mới địa chỉ thành công!"
            ];
        } else {
            $_SESSION['alert'] = [
                "type" => "error",
                "message" => "Lỗi khi thêm địa chỉ: " . mysqli_error($connection)
            ];
        }
    }
} else {
    $_SESSION['alert'] = [
        "type" => "error",
        "message" => "Dữ liệu không hợp lệ. Vui lòng nhập đầy đủ thông tin."
    ];
}

mysqli_close($connection);
header("Location: ../../dashboard.php");
exit();
?>
