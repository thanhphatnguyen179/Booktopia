<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Fetching data from phieunhaphang table
$query = "SELECT * FROM phieunhaphang ORDER BY PNH_NgayNhap DESC"; 
$phieunhaphang_QUERY = mysqli_query($connection, $query);

// Check if the query was successful
if (!$phieunhaphang_QUERY) {
    die("Database query failed: " . mysqli_error($connection));
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Phiếu nhập hàng</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Phiếu nhập hàng</a></li>
                                <li class="breadcrumb-item active">Danh sách</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <a href="phieunhaphang_add.php" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> Thêm Phiếu nhập hàng mới</a>
                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mã Phiếu nhập hàng</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Ngày Nhập</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tên Kho</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Nhân viên lập</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tổng Tiền</th>
                                                    <th style="width: 120px;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($phieunhaphang_QUERY)) {
                                                    $PNH_Ma = htmlspecialchars($row["PNH_Ma"]);
                                                    $PNH_NgayNhap = htmlspecialchars($row["PNH_NgayNhap"]);
                                                    $K_Ma = htmlspecialchars($row["K_Ma"]);
                                                    $NV_Ma = htmlspecialchars($row["NV_Ma"]);


                                                    // Truy vấn lấy tên kho từ bảng kho theo K_Ma
                                                    $kho_query = "SELECT K_Ten FROM kho WHERE K_Ma = '$K_Ma'";
                                                    $kho_result = mysqli_query($connection, $kho_query);
                                                    if ($kho_result && mysqli_num_rows($kho_result) > 0) {
                                                        $kho_row = mysqli_fetch_assoc($kho_result);
                                                        $K_Ten = $kho_row['K_Ten'];
                                                    } else {
                                                        $K_Ten = 'Không có tên kho'; // Giá trị mặc định nếu không tìm thấy
                                                    }

                                                    // Truy vấn lấy tên người dùng từ bảng nguoidung theo NV_Ma
                                                    $nguoidung_query = "SELECT ND_HoTen FROM nguoidung WHERE ND_Ma = '$NV_Ma'";
                                                    $nguoidung_result = mysqli_query($connection, $nguoidung_query);
                                                    if ($nguoidung_result && mysqli_num_rows($nguoidung_result) > 0) {
                                                        $nguoidung_row = mysqli_fetch_assoc($nguoidung_result);
                                                        $ND_HoTen = $nguoidung_row['ND_HoTen'];
                                                    } else {
                                                        $ND_HoTen = 'Không có tên người dùng'; // Giá trị mặc định nếu không tìm thấy
                                                    }

                                                    $PNH_TongTien = htmlspecialchars($row["PNH_TongTien"]);
                                                    
                                                    echo $i % 2 != 0 ? "<tr role='row' class='odd'>" : "<tr role='row' class='even'>";
                                                ?>
                                                    <td><?php echo $PNH_Ma; ?></td>
                                                    <td><?php echo $PNH_NgayNhap; ?></td>
                                                    <td><?php echo $K_Ten; ?></td>
                                                    <td><?php echo $ND_HoTen; ?></td>

                                                    <td><?php echo number_format($PNH_TongTien); ?> VND</td>
                                                    <td style="text-align: center;">
                                                        <a href="phieunhaphang_edit.php?PNH_Ma=<?php echo $PNH_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a onclick="confirmDelete('<?php echo $PNH_Ma; ?>');" class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
                                                    </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function confirmDelete(PNH_Ma) {
    swal({
        title: "Bạn chắc chứ?",
        text: "Một khi đã xóa, thì không thể phục hồi lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = 'http://localhost/booktopia/admin/functions/phieunhaphang/phieunhaphang_delete.php?PNH_Ma=' + PNH_Ma;
        } else {
            swal("Mẫu tin của bạn an toàn!");
        }
    });
}
</script>

<?php
include('includes/footer.php');
?>
