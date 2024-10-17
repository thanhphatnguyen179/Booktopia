<?php ob_start(); ?>


<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>
<head>
    <style>
        .don_gia_sach h3 {
            color: red;
            margin-top: 20px;
            /* font-size: 20px; */
        }
    </style>
</head>

<div class="main-wrapper">

<!-- Begin Hiraola's Header Main Area -->
<?php include('includes/nav_bar.php'); ?>
<!-- Hiraola's Header Main Area End Here -->

<?php 

    global $connection; 

    if (isset($_GET["bookid"])){
        $book_id = $_GET["bookid"];
    }
    else {
        header('Location: index.php');
        exit();
    }


    $query = "SELECT * FROM sach WHERE S_Ma = '$book_id'";
    $result = mysqli_query($connection, $query);


    // // Kiểm tra kết quả truy vấn
    // if (mysqli_num_rows($result) === 0) {
    //     // Nếu không tìm thấy sách, chuyển hướng về index.php
    //     header('Location: index.php');
    //     exit();
    // }


    $row = mysqli_fetch_assoc($result);
        $S_Ma = $row["S_Ma"];
        $S_Ten = $row["S_Ten"];
        $S_HinhAnh = $row["S_HinhAnh"];
        $S_NamXuatBan = $row["S_NamXuatBan"];
        $S_NgonNgu = $row["S_NgonNgu"];
        $S_TenNguoiDich = $row["S_TenNguoiDich"];
        $S_TrongLuong = $row["S_TrongLuong"];
        $S_KichThuoc = $row["S_KichThuoc"];
        $S_SoTrang = $row["S_SoTrang"];
        $S_HinhThuc = $row["S_HinhThuc"];
        $S_MoTa = $row["S_MoTa"];
        $TG_Ma = $row["TG_Ma"];
        $NXB_Ma = $row["NXB_Ma"];
        $NCC_Ma = $row["NCC_Ma"];
        $CD_Ma = $row["CD_Ma"];

        
    // Hàm lấy tên từ bảng
    function getName($connection, $table, $id_column, $id_value, $name_column) {
        $name = "";
        $query = "SELECT $name_column FROM $table WHERE $id_column = '$id_value'";
        $result = mysqli_query($connection, $query);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $name = $row[$name_column];
        } else {
            $name = "Không tìm thấy tên";
        }
        
        return $name;
    }

    
    $TG_Ten = getName($connection, 'tacgia', 'TG_Ma', $TG_Ma, 'TG_Ten');
    $NXB_Ten = getName($connection, 'nhaxuatban', 'NXB_Ma', $NXB_Ma, 'NXB_Ten');
    $NCC_Ten = getName($connection, 'nhacungcap', 'NCC_Ma', $NCC_Ma, 'NCC_Ten');
    $CD_Ten = getName($connection, 'chude', 'CD_Ma', $CD_Ma, 'CD_Ten');



    $queryGia = "
            SELECT GNY_DonGia
            FROM gianiemyet
            WHERE S_Ma = '$S_Ma'
            AND GNY_NgayHieuLuc = (
                SELECT MAX(GNY_NgayHieuLuc)
                FROM gianiemyet
                WHERE S_Ma = '$S_Ma'
            )
    ";

    // Thực hiện truy vấn
    $resultGia = mysqli_query($connection, $queryGia);
    
    if ($resultGia) {
        $rowGia = mysqli_fetch_assoc($resultGia);
        // Kiểm tra xem có giá không
        $S_DonGia = isset($rowGia['GNY_DonGia']) ? $rowGia['GNY_DonGia'] : "Tạm dừng bán"; 
    } else {
        $S_DonGia = "Tạm dừng bán"; 
    }
?>



        

        <!-- Begin Hiraola's Single Product Area -->
        <div class="sp-area">
            <div class="container">
                <div class="sp-nav">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="sp-img_area">
                                <div class="zoompro-border">
                                    <img class="zoompro" src="<?php echo $S_HinhAnh; ?>" data-zoom-image="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="sp-content">
                                <div class="sp-heading">
                                    <h2><?php echo $S_Ten; ?></h2>
                                </div>
                                
                                <div class="rating-box">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li class="silver-color"><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>

                                <div class="sp-essential_stuff">
                                    <ul>
<li>Mã hàng: <span><?php echo $S_Ma; ?></span></li>
<li>Tên Nhà Cung Cấp: <a href="javascript:void(0)"><?php echo $NCC_Ten; ?></a></li>
<li>Tác giả: <a href="javascript:void(0)"><?php echo $TG_Ten; ?></a></li>
<li>Tên nhà xuất bản: <a href="javascript:void(0)"><?php echo $NXB_Ten; ?></a></li>
<li>Năm XB: <?php echo $S_NamXuatBan; ?></li>
<li>Số trang: <?php echo $S_SoTrang; ?></li>
<li>Hình thức: <a href="javascript:void(0)"><?php echo $S_HinhThuc; ?></a></li>

                                                    
                                    </ul>
                                </div>
                                
                                <div class="quantity">
                                    <label>Số lượng</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>

                                <div class="don_gia_sach">
                                    <h3><?php echo number_format($S_DonGia, 0, ',', '.') . 'đ'; ?></h3>
                                </div>


                                <div class="qty-btn_area">
                                    <ul>
                                        <li><a class="qty-cart_btn" href="cart.html">Add To Cart</a></li>
                                        <li><a class="qty-wishlist_btn" href="wishlist.html" data-toggle="tooltip" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a></li>
                                        
                                    </ul>
                                </div>
                                <!-- <div class="hiraola-tag-line">
                                    <h6>Tags:</h6>
                                    <a href="javascript:void(0)">Ring</a>,
                                    <a href="javascript:void(0)">Necklaces</a>,
                                    <a href="javascript:void(0)">Braid</a>
                                </div> -->
                                <!-- <div class="hiraola-social_link">
                                    <span>Hãy liên hệ với chúng tôi thông qua: </span>
                                    <ul>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        
                                        <li class="youtube">
                                            <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank" title="Youtube">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        
                                        <li class="instagram">
                                            <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Single Product Area End Here -->










        <!-- Begin Hiraola's Single Product Tab Area -->
        <div class="hiraola-product-tab_area-2 sp-product-tab_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sp-product-tab_nav ">
                            <div class="product-tab">
                                <ul class="nav product-menu">
                                    <li><a  data-toggle="tab" href="#description"><span>Mô tả</span></a>
                                    </li>
                                    <li><a  class="active" data-toggle="tab" href="#specification"><span>Chi tiết cụ thể</span></a></li>
                                    <li><a data-toggle="tab" href="#reviews"><span>Đánh giá</span></a></li>
                                </ul>
                            </div>
                            <div class="tab-content hiraola-tab_content">
                                
                                <div id="specification" class="tab-pane  active show" role="tabpanel">
                                <table class="table table-bordered specification-inner_stuff">
                                    <tbody>
                                        <tr>
                                            <td><strong>Mã hàng</strong></td>
                                            <td><?php echo $S_Ma; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tên Nhà Cung Cấp</strong></td>
                                            <td><a href="javascript:void(0)"><?php echo $NCC_Ten; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tác giả</strong></td>
                                            <td><a href="javascript:void(0)"><?php echo $TG_Ten; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Người Dịch</strong></td>
                                            <td><?php echo $S_TenNguoiDich; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tên Nhà Xuất Bản</strong></td>
                                            <td><a href="javascript:void(0)"><?php echo $NXB_Ten; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Năm XB</strong></td>
                                            <td><?php echo $S_NamXuatBan; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ngôn Ngữ</strong></td>
                                            <td><?php echo $S_NgonNgu; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Trọng lượng (gr)</strong></td>
                                            <td><?php echo $S_TrongLuong; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kích Thước Bao Bì</strong></td>
                                            <td><?php echo $S_KichThuoc; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Số trang</strong></td>
                                            <td><?php echo $S_SoTrang; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Hình thức</strong></td>
                                            <td><a href="javascript:void(0)"><?php echo $S_HinhThuc; ?></a></td>
                                        </tr>
                                    </tbody>
                                </table>

                                </div>
                                <div id="description" class="tab-pane" role="tabpanel">
                                    <div class="product-description" style="text-align: justify; ">
                                        <ul>
                                            <li style="padding-right: 30px;">
                                                <?php echo $S_MoTa; ?>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div id="reviews" class="tab-pane" role="tabpanel">
                                    <div class="tab-pane active" id="tab-review">
                                        <form class="form-horizontal" id="form-review">
                                            <div id="review">
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 50%;"><strong>Khách Hàng</strong></td>
                                                            <td class="text-right">17/10/2024</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <p>
Cuốn sách này thực sự tuyệt vời và đáng đọc. Từ nội dung đến cách trình bày, tất cả đều rất ấn tượng và cuốn hút. Một lựa chọn xuất sắc cho bất kỳ ai tìm kiếm một trải nghiệm đọc thú vị. 📚✨</p>
                                                                <div class="rating-box">
                                                                    <ul>
                                                                         <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                        <li><i class="fa fa-star"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h2>Viết đánh giá</h2>
                                            <div class="form-group required">
                                                <div class="col-sm-12 p-0">
                                                    <label>Email của quý độc giả<span class="required">*</span></label>
                                                    <input class="review-input" type="email" name="con_email" id="con_email" required>
                                                </div>
                                            </div>
                                            <div class="form-group required second-child">
                                                <div class="col-sm-12 p-0">
                                                    <label class="control-label">Chia sẻ cảm nhận hoặc góp ý cho chúng tôi</label>
                                                    <textarea class="review-textarea" name="con_message" id="con_message"></textarea>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group last-child required">
                                                <div class="col-sm-12 p-0">
                                                    <div class="your-opinion">
                                                        <label>Đánh giá</label>
                                                        <span>
                                                        <select class="star-rating">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="hiraola-btn-ps_right">
                                                    <a href="javascript:void(0)" class="hiraola-btn hiraola-btn_dark">Đánh giá</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Single Product Tab Area End Here -->


        <?php include('includes/new_arrival.php'); ?>



        
        

        </div>

<?php include('includes/footer.php'); ?>

<?php ob_end_flush(); ?>
