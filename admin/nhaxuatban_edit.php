<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Lấy mã nhà xuất bản từ URL
if (isset($_GET['NXB_Ma'])) {
    $NXB_Ma = $_GET['NXB_Ma'];

    // Truy vấn để lấy thông tin nhà xuất bản hiện tại
    $sql = "SELECT * FROM nhaxuatban WHERE NXB_Ma = '$NXB_Ma'";
    $result = mysqli_query($connection, $sql);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $NXB_Ten = $row['NXB_Ten'];
    } else {
        echo "Không tìm thấy nhà xuất bản.";
        exit();
    }
} else {
    echo "ID nhà xuất bản không hợp lệ.";
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
                        <h4 class="mb-0">Chỉnh sửa nhà xuất bản</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="nhaxuatban_all.php">nhà xuất bản</a></li>
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
                            <form action="functions/nhaxuatban/nhaxuatban_update.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="NXB_Ma">Mã nhà xuất bản</label>
                                    <input id="NXB_Ma" name="NXB_Ma" type="text" class="form-control" value="<?php echo $NXB_Ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="NXB_Ten">Tên nhà xuất bản</label>
                                    <input id="NXB_Ten" name="NXB_Ten" type="text" class="form-control" value="<?php echo $NXB_Ten; ?>" autofocus>
                                </div>
                                
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="nhaxuatban_edit">Cập nhật nhà xuất bản</button>
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
    const cdTen = document.getElementById("NXB_Ten").value.trim();
    
    if (cdTen === "") {
        swal({
            title: "Lỗi",
            text: "Tên nhà xuất bản không được để trống.",
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
