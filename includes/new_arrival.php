


<div class="hiraola-product_area">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="hiraola-section_title">
                <h4>Sách mới </h4>
            </div>
        </div>
        <div class="col-lg-12">

            
            <div class="hiraola-product_slider">

<?php 

    global $connection; 

    $query = "SELECT * FROM sach LIMIT 10";
    $sach_moi_ve = mysqli_query($connection, $query);

    $S_Gia = 0;
    while ($row = mysqli_fetch_assoc($sach_moi_ve)){
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


         // Truy vấn để lấy GNY_DonGia
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



                <!-- Begin Hiraola's Slide Item Area -->
                <div class="slide-item">
                    <div class="single_product">
                        <div class="product-img">
                            <a href="book.php?bookid=<?php echo $S_Ma; ?>">
                                <img class="primary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                <img class="secondary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                            </a>
                            <span class="sticker">New</span>
                            <span class="sticker-2">Sale</span>
                            <div class="add-actions">
                                <ul>
                                    
                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="ion-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="hiraola-product_content">
                            <div class="product-desc_info">
                                <h6><a class="product-name" href="book.php?bookid=<?php echo $S_Ma; ?>"><?php echo $S_Ten; ?></a></h6>
                                <div class="price-box">
                                    <span class="new-price"><?php echo number_format($S_DonGia, 0, ',', '.') . 'đ'; ?></span>
                                </div>
                                <div class="additional-add_action">
                                    <ul>
                                        <li><a class="hiraola-add_compare" href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                        </li>
                                    </ul>
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hiraola's Slide Item Area End Here -->
                <?php  } ?>
            </div>
        </div>
    </div>
</div>
</div>



