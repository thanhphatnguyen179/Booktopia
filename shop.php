<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>

<div class="main-wrapper">

<!-- Begin Hiraola's Header Main Area -->
<?php include('includes/nav_bar.php'); ?>
<!-- Hiraola's Header Main Area End Here -->


        <!-- Hiraola's Breadcrumb Area End Here -->

        <!-- Begin Hiraola's Content Wrapper Area -->
        <div class="hiraola-content_wrapper">
            <div class="container">
                <div class="row">
                    <h4>Tất cả sách của chúng tôi</h4>
                    <div class="col-lg-12 order-1 order-lg-2">
                    
                        <div class="shop-product-wrap grid gridview-3 row">
<?php 
    $per_page = 6;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];

    } else {
        $page = "";
    }
    if ($page == "" || $page == 1) {
        $page_1 = 0;
    } else {
        $page_1 = ($page * $per_page) - $per_page;
    }


    $result = "SELECT * FROM sach";
    $find_count = mysqli_query($connection, $result);
    $count = mysqli_num_rows($find_count);
    $count = ceil($count / $per_page);  

    $query = "SELECT * FROM sach LIMIT $page_1, $per_page";
    $ListBooks = mysqli_query($connection, $query);


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


    while ($row = mysqli_fetch_assoc($ListBooks)){
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






                            <div class="col-lg-4">
                                <div class="slide-item">
                                    <div class="single_product">
                                        <div class="product-img">
                                            <a href="<?php echo "book.php?bookid=$S_Ma"; ?>">
                                                <img class="primary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                                <img class="secondary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                            </a>
                                            
                                        </div>
                                        <br>
                                        <div class="hiraola-product_content">
                                            <div class="product-desc_info">
                                                <h6><a class="product-name" href="<?php echo "book.php?bookid=$S_Ma"; ?>"><?php echo $S_Ten; ?></a></h6>
                                                <div class="price-box">
                                                    <span class="new-price" don-gia="<?php echo $S_DonGia;?>"></span>
                                                </div>
                                                <div class="additional-add_action">
                                                    <ul>
                                                        <li><a class="hiraola-add_compare" href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
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
                                <div class="list-slide_item">
                                    <div class="single_product">
                                        <div class="product-img">
                                            <a href="single-product.html">
                                                <img class="primary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                                <img class="secondary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                            </a>
                                        </div>
                                        
                                        <div class="hiraola-product_content">
                                            <div class="product-desc_info">
                                            <h6><a class="product-name" href="<?php echo "book.php?bookid=$S_Ma"; ?>"><?php echo $S_Ten; ?></a></h6>
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li class="silver-color"><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                                <div class="price-box">
                                                    <span class="new-price" don-gia="<?php echo $S_DonGia;?>"></span>
                                                </div>
                                                <div class="product-short_desc">
                                                    <p><?php echo $S_MoTa; ?></p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To Cart">Add To Cart</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php  } ?>                            
                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hiraola-paginatoin-area">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <ul class="hiraola-pagination-box">
<?php 
    $cur_page = 1;
    if (isset($_GET["page"])) {
        $cur_page = $_GET["page"]; }
        
    for ($i = 1; $i <= $count; $i++) { 
        
        if ($i == $page) {
            echo "<li class='active'><a href='shop.php?page=$i'>$i</a></li>";
        } else {
            echo "<li><a href='shop.php?page=$i'>$i</a></li>";
        }
    }
?>                                                

<?php 
    $nextNumber = $cur_page +1;
    
    if ($nextNumber > $count)
        $nextNumber = $cur_page;

    
?>


                                                <li><a class="Next" href="shop.php?page=<?php echo $nextNumber; ?>"><i
                                                        class="ion-ios-arrow-right"></i></a></li>
                                                <li><a class="Next" href="javascript:void(0)">>|</a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Content Wrapper Area End Here -->




       


<?php include('includes/footer.php'); ?>


<script>// Hàm format tiền tệ Việt Nam
function formatVietnameseCurrency(value) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
        .format(value)
        .replace('₫', 'đ'); // Thay ₫ thành đ
}

// Lấy tất cả các phần tử có class "new-price"
document.querySelectorAll('.new-price').forEach((element) => {
    const donGia = element.getAttribute('don-gia'); // Lấy giá trị từ thuộc tính don-gia
    if (donGia) {
        const formattedPrice = formatVietnameseCurrency(donGia); // Format giá trị
        element.textContent = formattedPrice; // Gán giá trị format vào nội dung span
    }
});
</script>