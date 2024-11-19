<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Lấy mã tác giả từ URL
if (isset($_GET['TG_Ma'])) {
    $TG_Ma = $_GET['TG_Ma'];

    // Truy vấn để lấy thông tin tác giả hiện tại
    $sql = "SELECT * FROM tacgia WHERE TG_Ma = '$TG_Ma'";
    $result = mysqli_query($connection, $sql);

    // Kiểm tra xem có dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $TG_Ten = $row['TG_Ten'];
    } else {
        echo "Không tìm thấy tác giả.";
        exit();
    }
} else {
    echo "ID tác giả không hợp lệ.";
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
                        <h4 class="mb-0">Chỉnh sửa tác giả</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="tacgia_all.php">tác giả</a></li>
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
                            <form action="functions/tacgia/tacgia_update.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="TG_Ma">Mã tác giả</label>
                                    <input id="TG_Ma" name="TG_Ma" type="text" class="form-control" value="<?php echo $TG_Ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="TG_Ten">Tên tác giả</label>
                                    <input id="TG_Ten" name="TG_Ten" type="text" class="form-control" value="<?php echo $TG_Ten; ?>" autofocus>
                                </div>
                                
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="tacgia_edit">Cập nhật tác giả</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    
</div>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function validateForm() {
    const cdTen = document.getElementById("TG_Ten").value.trim();
    
    if (cdTen === "") {
        swal({
            title: "Lỗi",
            text: "Tên tác giả không được để trống.",
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
