<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

$S_Ma = "";
if (isset($_GET['S_Ma'])) {
    $S_Ma = $_GET['S_Ma'];
    
    // Kiểm tra xem mã sách có tồn tại trong cơ sở dữ liệu không
    $sql_check = "SELECT S_Ma FROM sach WHERE S_Ma = '$S_Ma'";
    $result_check = mysqli_query($connection, $sql_check);

    // Nếu không tìm thấy sách có mã đó, chuyển hướng đến trang page_404.php
    if (mysqli_num_rows($result_check) === 0) {
        header("Location: /booktopia/admin/pages-404.php");

        exit; // Dừng lại để tránh thực thi mã tiếp theo
    }
} else {
    // Nếu không có S_Ma trong URL, chuyển hướng đến trang page_404.php
    header("Location: /booktopia/admin/pages-404.php");

    exit; // Dừng lại để tránh thực thi mã tiếp theo
}


$sql_detail = "SELECT
    s.`S_Ma`,
    s.`S_Ten`,
    s.`S_HinhAnh`,
    s.`S_NamXuatBan`,
    s.`S_NgonNgu`,
    s.`S_TenNguoiDich`,
    s.`S_TrongLuong`,
    s.`S_KichThuoc`,
    s.`S_SoTrang`,
    s.`S_HinhThuc`,
    s.`S_MoTa`,
    s.`S_ThoiGianTao`,
    s.`S_TrangThai`,
    s.`TG_Ma`,
    s.`NXB_Ma`,
    s.`NCC_Ma`,
    s.`CD_Ma`,
    tg.`TG_Ten`,
    nxb.`NXB_Ten`,
    ncc.`NCC_Ten`,
    cd.`CD_Ten`,
    gny.`GNY_DonGia`,
    MAX(gny.`GNY_NgayHieuLuc`)
FROM
    `sach` s
LEFT JOIN tacgia tg ON
    s.`TG_Ma` = tg.`TG_Ma`
LEFT JOIN nhaxuatban nxb ON
    s.`NXB_Ma` = nxb.`NXB_Ma`
LEFT JOIN nhacungcap ncc ON
    s.`NCC_Ma` = ncc.`NCC_Ma`
LEFT JOIN chude cd ON
    s.`CD_Ma` = cd.`CD_Ma`
LEFT JOIN gianiemyet gny ON
    s.`S_Ma` = gny.`S_Ma`
WHERE
    s.`S_Ma` = '$S_Ma';
";
$result_sql_book = mysqli_query($connection, $sql_detail);

$row_book_detail = mysqli_fetch_array($result_sql_book);



// Gán dữ liệu vào các biến
$S_Ma = $row_book_detail['S_Ma'];
$S_Ten = $row_book_detail['S_Ten'];
$S_HinhAnh = $row_book_detail['S_HinhAnh'];
$S_NamXuatBan = $row_book_detail['S_NamXuatBan'];
$S_NgonNgu = $row_book_detail['S_NgonNgu'];
$S_TenNguoiDich = $row_book_detail['S_TenNguoiDich'];
$S_TrongLuong = $row_book_detail['S_TrongLuong'];
$S_KichThuoc = $row_book_detail['S_KichThuoc'];
$S_SoTrang = $row_book_detail['S_SoTrang'];
$S_HinhThuc = $row_book_detail['S_HinhThuc'];
$S_MoTa = $row_book_detail['S_MoTa'];
$S_ThoiGianTao = $row_book_detail['S_ThoiGianTao'];
$S_TrangThai = $row_book_detail['S_TrangThai'];
$TG_Ma = $row_book_detail['TG_Ma'];
$NXB_Ma = $row_book_detail['NXB_Ma'];
$NCC_Ma = $row_book_detail['NCC_Ma'];
$CD_Ma = $row_book_detail['CD_Ma'];
$TG_Ten = $row_book_detail['TG_Ten'];
$NXB_Ten = $row_book_detail['NXB_Ten'];
$NCC_Ten = $row_book_detail['NCC_Ten'];
$CD_Ten = $row_book_detail['CD_Ten'];
$GNY_DonGia = $row_book_detail['GNY_DonGia'];
$GNY_NgayHieuLuc = $row_book_detail['GNY_NgayHieuLuc'];


?>



<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chi tiết sách</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sách</a></li>
                                <li class="breadcrumb-item active">Chi tiết</li>
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
<div class="row">
    <div class="col-xl-5">
        
                        <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                            <div class="product-img">
                                <img src="../<?php echo $S_HinhAnh; ?>" alt="" class="img-fluid mx-auto d-block" data-zoom="assets/images/product/img-1.png">
                            </div>
                        
                    </div>
                    
                    
               
        <!-- end product img -->
    </div>
    <div class="col-xl-7">
        <div class="mt-4 mt-xl-3">
            <a href="#" class="text-primary">Sách</a>
            <h2 class="mt-1 mb-3"><?php echo $S_Ten; ?></h2>

            <div class="d-inline-flex">
                <div class="text-muted mr-3">
                    <span class="mdi mdi-star text-warning"></span>
                    <span class="mdi mdi-star text-warning"></span>
                    <span class="mdi mdi-star text-warning"></span>
                    <span class="mdi mdi-star text-warning"></span>
                    <span class="mdi mdi-star"></span>
                </div>
                <div class="text-muted">( 132 )</div>
            </div>
            
            <h3 class="mt-2"><del class="text-muted mr-2">$252</del><?php echo $GNY_DonGia; ?>đ <span class="text-danger font-size-12 ml-2">25 % Off</span></h3>
            
            <hr class="my-4">

            <div class="row">
                <h3>Thông tin bổ sung</h3>
                
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 400px;">Mã sách</th>
                                <td><?php echo $S_Ma; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Năm xuất bản</th>
                                <td><?php echo $S_NamXuatBan; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tác giả</th>
                                <td><?php echo $TG_Ten; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nhà cung cấp</th>
                                <td><?php echo $NCC_Ten; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nhà xuất bản</th>
                                <td><?php echo $NXB_Ten; ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Chủ đề</th>
                                <td><?php echo $CD_Ten; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            

            
            
        </div>
    </div>
</div>
<!-- end row -->
<div class="mt-4">
<h3>Chi tiết sách</h3>
                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 400px;">Năm xuất bản</th>
                                <td><?php echo $S_NamXuatBan; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Ngôn ngữ</th>
                                <td><?php echo $S_NgonNgu; ?></td>
                            </tr>
                                 <?php if ($S_TenNguoiDich != "") { ?>
                                    <tr>
                                        <th scope="row">Tên người dịch</th>
                                        <td><?php echo $S_TenNguoiDich; ?></td>
                                    </tr>
                                <?php } ?>
                            <tr>
                                <th scope="row">Trọng lượng</th>
                                
                                <td><?php echo $S_TrongLuong; ?></td>
                            
                            </tr>
                            <tr>
                                <th scope="row">Kích thước</th>
                                <td><?php echo $S_KichThuoc; ?> (g)</td>
                            </tr>
                            <tr>
                                <th scope="row">Số trang</th>
                                <td><?php echo $S_SoTrang; ?> trang</td>
                            </tr>
                            <tr>
                                <th scope="row">Hình thức</th>
                                <td><?php echo $S_HinhThuc; ?>(g)</td>
                            </tr>
                            <tr>
                                <th scope="row">Thời gian tạo</th>
                                <td><?php echo $S_ThoiGianTao; ?>(g)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
</div>
<div class="mt-4">
    <h4 class="mb-3">Mô tả sách</h4>
    <div class="product-desc">

        
                <div class="tab-content border border-top-0 p-4">
                    <?php echo $S_MoTa ?>
        
                 </div>
    </div>
</div>


</div>
</div>
<!-- end card -->
</div>
</div>
            <!-- end row -->

            
            <!-- end row -->
            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<footer class="footer">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
    <script>document.write(new Date().getFullYear())</script>2024 © Nazox.
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






<?php
include('includes/footer.php');
?>
