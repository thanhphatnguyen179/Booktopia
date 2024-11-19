<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Ensure the session is started
session_start();

// SQL query to select user profile data
$sql_profile = "SELECT * FROM nguoidung WHERE ND_Ma = '" . $_SESSION['ND_Ma'] . "'";
    
// Correct connection variable spelling
$result_profile = mysqli_query($connection, $sql_profile);

// Fetch the result as an associative array
$row_profile = mysqli_fetch_assoc($result_profile);


?>





<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Quản lý thông tin</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thông tin cá nhân</a></li>
                            <li class="breadcrumb-item active"><?php echo $row_profile['ND_HoTen']?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
    <div class="col-md-4">
        <h3 class="mb-3">Ảnh đại diện</h3>
        <img class="rounded shadow" width="300px" src="../<?php echo $row_profile['ND_HinhAnh']; ?>" alt="Ảnh đại diện">
    </div>
    <div class="col-md-8">
        <h3 class="mb-3">Thông tin cá nhân</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th scope="row" style="width: 200px;">Mã nhân viên</th>
                        <td><?php echo $row_profile['ND_Ma']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tên đăng nhập</th>
                        <td><?php echo $row_profile['ND_TenDangNhap']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Họ tên</th>
                        <td><?php echo $row_profile['ND_HoTen']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Số điện thoại</th>
                        <td><?php echo $row_profile['ND_SoDT']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $row_profile['ND_Email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Ngày Sinh</th>
                        <td><?php echo $row_profile['ND_NgaySinh']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Giới tính</th>
                        <td><?php echo $row_profile['ND_GioiTinh']; ?></td>
                    </tr>
<?php 
    $sql_info = "SELECT * FROM nhanvien nv 
                 LEFT JOIN chucvu cv ON nv.CV_Ma = cv.CV_Ma 
                 WHERE NV_Ma = '" . $row_profile["ND_Ma"] . "'";
    $result_info = mysqli_query($connection, $sql_info);
    $row_info = mysqli_fetch_assoc($result_info);
?>
                    <tr>
                        <th scope="row">Số CCCD</th>
                        <td><?php echo $row_info['NV_CCCD']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Chức vụ</th>
                        <td><?php echo $row_info['CV_Ten']; ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
         <!-- Button Section -->
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="profile_edit.php" class="btn btn-primary btn-lg btn-block waves-effect waves-light mb-2">Chỉnh sửa thông tin</a>
            </div>
            <div class="col-md-6">
                <a href="profile_password.php" class="btn btn-secondary btn-lg btn-block waves-effect waves-light mb-2">Đổi mật khẩu</a>
            </div>
        </div>
    </div>
    
</div>

        
       
        

        </div>
    </div>
    
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

// Confirm delete function
function confirmDelete(S_Ma) {
    swal({
        title: "Bạn chắc chứ?",
        text: "Một khi đã xóa, thì không thể phục hồi lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = 'http://localhost/booktopia/admin/functions/sach/sach_delete.php?S_Ma=' + S_Ma;
        } else {
            swal("Mẫu tin của bạn an toàn!");
        }
    });
}

// Initialize DataTable once when the document is ready
$(document).ready(function() {
    $('#datatable').DataTable({
        scrollX: true, // Enable horizontal scroll if needed
        columnDefs: [
            { width: "200px", targets: 2 } // Set width of column "Tên sách"
        ]
    });
});
</script>


<?php
include('includes/footer.php');
?>
