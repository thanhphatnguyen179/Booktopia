<?php include("db.php"); ?>
<?php session_start(); ?>

<?php 
    if(isset($_POST["login"])){
        // Lấy thông tin đăng nhập từ form
        $phone = $_POST["phone"];
        $password = $_POST["password"];

        // Bảo mật các đầu vào người dùng
        $phone = mysqli_real_escape_string($connection, $phone);
        $password = mysqli_real_escape_string($connection, $password);

        // Câu lệnh SQL truy vấn người dùng dựa trên số điện thoại
        $query = "SELECT * FROM `nguoidung` WHERE ND_SoDT = '$phone'";

        $select_user_query = mysqli_query($connection, $query);

        if (!$select_user_query) {
            die("Fail" . mysqli_error($connection));   
        }

        // Kiểm tra kết quả truy vấn
        if($row = mysqli_fetch_assoc($select_user_query)){
            $db_user_id = $row["ND_Ma"];
            $db_user_password = $row["ND_MatKhau"];
            $db_user_name = $row["ND_Ten"];
            $db_user_phone = $row["ND_SoDT"];
            $db_user_email = $row["ND_Email"];
            $db_user_image = $row["ND_HinhAnh"];

            // Kiểm tra mật khẩu
            // if(password_verify($password, $db_user_password)) {
            if($password == $db_user_password) {

                // Thiết lập các biến session sau khi đăng nhập thành công
                $_SESSION["user_id"] = $db_user_id;
                $_SESSION["user_name"] = $db_user_name;
                $_SESSION["user_phone"] = $db_user_phone;
                $_SESSION["user_email"] = $db_user_email;
                $_SESSION["user_image"] = $db_user_image;
                // Kiểm tra 2 ký tự đầu tiên của ND_Ma để điều hướng
                if (substr($db_user_id, 0, 2) === 'KH') {
                    header("Location: ../index.php");
                } elseif (substr($db_user_id, 0, 2) === 'NV') {
                    header("Location: ../admin/index.php");
                } elseif (substr($db_user_id, 0, 2) === 'TC') {
                    header("Location: ../index.php");
                } else {
                    // Nếu không thuộc loại nào, điều hướng về trang chủ mặc định
                    header("Location: ../index.php");
                }
            } else {
                // Nếu mật khẩu sai, điều hướng về trang đăng nhập
                header("Location: ../login.php");
            }
        } else {
            // Nếu không tìm thấy người dùng, điều hướng về trang đăng nhập
            header("Location: ../index.php");
        }
    }
?>
