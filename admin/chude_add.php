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
                        <h4 class="mb-0">Thêm chủ đề mới</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="chude_all.php">Chủ đề</a></li>
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
                    SUBSTRING(CD_Ma, 1, 2) AS prefix, 
                    MAX(CAST(SUBSTRING(CD_Ma, 3) AS UNSIGNED)) AS max_number
                FROM 
                    chude
                WHERE 
                    CD_Ma LIKE 'CD%'
                GROUP BY 
                    SUBSTRING(CD_Ma, 1, 2);
            ";

            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $prefix = $row['prefix'];
            $max_number = $row['max_number'];
            $new_number = $max_number + 1;
            $new_CD_Ma = $prefix . str_pad($new_number, 6, '0', STR_PAD_LEFT);
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="chudeForm" action="functions/chude/chude_add.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="cd_ma">Mã chủ đề</label>
                                    <input id="cd_ma" name="cd_ma" type="text" class="form-control" value="<?php echo $new_CD_Ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="cd_ten">Tên chủ đề</label>
                                    <input id="cd_ten" name="cd_ten" type="text" class="form-control" autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="chude_add">Tạo chủ đề</button>
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
