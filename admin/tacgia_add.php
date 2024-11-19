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
                        <h4 class="mb-0">Thêm tác giả mới</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="tacgia_all.php">Tác giả</a></li>
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
                    SUBSTRING(TG_Ma, 1, 2) AS prefix,
                    MAX(CAST(SUBSTRING(TG_Ma, 4) AS UNSIGNED)) AS max_number  
                FROM 
                    tacgia
                WHERE 
                    TG_Ma LIKE 'TG%'
                GROUP BY 
                    prefix;

            ";

            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $prefix = $row['prefix'];
            $max_number = $row['max_number'];
            $new_number = $max_number + 1;
            $new_TG_Ma = $prefix . str_pad($new_number, 6, '0', STR_PAD_LEFT);
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="tacgiaForm" action="functions/tacgia/tacgia_add.php" method="post" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="TG_Ma">Mã tác giả</label>
                                    <input id="TG_Ma" name="TG_Ma" type="text" class="form-control" value="<?php echo $new_TG_Ma; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="TG_Ten">Tên tác giả</label>
                                    <input id="TG_Ten" name="TG_Ten" type="text" class="form-control" autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="tacgia_add">Thêm tác giả</button>
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
    const TG_Ten = document.getElementById("TG_Ten").value.trim();
    
    if (TG_Ten === "") {
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
