<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Fetching data from hoadon table, with JOIN to get customer and employee details
$query = "
    SELECT
        hd.HD_Ma,
        hd.HD_NgayLap,
        hd.HD_TongTien,
        hd.NV_Ma,
        nd.ND_HoTen,
        tt.TT_Ten,
        httt.HTTT_Ten
FROM
    hoadon hd
    JOIN nguoidung nd ON nd.ND_Ma = hd.KH_Ma
    JOIN trangthai tt ON tt.TT_Ma = hd.TT_Ma
    JOIN hinhthucthanhtoan httt ON httt.HTTT_Ma = hd.HTTT_Ma
"; 
$hoadon_QUERY = mysqli_query($connection, $query);

// Check if the query was successful
if (!$hoadon_QUERY) {
    die("Database query failed: " . mysqli_error($connection));
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Hóa đơn</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Hóa đơn</a></li>
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
                                <a href="hoadon_add.php" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> Thêm Hóa đơn mới</a>
                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mã Hóa đơn</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Ngày Lập</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tên Khách hàng</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Nhân viên lập</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Trạng thái</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Hình thức thanh toán</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tổng Tiền</th>
                                                    <th style="width: 120px;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($hoadon_QUERY)) {
                                                    $HD_Ma = htmlspecialchars($row["HD_Ma"]);
                                                    $HD_NgayLap = htmlspecialchars($row["HD_NgayLap"]);
                                                    $KH_Ten = htmlspecialchars($row["ND_HoTen"]);
                                                    $NV_Ma = htmlspecialchars($row["NV_Ma"]);


                                                    $nhanvien_query = "SELECT ND_HoTen FROM nguoidung WHERE ND_Ma = '$NV_Ma'";
                                                    $nhanvien_result = mysqli_query($connection, $nhanvien_query);
                                                    if ($nhanvien_result && mysqli_num_rows($nhanvien_result) > 0) {
                                                        $kho_row = mysqli_fetch_assoc($nhanvien_result);
                                                        $NV_Ten = $kho_row['ND_HoTen'];
                                                    } else {
                                                        $NV_Ten = ''; // Giá trị mặc định nếu không tìm thấy
                                                    }

                                                    $TT_Ten = htmlspecialchars($row["TT_Ten"]);
                                                    $HTTT_Ten = htmlspecialchars($row["HTTT_Ten"]);
                                                    $HD_TongTien = htmlspecialchars($row["HD_TongTien"]);
                                                    
                                                    echo $i % 2 != 0 ? "<tr role='row' class='odd'>" : "<tr role='row' class='even'>";
                                                ?>
                                                    <td><?php echo $HD_Ma; ?></td>
                                                    <td><?php echo $HD_NgayLap; ?></td>
                                                    <td><?php echo $KH_Ten; ?></td>
                                                    <td><?php echo $NV_Ten; ?></td>
                                                    <td><?php echo $TT_Ten; ?></td>
                                                    <td><?php echo $HTTT_Ten; ?></td>
                                                    <td><?php echo number_format($HD_TongTien); ?> VND</td>
                                                    <td style="text-align: center;">
                                                        <a href="hoadon_edit.php?HD_Ma=<?php echo $HD_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a onclick="confirmDelete('<?php echo $HD_Ma; ?>');" class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
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
    
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function confirmDelete(HD_Ma) {
    swal({
        title: "Bạn chắc chứ?",
        text: "Một khi đã xóa, thì không thể phục hồi lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = 'http://localhost/booktopia/admin/functions/hoadon/hoadon_delete.php?HD_Ma=' + HD_Ma;
        } else {
            swal("Mẫu tin của bạn an toàn!");
        }
    });
}
</script>

<?php
include('includes/footer.php');
?>
