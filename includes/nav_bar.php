<header class="header-main_area">






<div class="header-middle_area d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header-logo">
                    <a href="index.php">
                        <img src="assets/images/logo-small.png"  alt="Hiraola's Header Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hm-form_area">
                    <form action="#" class="hm-searchbox">
                        <select class="nice-select select-search-category">
                            <option value="0">Tìm kiếm</option>
                            
                        </select>
                        <input type="text" placeholder="Vui lòng chọn sách bạn cần tìm">
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="header-bottom_area header-sticky stick theme-color-navbar">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 d-lg-none d-block">
                <div class="header-logo">
                    <a href="index.html">
                        <img src="assets/images/menu/logo/2.png" alt="Hiraola's Header Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-9 d-none d-lg-block position-static">
                <div class="main-menu_area">
                    <nav>
                        <ul>
                            <li class="dropdown-holder"><a href="index.php">Trang chủ</a>
                                
                            </li>
                            <li class="megamenu-holder"><a href="shop.php">Cửa hàng</a>
                                
                            </li>
                            
                            
                            <li><a href="about-us.php">Về chúng tôi</a></li>
                            <li><a href="contact.php">Liên hệ</a></li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-8">
                <div class="header-right_area">
                    <ul>
                        
                        <!-- <li>
                            <a href="wishlist.html" class="wishlist-btn">
                                <i class="ion-android-favorite-outline"></i>
                            </a>
                        </li> -->
                        <li>
                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white d-lg-none d-block">
                                <i class="ion-navicon"></i>
                            </a>
                        </li>

                        <li>
                            <a href="cart.php">
                                <i class="ion-bag"></i>
                            </a>
                        </li>


                        <li>
<?php 
    if (!isset($_SESSION['ND_Ma'])) {
        echo "<a href='login.php' >";
        echo "<i class='ion-android-person'></i>
                            </a>";
    } else {
        echo "<a href='dashboard.php' >";
        echo "<i class='ion-android-person'></i>
                            </a>";
    }
?>                            
                            
                                
                        </li>


                        
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('./includes/mini_cart.php') ?>



<div class="mobile-menu_wrapper" id="mobileMenu">
    <div class="offcanvas-menu-inner">
        <div class="container">
            <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
            <div class="offcanvas-inner_search">
                <form action="#" class="hm-searchbox">
                    <input type="text" placeholder="Search for item...">
                    <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                </form>
            </div>
            <nav class="offcanvas-navigation">
                <ul class="mobile-menu">
                    <li class="menu-item-has-children active"><a href="index.html"><span
                            class="mm-text">Trang chủ</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="index.html">
                                    <span class="mm-text">Home One</span>
                                </a>
                            </li>
                            <li>
                                <a href="index-2.html">
                                    <span class="mm-text">Home Two</span>
                                </a>
                            </li>
                            <li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="shop-left-sidebar.html">
                            <span class="mm-text">Shop</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="menu-item-has-children">
                                <a href="shop-left-sidebar.html">
                                    <span class="mm-text">Grid View</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="shop-3-column.html">
                                            <span class="mm-text">Column Three</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-4-column.html">
                                            <span class="mm-text">Column Four</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-left-sidebar.html">
                                            <span class="mm-text">Left Sidebar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-right-sidebar.html">
                                            <span class="mm-text">Right Sidebar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="shop-list-left-sidebar.html">
                                    <span class="mm-text">Shop List</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="shop-list-fullwidth.html">
                                            <span class="mm-text">Full Width</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-list-left-sidebar.html">
                                            <span class="mm-text">Left Sidebar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-list-right-sidebar.html">
                                            <span class="mm-text">Right Sidebar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="single-product-gallery-left.html">
                                    <span class="mm-text">Single Product Style</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="single-product-gallery-left.html">
                                            <span class="mm-text">Gallery Left</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-gallery-right.html">
                                            <span class="mm-text">Gallery Right</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-tab-style-left.html">
                                            <span class="mm-text">Tab Style Left</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-tab-style-right.html">
                                            <span class="mm-text">Tab Style Right</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-sticky-left.html">
                                            <span class="mm-text">Sticky Left</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-sticky-right.html">
                                            <span class="mm-text">Sticky Right</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="single-product.html">
                                    <span class="mm-text">Single Product Type</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="single-product.html">
                                            <span class="mm-text">Single Product</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-sale.html">
                                            <span class="mm-text">Single Product Sale</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-group.html">
                                            <span class="mm-text">Single Product Group</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-variable.html">
                                            <span class="mm-text">Single Product Variable</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-affiliate.html">
                                            <span class="mm-text">Single Product Affiliate</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="single-product-slider.html">
                                            <span class="mm-text">Single Product Slider</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="blog-left-sidebar.html">
                            <span class="mm-text">Blog</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="menu-item-has-children has-children">
                                <a href="blog-left-sidebar.html">
                                    <span class="mm-text">Grid View</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="blog-2-column.html">
                                            <span class="mm-text">Column Two</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-3-column.html">
                                            <span class="mm-text">Column Three</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-left-sidebar.html">
                                            <span class="mm-text">Left Sidebar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-right-sidebar.html">
                                            <span class="mm-text">Right Sidebar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children has-children">
                                <a href="blog-list-left-sidebar.html">
                                    <span class="mm-text">List View</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="blog-list-fullwidth.html">
                                            <span class="mm-text">List Fullwidth</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-list-left-sidebar.html">
                                            <span class="mm-text">List Left Sidebar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-list-right-sidebar.html">
                                            <span class="mm-text">List Right Sidebar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children has-children">
                                <a href="blog-details-left-sidebar.html">
                                    <span class="mm-text">Blog Details</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="blog-details-left-sidebar.html">
                                            <span class="mm-text">Left Sidebar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-details-right-sidebar.html">
                                            <span class="mm-text">Right Sidebar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children has-children">
                                <a href="blog-gallery-format.html">
                                    <span class="mm-text">Blog Format</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="blog-gallery-format.html">
                                            <span class="mm-text">Gallery Format</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-audio-format.html">
                                            <span class="mm-text">Audio Format</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-video-format.html">
                                            <span class="mm-text">Video Format</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="index.html">
                            <span class="mm-text">Pages</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="my-account.html">
                                    <span class="mm-text">My Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="login-register.html">
                                    <span class="mm-text">Login | Register</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="wishlist.html">
                                    <span class="mm-text">Wishlist</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="cart.html">
                                    <span class="mm-text">Cart</span>
                                </a>
                            </li>
                            <li>
                                <a href="checkout.html">
                                    <span class="mm-text">Checkout</span>
                                </a>
                            </li>
                            <li>
                                <a href="compare.html">
                                    <span class="mm-text">Compare</span>
                                </a>
                            </li>
                            <li>
                                <a href="faq.html">
                                    <span class="mm-text">FAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="404.html">
                                    <span class="mm-text">Error 404</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav class="offcanvas-navigation user-setting_area">
                <ul class="mobile-menu">
                    <li class="menu-item-has-children active"><a href="javascript:void(0)"><span
                            class="mm-text">User
                            Setting</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="my-account.html">
                                    <span class="mm-text">My Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="login-register.html">
                                    <span class="mm-text">Login | Register</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript:void(0)"><span
                            class="mm-text">Currency</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">EUR €</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">USD $</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript:void(0)"><span
                            class="mm-text">Language</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">English</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">Français</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">Romanian</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="mm-text">Japanese</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

</header>