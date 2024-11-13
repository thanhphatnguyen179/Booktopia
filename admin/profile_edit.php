<!-- edit_profile_view.php -->
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('../includes/db.php'); ?>

<?php
// Fetch the user's current profile data
$sql_profile = "SELECT * FROM nguoidung WHERE ND_Ma = '" . $_SESSION['ND_Ma'] . "'";
$result_profile = mysqli_query($connection, $sql_profile);
$row_profile = mysqli_fetch_assoc($result_profile);
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chỉnh sửa thông tin</h4>
                    </div>
                </div>
            </div>

            <!-- Profile Edit Form -->
            <form action="./functions/canhan/profile_edit.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="mb-3">Ảnh đại diện</h3>
                        <img class="rounded shadow" width="300px" id="imagePreview" src="../<?php echo $row_profile['ND_HinhAnh']; ?>" alt="Ảnh đại diện">
                        <br><br>
                        <div class="form-group mt-2">
                            <label for="ND_HinhAnh">Thay đổi ảnh đại diện</label>
                            <input type="file" name="ND_HinhAnh" class="form-control" id="ND_HinhAnh" accept="image/*" onchange="previewImage(event)">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h3 class="mb-3">Thông tin cá nhân</h3>
                        <div class="form-group">
                            <label for="ND_TenDangNhap">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="ND_TenDangNhap" id="ND_TenDangNhap" value="<?php echo $row_profile['ND_TenDangNhap']; ?>" required  onblur="checkUsernameAvailability()">
                            <span id="usernameError" style="color:red;"></span>
                        </div>
                                            <div class="form-group">
                            <label for="ND_HoTen">Họ tên</label>
                            <input type="text" class="form-control" name="ND_HoTen" value="<?php echo $row_profile['ND_HoTen']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ND_SoDT">Số điện thoại</label>
                            <input type="text" class="form-control" name="ND_SoDT" value="<?php echo $row_profile['ND_SoDT']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ND_Email">Email</label>
                            <input type="email" class="form-control" name="ND_Email" value="<?php echo $row_profile['ND_Email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ND_NgaySinh">Ngày Sinh</label>
                            <input type="date" class="form-control" name="ND_NgaySinh" value="<?php echo $row_profile['ND_NgaySinh']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ND_GioiTinh">Giới tính</label>
                            <select name="ND_GioiTinh" class="form-control">
                                <option value="Nam" <?php echo ($row_profile['ND_GioiTinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                <option value="Nữ" <?php echo ($row_profile['ND_GioiTinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                                <option value="Khác" <?php echo ($row_profile['ND_GioiTinh'] == 'Khác') ? 'selected' : ''; ?>>Khác</option>
                            </select>
                        </div>


<?php 
    $sql_info = "SELECT * FROM nhanvien nv 
                 LEFT JOIN chucvu cv ON nv.CV_Ma = cv.CV_Ma 
                 WHERE NV_Ma = '" . $row_profile["ND_Ma"] . "'";
    $result_info = mysqli_query($connection, $sql_info);
    $row_info = mysqli_fetch_assoc($result_info);
?>
                        <div class="form-group">
                            <label for="NV_CCCD">Số CCCD</label>
                            <input type="text" class="form-control" name="ND_SoDT" value="<?php echo $row_profile['ND_SoDT']; ?>" required>
                            
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Cập nhật thông tin</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    // Function to preview the image before uploading
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;  // Set the source of the image preview
                imagePreview.style.display = 'block';  // Make sure the preview is displayed
            };
            reader.readAsDataURL(file);  // Read the image file as a Data URL
        }
    }
</script>
<script>
    function checkUsernameAvailability() {
    var username = document.getElementById("ND_TenDangNhap").value;

    // Nếu không có tên đăng nhập, không làm gì
    if (username == "") {
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            
            // Kiểm tra phản hồi từ PHP
            if (response.status == "taken") {
                document.getElementById("usernameError").innerHTML = "Tên đăng nhập đã được sử dụng!";
                document.getElementById("ND_TenDangNhap").style.borderColor = "red";
            } else if (response.status == "available") {
                document.getElementById("usernameError").innerHTML = "";
                document.getElementById("ND_TenDangNhap").style.borderColor = "green";
            } else if (response.status == "invalid_format") {
                document.getElementById("usernameError").innerHTML = "Tên đăng nhập không hợp lệ! (Tối thiểu 4 ký tự, chỉ chứa chữ cái và số)";
                document.getElementById("ND_TenDangNhap").style.borderColor = "orange";
            }
        }
    };
    
    // Gửi yêu cầu AJAX tới PHP để kiểm tra tên đăng nhập
    xmlhttp.open("POST", "./functions/functions/check_username.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username=" + encodeURIComponent(username));
}

</script>
