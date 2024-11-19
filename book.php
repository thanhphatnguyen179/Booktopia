
<?php ob_start(); ?>




<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>
<head>
    <style>
        .don_gia_sach h3{

            font-size: 16px;
            margin-top: 20px;
            /* font-size: 20px; */
        }
    </style>
    <style>
        .tong_tien_tam_tinh span {
            color: red;
            margin-top: 20px;

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
                    <div class="col-lg-4 col-md-5">
    <div class="sp-img_area">
        <div class="zoompro-border">
            <img class="img-fluid zoompro" src="<?php echo $S_HinhAnh; ?>" data-zoom-image="<?php echo $S_HinhAnh; ?>" alt="<?php echo $S_Ten; ?>" />
        </div>
    </div>
    <form id="addToCartForm" action="" method="post">

    <div class="d-flex mt-4">
        <!-- Add to Cart Button -->
        <button type="button" class="btn btn-outline-primary mr-2 flex-fill" style="color: #cda557; border-color: #cda557;" 
        onmouseover="this.style.backgroundColor='#f1e0c7'; this.style.color='#5a4a2f';" 
        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#cda557';"  onclick="addToCart()">
            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
        </button>

        <!-- Buy Now Button -->
        <button type="button" class="btn btn-primary  flex-fill" style="background-color: #cda557; border-color: #cda557; color: #fff;" 
        onmouseover="this.style.backgroundColor='#b59445';" 
        onmouseout="this.style.backgroundColor='#cda557';"  onclick="buyNow()">
            <i class="fas fa-bolt"></i> Mua ngay
        </button>
    </div>
</div>
 <!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function addToCart() {
        const form = document.getElementById("addToCartForm");
        const formData = new FormData(form);

        // Tạo yêu cầu AJAX với JavaScript thuần
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./includes/cart/cart_add.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: response.message,
                        showConfirmButton: true
                    });
                }
            }
        };
        xhr.send(formData);
    }

    function buyNow() {
        Swal.fire({
            icon: 'info',
            title: 'Mua ngay!',
            text: 'Bạn đang tiến hành mua sản phẩm này.',
            showConfirmButton: true,
            confirmButtonText: 'Tiếp tục'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'checkout.php';
            }
        });
    }
</script>



                        <div class="col-lg-8 col-md-7">
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
                                    <input type="hidden" name="S_Ma" value="<?php echo $_GET['bookid']; ?>">
                                    <input type="hidden" name="ND_Ma" value="<?php echo $_SESSION['ND_Ma']; ?>">

                                    <label>Số lượng</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1" type="text" name="S_SoLuong">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>


                                

                                <div class="don_gia_sach">
                                    <h3><span>Đơn giá bán: </span><span id="don_gia" class="amount formatMoney" data-amount=<?php echo $S_DonGia; ?> ></span></h3>
                                </div>

                                <br>
                                </form>

                                <div class="tong_tien_tam_tinh">
                                    <h3>Tổng tiền tạm tính: <span id="tongtien" class="amount formatMoney" data-amount=<?php echo $S_DonGia; ?> ></span></h3>
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="sp-content">
    <h4>Giao hàng đến địa chỉ</h4>

    <!-- Radio buttons -->
    <div class="form-check">
        <input class="form-check-input" type="radio" name="addressOption" id="addressOption1" checked>
        <label class="form-check-label" for="addressOption1">
            Địa chỉ
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="addressOption" id="addressOption2">
        <label class="form-check-label" for="addressOption2">
            Chọn địa chỉ giao hàng
        </label>
    </div>

    <!-- Table for selecting address -->
    <div id="addressSelection" class="mt-3" style="display: none;">
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
                        <select class="form-control" id="province">
                            <option value="" selected disabled>Chọn Tỉnh/Thành phố</option>
                            <!-- Options will be populated by AJAX -->
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="district">
                            <option value="" selected disabled>Chọn Quận/Huyện</option>
                            <!-- Options will be populated by AJAX -->
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="ward">
                            <option value="" selected disabled>Chọn Phường/Xã/Thị trấn</option>
                            <!-- Options will be populated by AJAX -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <label for="houseNumber">Số nhà</label>
                        <input type="text" id="houseNumber" class="form-control" placeholder="Nhập số nhà">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <h3>Chi phí vận chuyển: <span id="shippingCost" style="color:red;"></span></h3> 
        </div>
        
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Khi radio "Chọn địa chỉ giao hàng" được chọn, hiển thị bảng địa chỉ
    $('input[name="addressOption"]').change(function() {
        if ($('#addressOption2').is(':checked')) {
            $('#addressSelection').show();
        } else {
            $('#addressSelection').hide();
        }
    });

    // Lấy các tỉnh/thành phố khi trang được tải
    $.ajax({
        url: './includes/functions/get_provinces.php',  // URL PHP để lấy danh sách tỉnh thành
        method: 'GET',
        success: function(response) {
            const provinces = JSON.parse(response);
            $('#province').html('<option>Chọn Tỉnh/Thành phố</option>');
            provinces.forEach(function(province) {
                $('#province').append('<option value="' + province.TTP_Ma + '">' + province.TTP_Ten + '</option>');
            });
        }
    });

    // Lấy các quận/huyện khi chọn tỉnh/thành phố
    $('#province').change(function() {
        const provinceId = $(this).val();
        if (provinceId) {
            // Gọi AJAX để lấy đơn giá vận chuyển cho tỉnh này
            $.ajax({
                url: './includes/functions/get_shipping_cost.php',
                method: 'GET',
                data: { provinceId: provinceId },
                success: function(response) {
                    const data = JSON.parse(response);
                    // Hiển thị chi phí vận chuyển
                    $('#shippingCost').text(data.shippingCost + ' VND');
                }
            });

            // Gọi AJAX để lấy quận/huyện mới
            $.ajax({
                url: './includes/functions/get_districts.php',
                method: 'GET',
                data: { provinceId: provinceId },
                success: function(response) {
                    const districts = JSON.parse(response);
                    $('#district').html('<option>Chọn Quận/Huyện</option>');
                    districts.forEach(function(district) {
                        $('#district').append('<option value="' + district.QH_Ma + '">' + district.QH_Ten + '</option>');
                    });
                }
            });
        } else {
            // Nếu không có tỉnh, reset tất cả các dropdown còn lại
            $('#district').html('<option value="" selected disabled>Chọn Quận/Huyện</option>');
            $('#ward').html('<option value="" selected disabled>Chọn Phường/Xã/Thị trấn</option>');
            $('#shippingCost').text('Chi phí vận chuyển:');  // Clear shipping cost
        }
    });

    // Lấy các phường/xã khi chọn quận/huyện
    $('#district').change(function() {
        const districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: './includes/functions/get_wards.php',  // URL PHP để lấy danh sách phường xã
                method: 'GET',
                data: { districtId: districtId },
                success: function(response) {
                    const wards = JSON.parse(response);
                    $('#ward').html('<option>Chọn Phường/Xã/Thị trấn</option>');
                    wards.forEach(function(ward) {
                        $('#ward').append('<option value="' + ward.XPTT_Ma + '">' + ward.XPTT_Ten + '</option>');
                    });
                }
            });
        } else {
            // Nếu không có quận, reset lại phường/xã/ thị trấn
            $('#ward').html('<option value="" selected disabled>Chọn Phường/Xã/Thị trấn</option>');
        }
    });
});

</script>
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



        =
        

        </div>

<?php include('includes/footer.php'); ?>

<?php ob_end_flush(); ?>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các phần tử có class 'formatMoney'
    const elements = document.querySelectorAll('.formatMoney');
    
    // Hàm định dạng tiền VND
    function formatMoney() {
        // Duyệt qua tất cả các phần tử và áp dụng định dạng tiền VND
        elements.forEach(function (element) {
            // Lấy giá trị tiền trong phần tử (giả sử giá trị trong thuộc tính data-amount)
            const amount = parseFloat(element.getAttribute('data-amount'));
            
            // Kiểm tra nếu amount hợp lệ
            if (!isNaN(amount)) {
                // Định dạng tiền VND
                element.textContent = new Intl.NumberFormat('vi-VN', { 
                    style: 'currency', 
                    currency: 'VND' 
                }).format(amount);
            }
        });
    }

    // Gọi hàm formatMoney khi trang tải xong
    formatMoney();

    // Đăng ký sự kiện onchange cho các phần tử input hoặc các phần tử có class 'formatMoney'
    elements.forEach(function (element) {
        element.addEventListener('input', function () {
            // Cập nhật giá trị mới vào thuộc tính data-amount
            element.setAttribute('data-amount', element.value);
            // Gọi lại hàm để định dạng tiền sau khi cập nhật giá trị
            formatMoney();
        });

        // Nếu bạn muốn cập nhật khi giá trị bị thay đổi sau khi người dùng hoàn thành nhập, có thể sử dụng sự kiện change hoặc blur
        element.addEventListener('change', function () {
            element.setAttribute('data-amount', element.value);
            formatMoney(); // Cập nhật định dạng khi giá trị thay đổi
        });

        element.addEventListener('blur', function () {
            element.setAttribute('data-amount', element.value);
            formatMoney(); // Cập nhật định dạng khi trường input bị bỏ đi
        });
    });
});

</script>



<script>
    

document.querySelectorAll('.inc.qtybutton, .dec.qtybutton').forEach(button => {
    button.addEventListener('click', function () {
        const quantityInput = button.parentElement.querySelector('.cart-plus-minus-box');
        let quantity = parseInt(quantityInput.value);
        
        const unitPrice = parseFloat(getElementById('don_gia').getAttribute('data-amount')); // Đơn giá
        const TotalElement = getElementById('tongtien');

        // Cập nhật giá trị số lượng
        quantityInput.value = quantity;

        // Tính toán tổng giá trị (số lượng * đơn giá)
        const total = quantity * unitPrice;

        // Cập nhật giá trị cho thuộc tính data-amount và nội dung hiển thị
        TotalElement.setAttribute('data-amount', total); // Cập nhật giá trị trong data-amount
        TotalElement.textContent = formatCurrency(total);
        
    });                               
    
});
// Thêm sự kiện onchange cho quantityInput
document.querySelectorAll('.cart-plus-minus-box').forEach(quantityInput => {
    quantityInput.addEventListener('change', function () {
        let quantity = parseInt(quantityInput.value);

        // Kiểm tra và đảm bảo giá trị là số nguyên dương
        if (isNaN(quantity) || quantity <= 0) {
            quantity = 1; // Nếu giá trị không hợp lệ, mặc định về 1
            quantityInput.value = quantity; // Cập nhật lại giá trị
        }

        const row = quantityInput.closest('tr');
        const unitPrice = parseFloat(row.querySelector('.product-price .amount').getAttribute('data-amount')); // Đơn giá
        const rowTotalElement = row.querySelector('.product-subtotal .amount'); // Phần tử chứa tổng giá trị

        // Cập nhật giá trị số lượng
        quantityInput.value = quantity;

        // Tính toán tổng giá trị (số lượng * đơn giá)
        const total = quantity * unitPrice;

        // Cập nhật giá trị cho thuộc tính data-amount và nội dung hiển thị
        rowTotalElement.setAttribute('data-amount', total); // Cập nhật giá trị trong data-amount
        rowTotalElement.textContent = formatCurrency(total);
        
        
    });
});


// Hàm định dạng số tiền VND
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
}
</script>