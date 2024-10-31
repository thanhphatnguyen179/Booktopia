<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Thêm nhà xuất bản mới</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="nhaxuatban_all.php">nhà xuất bản</a></li>
                                <li class="breadcrumb-item active">Thêm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php 
            global $connection;
            // Truy vấn để lấy prefix và số lớn nhất
            $sql = "
                SELECT 
                    SUBSTRING(NXB_Ma, 1, 3) AS prefix,
                    MAX(CAST(SUBSTRING(NXB_Ma, 4) AS UNSIGNED)) AS max_number  
                FROM 
                    nhaxuatban
                WHERE 
                    NXB_Ma LIKE 'NXB%'
                GROUP BY 
                    prefix;

            ";

            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $prefix = $row['prefix'];
            $max_number = $row['max_number'];
            $new_number = $max_number + 1;
            $new_NXB_Ma = $prefix . str_pad($new_number, 5, '0', STR_PAD_LEFT);
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="nhaxuatbanForm" action="functions/nhaxuatban/nhaxuatban_add.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="NXB_Ma">Mã nhà xuất bản</label>
                                    <input id="NXB_Ma" name="NXB_Ma" type="text" class="form-control" value="<?php echo $new_NXB_Ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="NXB_Ten">Tên nhà xuất bản</label>
                                    <input id="NXB_Ten" name="NXB_Ten" type="text" class="form-control" autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="nhaxuatban_add">Tạo nhà xuất bản</button>
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
    const NXB_Ten = document.getElementById("NXB_Ten").value.trim();
    
    if (NXB_Ten === "") {
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
