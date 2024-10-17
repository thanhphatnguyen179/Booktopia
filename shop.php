<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>

<div class="main-wrapper">

<!-- Begin Hiraola's Header Main Area -->
<?php include('includes/nav_bar.php'); ?>
<!-- Hiraola's Header Main Area End Here -->


        <!-- Begin Hiraola's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Shop</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Shop Left Sidebar</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Hiraola's Breadcrumb Area End Here -->

        <!-- Begin Hiraola's Content Wrapper Area -->
        <div class="hiraola-content_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="hiraola-sidebar-catagories_area">
                            <div class="hiraola-sidebar_categories">
                                <div class="hiraola-categories_title">
                                    <h5>Price</h5>
                                </div>
                                <div class="price-filter">
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <label>price : </label>
                                            <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                        </div>
                                        <!-- <button type="button">Filter</button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="hiraola-sidebar_categories">
                                <div class="hiraola-categories_title">
                                    <h5>Brand</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    <li>
                                        <a href="javascript:void(0)">Brand 1(15)</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Brand 2(16)</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Brand 3(16)</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Brand 4(17)</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hiraola-sidebar_categories">
                                <div class="hiraola-categories_title">
                                    <h5>Size</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    <li>
                                        <a href="javascript:void(0)">Size 1(17)</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Size 2(16)</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Size 3(17)</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Size 4(17)</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="category-module hiraola-sidebar_categories">
                                <div class="category-module_heading">
                                    <h5>Categories</h5>
                                </div>
                                <div class="module-body">
                                    <ul class="module-list_item">
                                        <li>
                                            <a href="javascript:void(0)">Hand Harness (18)</a>
                                            <ul class="module-sub-list_item">
                                                <li>
                                                    <a href="javascript:void(0)">Maang Tika (18)</a>
                                                    <a href="javascript:void(0)">Toe Rings (18)</a>
                                                    <a href="javascript:void(0)">Traditional Earrings (18)</a>
                                                    <a href="javascript:void(0)">Kada Cum Bracelet (18)</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Exquisite Rings (18)</a>
                                            <a href="javascript:void(0)">Necklaces (18)</a>
                                            <a href="javascript:void(0)">Foot Harness (18)</a>
                                            <a href="javascript:void(0)">Braid Jewels (18)</a>
                                            <a href="javascript:void(0)">Anklet (18)</a>
                                            <a href="javascript:void(0)">Graceful Armlet (18)</a>
                                            <a href="javascript:void(0)">Magna Pellentesq (18)</a>
                                            <a href="javascript:void(0)">Molestie Tortor (18)</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="sidebar-banner_area">
                            <div class="banner-item img-hover_effect">
                                <a href="javascript:void(0)">
                                    <img src="assets/images/banner/1_1.jpg" alt="Hiraola's Shop Banner Image">
                                </a>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-toolbar">
                            <div class="product-view-mode">
                                <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="fa fa-th"></i></a>
                                <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List View"><i class="fa fa-th-list"></i></a>
                            </div>
                            <div class="product-item-selection_area">
                                <div class="product-short">
                                    <label class="select-label">Short By:</label>
                                    <select class="nice-select">
                                        <option value="1">Relevance</option>
                                        <option value="2">Name, A to Z</option>
                                        <option value="3">Name, Z to A</option>
                                        <option value="4">Price, low to high</option>
                                        <option value="5">Price, high to low</option>
                                        <option value="5">Rating (Highest)</option>
                                        <option value="5">Rating (Lowest)</option>
                                        <option value="5">Model (A - Z)</option>
                                        <option value="5">Model (Z - A)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                            <a href="single-product.html">
                                                <img class="primary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                                <img class="secondary-img" src="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>">
                                            </a>
                                            
                                        </div>
                                        <div class="hiraola-product_content">
                                            <div class="product-desc_info">
                                                <h6><a class="product-name" href="<?php echo "book.php?bookid=$S_Ma"; ?>"><?php echo $S_Ten; ?></a></h6>
                                                <div class="price-box">
                                                    <span class="new-price"><?php echo $S_DonGia; ?></span>
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
                                                    <span class="new-price"><?php echo $S_DonGia; ?></span>
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
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="product-select-box">
                                                <div class="product-short">
                                                    <p>Showing 1 to 12 of 18 (2 Pages)</p>
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
        </div>
        <!-- Hiraola's Content Wrapper Area End Here -->




       


<?php include('includes/footer.php'); ?>