<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');



   


// Fetching suppliers
$query = "SELECT * FROM sach ORDER BY S_Ma"; 
$sach_QUERY = mysqli_query($connection, $query);

// Check if the query was successful
if (!$sach_QUERY) {
    die("Database query failed: " . mysqli_error($connection));
}

?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Sach</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Sach</a></li>
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
                                <a href="sach_add.php" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> Thêm Sach mới</a>
                                <br>
                                <br>
                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12" style="overflow-x: auto;">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mã sách</th>
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" >Tên sách</th>
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Giá niêm yết</th>
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Ngày hiệu lực</th> -->
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Hình ảnh</th>
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Năm xuất bản</th>
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Ngôn ngữ</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tên người dịch</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Trọng lượng</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Kích thước</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Số trang</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Hình thức</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mô tả</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Thời gian tạo</th> -->
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tác giả</th>
<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Số lượng tồn</th>
<th style="width: 120px;" aria-controls="datatable">Hành động</th>
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Nhà xuất bản</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Nhà cung cấp</th> -->
<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Chủ đề</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($sach_QUERY)) {

    $S_TrangThai = htmlspecialchars($row["S_TrangThai"]); 
    if ($S_TrangThai == 0)
        continue;
    
    $S_Ma = htmlspecialchars($row["S_Ma"]); 
    $S_Ten = htmlspecialchars($row["S_Ten"]);
    $S_HinhAnh = htmlspecialchars($row["S_HinhAnh"]);
    $S_NamXuatBan = htmlspecialchars($row["S_NamXuatBan"]);
    // $S_NgonNgu = htmlspecialchars($row["S_NgonNgu"]);    
    // $S_TenNguoiDich = htmlspecialchars($row["S_TenNguoiDich"]);
    // $S_TrongLuong = htmlspecialchars($row["S_TrongLuong"]);
    // $S_KichThuoc = htmlspecialchars($row["S_KichThuoc"]);
    // $S_SoTrang = htmlspecialchars($row["S_SoTrang"]);
    // $S_HinhThuc = htmlspecialchars($row["S_HinhThuc"]);
    // $S_MoTa = htmlspecialchars($row["S_MoTa"]);
    // $S_ThoiGianTao = htmlspecialchars($row["S_ThoiGianTao"]);
    $TG_Ma = htmlspecialchars($row["TG_Ma"]);
    // $NXB_Ma = htmlspecialchars($row["NXB_Ma"]);
    // $NCC_Ma = htmlspecialchars($row["NCC_Ma"]);
    $CD_Ma = htmlspecialchars($row["CD_Ma"]);


    $query_gia = "SELECT * FROM gianiemyet WHERE S_Ma = '$S_Ma'";
    $result_gia = mysqli_query($connection, $query_gia);
    $gianiemyet = mysqli_fetch_array($result_gia, MYSQLI_ASSOC);    
    
    
    $query_tacgia = "SELECT TG_Ten FROM tacgia where TG_Ma = '$TG_Ma'";
    $result_tacgia = mysqli_query($connection, $query_tacgia);
    $row_TG_Ten = mysqli_fetch_array($result_tacgia, MYSQLI_ASSOC);    


    $query_soLuong_sach = "SELECT SUM(SoLuong) soluong FROM `tonkho` WHERE S_Ma = '$S_Ma'";
    $result_soluong = mysqli_query($connection, $query_soLuong_sach);
    $row_soluong = mysqli_fetch_array($result_soluong, MYSQLI_ASSOC);    

    
                                                    echo $i % 2 != 0 ? "<tr role='row' class='odd'>" : "<tr role='row' class='even'>";
                                                ?>
                                                    
                                                    <td style="height: 100px; vertical-align: middle; text-align: left;"> <?php echo $S_Ma; ?></td>

   <td style='height: 100px; vertical-align: middle; text-align: left;  white-space: normal;
    word-wrap: break-word;'><?php echo $S_Ten; ?></td>
                                                    
    
    <td style="height: 100px; vertical-align: middle; text-align: center;"><?php echo $gianiemyet['GNY_DonGia']; ?></td>                                                    <!-- <td style="height: 100px; vertical-align: middle; text-align: left;"><?php /*echo $gianiemyet['GNY_NgayHieuLuc']; */?></td> -->
    <td style="height: 100px; vertical-align: middle; text-align: left;"><img src="../<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>" width="100px"></td>
    <td style="height: 100px; vertical-align: middle; text-align: center;"><?php echo $S_NamXuatBan; ?></td>
    <td style="height: 100px; vertical-align: middle; text-align: left;  white-space: normal;
    word-wrap: break-word;"><?php echo $row_TG_Ten['TG_Ten']; ?></td>
    <td style="height: 100px; vertical-align: middle; text-align: center;"><?php echo $row_soluong['soluong']; ?></td>
    <td style="height: 100px; vertical-align: middle; text-align: center;">
        <a href="sach_detail.php?S_Ma=<?php echo $S_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Detail"><i class="ri  ri-information-line font-size-18"></i></a>
        <a href="sach_edit.php?S_Ma=<?php echo $S_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
        <a onclick="confirmDelete('<?php echo $S_Ma; ?>');" class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
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
