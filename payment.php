<?php ob_start(); ?>


<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>


<div class="main-wrapper">

<!-- Begin Hiraola's Header Main Area -->
<?php include('includes/nav_bar.php'); ?>


<?php 
// Kiểm tra xem có dữ liệu 'selected_books' từ form hay không
if (isset($_POST['selected_books'])) {
    $List_Book_ID = [];
    $List_Book_Quanlity = [];
    $List_Book_Price = [];
    $ND_Ma = $_SESSION['ND_Ma'];
    // Lặp qua các mã sách đã chọn và lưu vào mảng S_Ma
    foreach ($_POST['selected_books'] as $bookId) {
        $List_Book_ID[] = $bookId;  // Thêm từng mã sách vào mảng S_Ma
    }
} else {

    echo "<script>
        Swal.fire({
            title: 'Lỗi',
            text: 'Vui lòng chọn sách mà quý khách muốn thanh toán.',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(function() {
            window.location.href = 'cart.php';  // Chuyển hướng về trang cart.php
        });
    </script>";
    exit();  // Dừng thực thi mã PHP tiếp theo
}
?>

<?php 
    $sql_user = "SELECT `ND_HoTen`, `ND_SoDT`, `ND_Email` FROM `nguoidung` WHERE ND_Ma = '$ND_Ma'";
    $result_username = mysqli_query($connection, $sql_user);
    $row_user = mysqli_fetch_array($result_username);



?>

<div class="checkout-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form action="javascript:void(0)">
                            <div class="checkbox-form">
                                <h1>Chi tiết hóa đơn</h1>
                                <hr>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label><h5>Họ và tên người nhận<span class="required">*</span></h5></label>
                                            <input placeholder="" type="text" id="checkout_KH_HoTen" value="<?php echo $row_user['ND_HoTen'] ?>">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label><h5>Email<span class="required">*</span></h5></label>
                                            <input placeholder="" type="email" id="checkout_KH_Email" value="<?php echo $row_user['ND_Email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label><h5>Số điện thoại<span class="required">*</span></h5></label>
                                            <input placeholder=""  id="checkout_KH_SoDienThoai"  type="text" value="<?php echo $row_user['ND_SoDT'] ?>">
                                        </div>
                                    </div>
<hr>
<div class="col-md-12">
    <div class="checkout-form-list">
    <label for="checkout_KM_Ma"><h4>Mã khuyến mãi (Nếu có): </h4></label>
    <input type="text" name="KM_Ma" id="checkout_KM_Ma" placeholder="Nhập mã khuyến mãi">
    </div>
   
</div>




                                    <hr>
<div class="col-md-12">
<div class="sp-content">
    <h4>Giao hàng đến địa chỉ</h4>

<?php 
    $sql_query_default_address = "
        SELECT 
            d.DC_Ma,
            d.DC_SoNha, 
            t.TTP_Ten, 
            q.QH_Ten, 
            x.XPTT_Ten,
            t.TTP_DonGia
        FROM 
            diachi d
        INNER JOIN tinh_thanhpho t ON d.TTP_Ma = t.TTP_Ma
        INNER JOIN quanhuyen q ON d.QH_Ma = q.QH_Ma
        INNER JOIN xa_phuong_thitran x ON d.XPTT_Ma = x.XPTT_Ma
        WHERE 
            d.ND_Ma = '$ND_Ma' AND d.DC_MacDinh = 1
    ";

    // Thực thi câu truy vấn
    $result_query_default_address = mysqli_query($connection, $sql_query_default_address);

    $DC_Ma = "";
    $DC_HienThiChiTiet = "";
    $DC_DonGia = 0;
    // Kiểm tra kết quả
    if (mysqli_num_rows($result_query_default_address) > 0) {
        // Nếu có địa chỉ mặc định, lấy thông tin địa chỉ
        $address = mysqli_fetch_assoc($result_query_default_address);
        $DC_Ma = $address['DC_Ma'];
        $DC_DonGia = $address['TTP_DonGia'];
        $DC_HienThiChiTiet = $address['DC_SoNha'] . ", " . $address['XPTT_Ten'] . ", " . $address['QH_Ten'] . ", " . $address['TTP_Ten'];  
    } 

?>    
    <!-- Radio buttons -->
    <div class="form-check">
        <input class="form-check-input" type="radio" name="addressOption" id="addressOption1" checked>
        <label class="form-check-label" for="addressOption1">
            <span id="diachi_macdinh" DC_Ma="<?php echo $DC_Ma; ?>" VC-DonGia="<?php echo $DC_DonGia; ?>">Địa chỉ mặc định: <?php echo $DC_HienThiChiTiet; ?></span>
        </label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="addressOption" id="addressOption2">
        <label class="form-check-label" for="addressOption2">
            Chọn địa chỉ giao hàng khác
        </label>
    </div>

    <!-- Table for selecting address -->
    <div id="addressSelection" class="mt-3" style="display: none;">
        
        <table class="table">
            
                <tr>
                    <td>
                        <h5>Tỉnh/Thành phố</h5>
                            <select class="form-control" id="province">
                                <option value="" selected disabled>Chọn Tỉnh/Thành phố</option>
                                <!-- Options will be populated by AJAX -->
                            </select>
                        </td>
                </tr>
                <tr>
                    
                    <td>
                        <h5>Quận/Huyện</h5>
                        <select class="form-control" id="district">
                            <option value="" selected disabled>Chọn Quận/Huyện</option>
                            <!-- Options will be populated by AJAX -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    <h5>Phường xã thị trấn</h5>

                        <select class="form-control" id="ward">
                            <option value="" selected disabled>Chọn Phường/Xã/Thị trấn</option>
                            <!-- Options will be populated by AJAX -->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h5>Số nhà, đường </h5>
                        <input type="text" id="houseNumber" class="form-control" placeholder="Nhập số nhà">
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>
</div>
                                    
                                                
                                </div>
                                
                                
                            </div>
                        </form>
                    </div>


                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Đơn hàng</h3>
                            <div class="your-order-table table-responsive"> 

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>Ảnh</strong></th>
                                            <th class="cart-product-name"><strong>Sách x Số lượng</strong></th>
                                            <th class="cart-product-total" style="text-align: right;"><strong>Đơn giá</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 

    $mini_book_lists = [];
    
    foreach($List_Book_ID as $S_Ma) {

        
        $sql_cart = "
            SELECT
                s.S_Ten,
                s.S_HinhAnh,
                gh.GH_SoLuong,
                gny.GNY_DonGia
            FROM
                giohang gh
            JOIN sach s ON
                gh.S_Ma = s.S_Ma
            JOIN gianiemyet gny ON
                gny.S_Ma = s.S_Ma
            WHERE
                gh.KH_Ma = '$ND_Ma' AND gh.S_Ma = '$S_Ma'
            ORDER BY
                gny.GNY_NgayHieuLuc
            DESC
            LIMIT 1
        ";
        $result_cart = mysqli_query($connection, $sql_cart);
        $row_cart = mysqli_fetch_array($result_cart);
        $mini_book_lists[] = $row_cart;

        $List_Book_Quanlity[] = $row_cart['GH_SoLuong'];
        $List_Book_Price[] =   $row_cart['GNY_DonGia'];
    }

?>                                        
<?php 
    $tong_hoa_don = 0;
    foreach($mini_book_lists as $list) { ?>

                              
                                        <tr class="cart_item">
                                            <td><img width="100px" src="<?php echo $list['S_HinhAnh'] ?>" alt=""></td>
                                            <td class="cart-product-name"><?php echo $list['S_Ten'] ?><strong class="product-quantity">
                                            × <?php echo $list['GH_SoLuong'] ?></strong></td>
                                            <td class="cart-product-total" style="text-align: right;"><span class="amount formatMoney" data-amount="<?php echo $list['GNY_DonGia']; ?>"></span></td>
                                        </tr>  
                                        <?php $tong_hoa_don += $list['GH_SoLuong'] * $list['GNY_DonGia']; ?>
<?php    } ?> 
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th colspan="2">Tổng tiền giỏ hàng: </th>
                                            <td style="text-align: right;"><span id="TongTienGioHang" class="amount formatMoney" data-amount="<?php echo $tong_hoa_don; ?>"></span></td>
                                        </tr>
                                        
                                        <tr class="cart-subtotal">
                                            <th colspan="2">Chi phí vận chuyển</th>
                                            <td style="text-align: right;"><span id="shippingCost" class="amount formatMoney" data-amount="<?php echo $DC_DonGia; ?>"></span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th colspan="2">Giảm giá: </th>
                                            <td style="text-align: right;"> <span id="DiscountCost" class="amount formatMoney" data-amount="0"></span></span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th colspan="2">Tổng tiền: </th>
                                            <td style="text-align: right;"><strong><span id="TongTien" class="amount formatMoney" data-amount="0"></span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hàm định dạng tiền VND
        function formatMoney(amount) {
            return new Intl.NumberFormat('vi-VN', { 
                style: 'currency', 
                currency: 'VND' 
            }).format(amount);
        }

        // Hàm tính tổng tiền và cập nhật hiển thị
        function calculateTotal() {
            const cartTotal = parseFloat(document.getElementById('TongTienGioHang').getAttribute('data-amount')) || 0;
            const shippingCost = parseFloat(document.getElementById('shippingCost').getAttribute('data-amount')) || 0;
            const discountCost = parseFloat(document.getElementById('DiscountCost').getAttribute('data-amount')) || 0;

            // Tính tổng tiền
            const total = cartTotal + shippingCost - discountCost;

            // Hiển thị tổng tiền đã định dạng
            const totalElement = document.getElementById('TongTien');
            totalElement.setAttribute('data-amount', total);
            totalElement.textContent = formatMoney(total);
        }

        // Định dạng và hiển thị giá trị ban đầu cho các mục
        function formatInitialValues() {
            const elements = document.querySelectorAll('.formatMoney');
            elements.forEach(function (element) {
                const amount = parseFloat(element.getAttribute('data-amount')) || 0;
                element.textContent = formatMoney(amount);
            });
        }

        // Gọi hàm định dạng các giá trị ban đầu và tính tổng khi trang được tải
        formatInitialValues();
        calculateTotal();

        // Sử dụng MutationObserver để theo dõi sự thay đổi của thuộc tính data-amount của shippingCost
        const shippingCostElement = document.getElementById('shippingCost');
        const observer = new MutationObserver(function (mutationsList) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'data-amount') {
                    calculateTotal();
                    shippingCostElement.textContent = formatMoney(parseFloat(shippingCostElement.getAttribute('data-amount')) || 0);
                }
            }
        });

        // Khởi tạo MutationObserver cho thuộc tính của phần tử shippingCost
        observer.observe(shippingCostElement, { attributes: true });
    });
</script>

                           
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
<?php 

    $sql_hinhthucthanhtoan = "SELECT `HTTT_Ma`, `HTTT_Ten`, `HTTT_MoTa`, `HTTT_TrangThai`, `HTTT_Logo` FROM `hinhthucthanhtoan` WHERE HTTT_TrangThai = 1";
    $result_hinhthucthanhtoan = mysqli_query($connection, $sql_hinhthucthanhtoan);
?>

<?php while($row_hinhthucthanhtoan = mysqli_fetch_array($result_hinhthucthanhtoan) ) { ?>
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                <?php 
                                                $isCOD = "";
                                                if($row_hinhthucthanhtoan['HTTT_Ten'] == "COD") 
                                                    $isCOD = "checked";
                                                ?>
                                                <input id="<?php if($isCOD == "checked")  echo "HTTT_Checked"; ?>" name="payment" httt-ma="<?php echo $row_hinhthucthanhtoan['HTTT_Ma']; ?>" type="radio" class="form-check-input payment-option" <?php echo $isCOD ?>>
    <img width="50px" src="<?php echo $row_hinhthucthanhtoan['HTTT_Logo'] ?>" alt="">
                                                    <a href="javascript:void(0)" class=""  data-target="#<?php echo $row_hinhthucthanhtoan['HTTT_Ma'];?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <?php echo $row_hinhthucthanhtoan['HTTT_Ten'] ?>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="<?php echo $row_hinhthucthanhtoan['HTTT_Ma'];?>"  data-parent="#accordion">
                                                <div class="card-body">
                                                    <p><?php echo $row_hinhthucthanhtoan['HTTT_MoTa'];?></p>
                                                </div>
                                            </div>
                                        </div>
<?php } ?>

<script>
// Lắng nghe sự kiện thay đổi trên các radio buttons có class 'payment-option'
document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('change', function() {
        // Loại bỏ class HTTT_Checked khỏi tất cả các phần tử chứa radio button
        document.querySelectorAll('.payment-option').forEach(item => {
            item.setAttribute('id', '');
        });

        // Nếu radio button này được chọn, thêm class HTTT_Checked vào phần tử chứa radio button
        if (this.checked) {
            this.setAttribute('id', 'HTTT_Checked'); // Thêm class vào phần tử chứa radio button
        }
    });
});


</script>
                                        
                                    </div>

                                    <form action="./includes/invoice/check_payment.php" method="post" id="checkoutForm">

<input type="hidden" name="KH_Ma" id="final_payment_KH_Ma" value="<?php echo $ND_Ma; ?>">
<input type="hidden" name="KH_Email" id="final_payment_KH_Email">
<input type="hidden" name="KH_SoDienThoai" id="final_payment_KH_SoDienThoai">
<input type="hidden" name="isDC_MacDinh" id="final_payment_DC_MacDinh">
<input type="hidden" name="DC_Ma" id="final_payment_DC_Ma">
<input type="hidden" name="TTP_Ma" id="final_payment_TTP_Ma">
<input type="hidden" name="QH_Ma" id="final_payment_QH_Ma">
<input type="hidden" name="XPTT_Ma" id="final_payment_XPTT_Ma">
<input type="hidden" name="DC_SoNha" id="final_payment_DC_SoNha">
<input type="hidden" name="DC_SoTienVanChuyen" id="final_payment_DC_SoTienVanChuyen">
<input type="hidden" name="KM_Ma" id="final_payment_KM_Ma">
<input type="hidden" name="KM_TongSoTien" id="final_payment_KM_TongSoTien">



<input type="hidden" name="submit_HTTT_Ma" id="final_payment_submit_HTTT_Ma">

<!-- Danh sách sách -->
<!-- Danh sách sách -->
<?php foreach ($List_Book_ID as $S_Ma): ?>
    <input type="hidden" name="LIST_BOOK[]" value="<?php echo $S_Ma; ?>">
<?php endforeach; ?>

<?php foreach ($List_Book_Quanlity as $S_SoLuong): ?>
    <input type="hidden" name="List_Book_Quanlity[]" value="<?php echo $S_SoLuong; ?>">
<?php endforeach; ?>

<?php foreach ($List_Book_Price as $S_Price): ?>
    <input type="hidden" name="List_Book_Price[]" value="<?php echo $S_Price; ?>">
<?php endforeach; ?>

<div class="order-button-payment">
    <input value="Đặt hàng" type="submit">
</div>
</form>

<script>
document.getElementById("checkoutForm").addEventListener("submit", function(event) {
// Lấy dữ liệu từ các element và nạp vào các input hidden

document.getElementById("final_payment_KH_Email").value = document.getElementById("checkout_KH_Email").value;
document.getElementById("final_payment_KH_SoDienThoai").value = document.getElementById("checkout_KH_SoDienThoai").value;
document.getElementById("final_payment_KM_Ma").value = document.getElementById("checkout_KM_Ma").value;

// Kiểm tra isDC_MacDinh
const diaChiMacDinhElement = document.getElementById("diachi_macdinh");

if (diaChiMacDinhElement && diaChiMacDinhElement.getAttribute("DC_Ma")) {
    document.getElementById("final_payment_DC_MacDinh").value = "1";
    document.getElementById("final_payment_DC_Ma").value = diaChiMacDinhElement.getAttribute("DC_Ma");
} else {
    document.getElementById("final_payment_DC_MacDinh").value = "0";
    document.getElementById("final_payment_DC_Ma").value = "";
};


document.getElementById('final_payment_submit_HTTT_Ma').value = document.getElementById("HTTT_Checked").getAttribute("httt-ma");



// Lấy thông tin địa chỉ
document.getElementById("final_payment_TTP_Ma").value = document.getElementById("province").value;
document.getElementById("final_payment_QH_Ma").value = document.getElementById("district").value;
document.getElementById("final_payment_XPTT_Ma").value = document.getElementById("ward").value; // nếu có
document.getElementById("final_payment_DC_SoNha").value = document.getElementById("houseNumber").value;

// Chi phí vận chuyển
document.getElementById("final_payment_DC_SoTienVanChuyen").value = document.getElementById("shippingCost").getAttribute('data-amount');

// Chi phí giảm giá
document.getElementById("final_payment_KM_TongSoTien").value = document.getElementById("DiscountCost").getAttribute('data-amount');







});
    </script>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


























<?php include('includes/footer.php'); ?>

<?php ob_end_flush(); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Hàm định dạng tiền VND
function formatMoney(element) {
    const amount = parseFloat(element.getAttribute('data-amount'));
    
    // Kiểm tra nếu amount hợp lệ
    if (!isNaN(amount)) {
        const formattedAmount = new Intl.NumberFormat('vi-VN', { 
            style: 'currency', 
            currency: 'VND' 
        }).format(amount);
        
        // Cập nhật nội dung đã định dạng
        element.textContent = formattedAmount;
    }
}
$(document).ready(function() {
    // Khi radio "Chọn địa chỉ giao hàng" được chọn, hiển thị bảng địa chỉ
    $('input[name="addressOption"]').change(function() {
        if ($('#addressOption2').is(':checked')) {
            $('#addressSelection').show();
            $('#province').attr('data-amount', 0).trigger('change');
            $('#diachi_macdinh').attr('dc_ma', '');
        } else {
            $('#addressSelection').hide();
            var dongia = $('#diachi_macdinh').attr('vc-dongia');
            $('#shippingCost').attr('data-amount', dongia) ;
            $('#diachi_macdinh').attr('dc_ma', '<?php echo $DC_Ma; ?>');
            
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
                    $('#shippingCost')
                        .addClass('formatMoney')
                        .attr('data-amount', data.shippingCost)
                        .each(function() {
                            formatMoney(this); // Gọi hàm định dạng cho phần tử sau khi gán giá trị
                        });

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


<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các phần tử có class 'formatMoney'
    const elements = document.querySelectorAll('.formatMoney');

    // Hàm định dạng tiền VND
    function formatMoney() {
        elements.forEach(function (element) {
            // Lấy giá trị từ data-amount (nếu có) hoặc giá trị hiện tại
            const amount = parseFloat(element.getAttribute('data-amount'));
            
            // Kiểm tra nếu amount hợp lệ
            if (!isNaN(amount)) {
                const formattedAmount = new Intl.NumberFormat('vi-VN', { 
                    style: 'currency', 
                    currency: 'VND' 
                }).format(amount);

                // Hiển thị giá trị đã định dạng
                if (element.tagName === 'INPUT') {
                    element.value = formattedAmount;
                } else {
                    element.textContent = formattedAmount;
                }
            }
        });
    }

    // Gọi hàm formatMoney khi trang tải xong
    formatMoney();

    // Đăng ký sự kiện cho các phần tử input có class 'formatMoney'
    elements.forEach(function (element) {
        if (element.tagName === 'INPUT') {
            // Sự kiện input để cập nhật dữ liệu khi người dùng nhập
            element.addEventListener('input', function () {
                const rawValue = element.value.replace(/[^\d.-]/g, ''); // Loại bỏ ký tự không phải số
                element.setAttribute('data-amount', rawValue);
            });

            // Sự kiện blur và change để áp dụng định dạng khi người dùng kết thúc nhập liệu
            element.addEventListener('blur', formatMoney);
            element.addEventListener('change', formatMoney);
        }
    });
});

</script>