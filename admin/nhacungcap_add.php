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
                        <h4 class="mb-0">Thêm nhà cung cấp mới</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="nhacungcap_all.php">nhà cung cấp</a></li>
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
                    SUBSTRING(NCC_Ma, 1, 3) AS prefix,
                    MAX(CAST(SUBSTRING(NCC_Ma, 4) AS UNSIGNED)) AS max_number  
                FROM 
                    nhacungcap
                WHERE 
                    NCC_Ma LIKE 'NCC%'
                GROUP BY 
                    prefix;

            ";

            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $prefix = $row['prefix'];
            $max_number = $row['max_number'];
            $new_number = $max_number + 1;
            $new_ncc_Ma = $prefix . str_pad($new_number, 5, '0', STR_PAD_LEFT);
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="nhacungcapForm" action="functions/nhacungcap/nhacungcap_add.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="ncc_ma">Mã nhà cung cấp</label>
                                    <input id="ncc_ma" name="ncc_ma" type="text" class="form-control" value="<?php echo $new_ncc_Ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ncc_ten">Tên nhà cung cấp</label>
                                    <input id="ncc_ten" name="ncc_ten" type="text" class="form-control" autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="nhacungcap_add">Tạo nhà cung cấp</button>
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
    const ncc_Ten = document.getElementById("ncc_ten").value.trim();
    
    if (ncc_Ten === "") {
        swal({
            title: "Lỗi",
            text: "Tên nhà cung cấp không được để trống.",
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
