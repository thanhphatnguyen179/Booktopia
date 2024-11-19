
<?php ob_start(); ?>





<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>



<div class="main-wrapper">

<!-- Begin Hiraola's Header Main Area -->
<?php include('includes/nav_bar.php'); ?>
<!-- Hiraola's Header Main Area End Here -->
<?php 
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    echo "
    <script>
        Swal.fire({
            icon: '" . $alert['type'] . "',
            title: '" . $alert['message'] . "',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    ";
    unset($_SESSION['alert']);
}


?>

<?php 
if (!isset($_SESSION['ND_Ma'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: 'Thông báo',
            text: 'Quý khách chưa đăng nhập!',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/booktopia/index.php';
            }
        });
    </script>";
    exit();
} ?>



            <main class="page-content">
            <!-- Begin Hiraola's Account Page Area -->
            <div class="account-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-dashboard-tab" data-toggle="tab" href="#account-dashboard" role="tab" aria-controls="account-dashboard" aria-selected="true">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-orders-tab" data-toggle="tab" href="#account-orders" role="tab" aria-controls="account-orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-address-tab" data-toggle="tab" href="#account-address" role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-logout-tab" href="./admin/functions/functions/logout.php" role="tab" aria-selected="false">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                                <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel" aria-labelledby="account-dashboard-tab">
                                    <div class="myaccount-dashboard">
                                        
                                    <div class="container mt-4">
    <h3 class="text-center">Thông tin cá nhân</h3>
    
    <div class="row">
        <!-- Hình ảnh -->
        <div class="col-md-4 text-center">
            <div class="mb-3">
<?php 
    $path_img = $_SESSION['ND_HinhAnh'];
    if (empty($path_img)) {
        $path_img = "./assets/images/no_image.jpg";
    }
?>                
                <img src="<?php echo $path_img; ?>" alt="Ảnh đại diện" class="img-fluid rounded-circle border border-secondary" style="width: 150px; height: 150px;">
            </div>
        </div>
        
        <!-- Thông tin cá nhân -->
        <div class="col-md-8">
            <div class="mb-3">
                <label class="form-label fw-bold">Mã người dùng: </label>
                <span><?php echo htmlspecialchars($_SESSION['ND_Ma']); ?></span>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Tên đăng nhập: </label>
                <span><?php echo htmlspecialchars($_SESSION['ND_TenDangNhap']); ?></span>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Họ và tên: </label>
                <span><?php echo htmlspecialchars($_SESSION['ND_HoTen']); ?></span>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Số điện thoại: </label>
                <span><?php echo htmlspecialchars($_SESSION['ND_SoDT']); ?></span>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Email: </label>
                <span><?php echo htmlspecialchars($_SESSION['ND_Email']); ?></span>
            </div>
        </div>
    </div>
</div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="myaccount-orders">
                                        <h4 class="small-title">MY ORDERS</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>ORDER</th>
                                                        <th>DATE</th>
                                                        <th>STATUS</th>
                                                        <th>TOTAL</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="account-order-id" href="javascript:void(0)">#5364</a></td>
                                                        <td>Mar 27, 2019</td>
                                                        <td>On Hold</td>
                                                        <td>£162.00 for 2 items</td>
                                                        <td><a href="javascript:void(0)" class="hiraola-btn hiraola-btn_dark hiraola-btn_sm"><span>View</span></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="account-order-id" href="javascript:void(0)">#5356</a></td>
                                                        <td>Mar 27, 2019</td>
                                                        <td>On Hold</td>
                                                        <td>£162.00 for 2 items</td>
                                                        <td><a href="javascript:void(0)" class="hiraola-btn hiraola-btn_dark hiraola-btn_sm"><span>View</span></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">
                                    <div class="myaccount-address">

<?php 
    
    $ND_Ma = $_SESSION['ND_Ma'];
    $sql_address = "SELECT * FROM `diachi` WHERE DC_MacDinh = 1 AND ND_Ma = '$ND_Ma'";
    $result_address = mysqli_query($connection, $sql_address);

    // Khởi tạo biến để lưu thông tin địa chỉ mặc định nếu có
    $DC_Ma = "";
    $TTP_Ma = "";
    $QH_Ma = "";
    $XPTT_Ma = "";
    $DC_SoNha = "";
    $DC_MacDinh = "";

    if ($row_address = mysqli_fetch_array($result_address)) {
        // Gán các biến với giá trị từ kết quả truy vấn nếu có địa chỉ mặc định
        $DC_Ma = $row_address['DC_Ma'];
        $TTP_Ma = $row_address['TTP_Ma'];
        $QH_Ma = $row_address['QH_Ma'];
        $XPTT_Ma = $row_address['XPTT_Ma'];
        $DC_SoNha = $row_address['DC_SoNha'];
    }
?>

<!-- Form Cập nhật địa chỉ -->
<form action="./includes/personal/insert_update_addresss.php" method="POST">
    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Tỉnh/Thành phố</th>
                    <th>Quận/Huyện</th>
                    <th>Phường/Xã/Thị trấn</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="form-control" id="province" name="TTP_Ma">
                            <option value='' selected disabled>Chọn Tỉnh/Thành phố</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="district" name="QH_Ma">
                            <option value='' selected disabled>Chọn Quận/Huyện</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="ward" name="XPTT_Ma">
                            <option value='' selected  disabled>Chọn Phường/Xã/Thị trấn</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <label for="houseNumber">Số nhà</label>
                        <input name="DC_SoNha" type="text" id="houseNumber" class="form-control" value="<?= $DC_SoNha ?>" placeholder="Nhập số nhà">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <h3>Chi phí vận chuyển: <span id="shippingCost" style="color:red;">0 VND</span></h3>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-4" style="background-color: #cda557; border-color: #cda557;">Cập nhật thông tin</button>
    </div>
</form>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                    <div class="myaccount-details">
                                        <form action="#" class="hiraola-form">
                                            <div class="hiraola-form-inner">
                                                <div class="single-input single-input-half">
                                                    <label for="account-details-firstname">First Name*</label>
                                                    <input type="text" id="account-details-firstname">
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="account-details-lastname">Last Name*</label>
                                                    <input type="text" id="account-details-lastname">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-email">Email*</label>
                                                    <input type="email" id="account-details-email">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-oldpass">Current Password(leave blank to leave
                                                        unchanged)</label>
                                                    <input type="password" id="account-details-oldpass">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-newpass">New Password (leave blank to leave
                                                        unchanged)</label>
                                                    <input type="password" id="account-details-newpass">
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-confpass">Confirm New Password</label>
                                                    <input type="password" id="account-details-confpass">
                                                </div>
                                                <div class="single-input">
                                                    <button class="hiraola-btn hiraola-btn_dark" type="submit"><span>SAVE
                                                    CHANGES</span></button>
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
            <!-- Hiraola's Account Page Area End Here -->
        </main>
        <!-- Hiraola's Page Content Area End Here -->
        <!-- Begin Hiraola's Footer Area -->
        <div class="hiraola-footer_area">
            <div class="footer-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer-widgets_info">

                                <div class="footer-widgets_logo">
                                    <a href="#">
                                        <img src="assets/images/footer/logo/1.png" alt="Hiraola's Footer Logo">
                                    </a>
                                </div>


                                <div class="widget-short_desc">
                                    <p>We are a team of designers and developers that create high quality HTML Template & Woocommerce, Shopify Theme.
                                    </p>
                                </div>
                                <div class="hiraola-social_link">
                                    <ul>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                <i class="fab fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="footer-widgets_area">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="footer-widgets_title">
                                            <h6>Product</h6>
                                        </div>
                                        <div class="footer-widgets">
                                            <ul>
                                                <li><a href="#">Prices drop</a></li>
                                                <li><a href="#">New products</a></li>
                                                <li><a href="#">Best sales</a></li>
                                                <li><a href="#">Contact us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="footer-widgets_info">
                                            <div class="footer-widgets_title">
                                                <h6>About Us</h6>
                                            </div>
                                            <div class="widgets-essential_stuff">
                                                <ul>
                                                    <li class="hiraola-address"><i class="ion-ios-location"></i><span>Address:</span> The Barn, Ullenhall, Henley
                                                        in
                                                        Arden B578 5CC, England</li>
                                                    <li class="hiraola-phone"><i class="ion-ios-telephone"></i><span>Call Us:</span> <a href="tel://+123123321345">+123 321 345</a>
                                                    </li>
                                                    <li class="hiraola-email"><i class="ion-android-mail"></i><span>Email:</span> <a href="mailto://info@yourdomain.com">info@yourdomain.com</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="instagram-container footer-widgets_area">
                                            <div class="footer-widgets_title">
                                                <h6>Sign Up For Newslatter</h6>
                                            </div>
                                            <div class="widget-short_desc">
                                                <p>Subscribe to our newsletters now and stay up-to-date with new collections</p>
                                            </div>
                                            <div class="newsletter-form_wrap">
                                                <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="newsletters-form validate" target="_blank" novalidate>
                                                    <div id="mc_embed_signup_scroll">
                                                        <div id="mc-form" class="mc-form subscribe-form">
                                                            <input id="mc-email" class="newsletter-input" type="email" autocomplete="off" placeholder="Enter your email" />
                                                            <button class="newsletter-btn" id="mc-submit">
                                                                <i class="ion-android-mail" aria-hidden="true"></i>
                                                            </button>
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
            </div>
            <div class="footer-bottom_area">
                <div class="container">
                    <div class="footer-bottom_nav">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">Online Shopping</a></li>
                                        <li><a href="#">Promotions</a></li>
                                        <li><a href="#">My Orders</a></li>
                                        <li><a href="#">Help</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Most Populars</a></li>
                                        <li><a href="#">New Arrivals</a></li>
                                        <li><a href="#">Special Products</a></li>
                                        <li><a href="#">Manufacturers</a></li>
                                        <li><a href="#">Our Stores</a></li>
                                        <li><a href="#">Shipping</a></li>
                                        <li><a href="#">Payments</a></li>
                                        <li><a href="#">Warantee</a></li>
                                        <li><a href="#">Refunds</a></li>
                                        <li><a href="#">Checkout</a></li>
                                        <li><a href="#">Discount</a></li>
                                        <li><a href="#">Refunds</a></li>
                                        <li><a href="#">Policy Shipping</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="payment">
                                    <a href="#">
                                        <img src="assets/images/footer/payment/1.png" alt="Hiraola's Payment Method">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="copyright">
                                    <span>Copyright &copy; 2019 <a href="#">Hiraola.</a> All rights reserved.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Footer Area End Here -->













<?php include('includes/new_arrival.php'); ?>


</div>

<?php include('includes/footer.php'); ?>

<?php ob_end_flush(); ?>


<script>
    $(document).ready(function() {
    // Biến để giữ giá trị mặc định
    const defaultProvince = "<?= $TTP_Ma ?>";
    const defaultDistrict = "<?= $QH_Ma ?>";
    const defaultWard = "<?= $XPTT_Ma ?>";

    // Lấy các tỉnh/thành phố khi trang được tải
    $.ajax({
        url: './includes/functions/get_provinces.php',
        method: 'GET',
        success: function(response) {
            const provinces = JSON.parse(response);
            $('#province').html('<option value="">Chọn Tỉnh/Thành phố</option>');
            provinces.forEach(function(province) {
                const selected = province.TTP_Ma === defaultProvince ? 'selected' : '';
                $('#province').append(`<option value="${province.TTP_Ma}" ${selected}>${province.TTP_Ten}</option>`);
            });

            // Nếu có giá trị tỉnh mặc định, tự động tải quận/huyện
            if (defaultProvince) {
                loadDistricts(defaultProvince, defaultDistrict);
                loadShippingCost(defaultProvince);
            }
        }
    });

    // Tải quận/huyện khi chọn tỉnh/thành phố
    $('#province').change(function() {
        const provinceId = $(this).val();
        loadDistricts(provinceId);
        loadShippingCost(provinceId);
    });

    // Tải phường/xã khi chọn quận/huyện
    $('#district').change(function() {
        const districtId = $(this).val();
        loadWards(districtId);
    });

    // Hàm tải quận/huyện
    function loadDistricts(provinceId, selectedDistrict = "") {
        if (provinceId) {
            $.ajax({
                url: './includes/functions/get_districts.php',
                method: 'GET',
                data: { provinceId: provinceId },
                success: function(response) {
                    const districts = JSON.parse(response);
                    $('#district').html('<option value="">Chọn Quận/Huyện</option>');
                    districts.forEach(function(district) {
                        const selected = district.QH_Ma === selectedDistrict ? 'selected' : '';
                        $('#district').append(`<option value="${district.QH_Ma}" ${selected}>${district.QH_Ten}</option>`);
                    });
                    // Nếu có giá trị quận mặc định, tải phường/xã
                    if (selectedDistrict) {
                        loadWards(selectedDistrict, defaultWard);
                    }
                }
            });
        }
    }

    // Hàm tải phường/xã
    function loadWards(districtId, selectedWard = "") {
        if (districtId) {
            $.ajax({
                url: './includes/functions/get_wards.php',
                method: 'GET',
                data: { districtId: districtId },
                success: function(response) {
                    const wards = JSON.parse(response);
                    $('#ward').html('<option value="">Chọn Phường/Xã/Thị trấn</option>');
                    wards.forEach(function(ward) {
                        const selected = ward.XPTT_Ma === selectedWard ? 'selected' : '';
                        $('#ward').append(`<option value="${ward.XPTT_Ma}" ${selected}>${ward.XPTT_Ten}</option>`);
                    });
                }
            });
        }
    }

    // Hàm tải chi phí vận chuyển
    function loadShippingCost(provinceId) {
        if (provinceId) {
            $.ajax({
                url: './includes/functions/get_shipping_cost.php',
                method: 'GET',
                data: { provinceId: provinceId },
                success: function(response) {
                    const data = JSON.parse(response);
                    $('#shippingCost').text(data.shippingCost + ' VND');
                }
            });
        } else {
            $('#shippingCost').text('0 VND');
        }
    }
});

</script>