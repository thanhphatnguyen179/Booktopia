<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Lấy mã chủ đề từ URL
if (isset($_GET['cd_ma'])) {
    $cd_ma = $_GET['cd_ma'];

    // Truy vấn để lấy thông tin chủ đề hiện tại
    $sql = "SELECT * FROM chude WHERE CD_Ma = '$cd_ma'";
    $result = mysqli_query($connection, $sql);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cd_ten = $row['CD_Ten'];
    } else {
        echo "Không tìm thấy chủ đề.";
        exit();
    }
} else {
    echo "ID chủ đề không hợp lệ.";
    exit();
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chỉnh sửa chủ đề</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="chude_all.php">Chủ đề</a></li>
                                <li class="breadcrumb-item active">Chỉnh sửa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="functions/chude/chude_update.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="cd_ma">Mã chủ đề</label>
                                    <input id="cd_ma" name="cd_ma" type="text" class="form-control" value="<?php echo $cd_ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="cd_ten">Tên chủ đề</label>
                                    <input id="cd_ten" name="cd_ten" type="text" class="form-control" value="<?php echo $cd_ten; ?>" autofocus>
                                </div>
                                
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="chude_edit">Cập nhật chủ đề</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Nazox.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function validateForm() {
    const cdTen = document.getElementById("cd_ten").value.trim();
    
    if (cdTen === "") {
        swal({
            title: "Lỗi",
            text: "Tên chủ đề không được để trống.",
            icon: "error",
            button: "OK",
        });
        return false; // Ngăn form submit
    }
    return true; // Cho phép form submit nếu hợp lệ
}
</script>

<?php
include('includes/footer.php');
?>
