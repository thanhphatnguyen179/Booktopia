<?php ob_start(); ?>


<?php include('includes/db.php'); ?>
<?php include('includes/header.php'); ?>


<div class="main-wrapper">

<!-- Begin Hiraola's Header Main Area -->
<?php include('includes/nav_bar.php'); ?>
<!-- Hiraola's Header Main Area End Here -->


        <!-- Hiraola's Breadcrumb Area End Here -->
        <!-- Begin Hiraola's Cart Area -->


        <?php 
    $ND_Ma = isset($_SESSION['ND_Ma']) ? $_SESSION['ND_Ma'] : "";

    if ($ND_Ma == "") {
        echo '
            <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-12 text-center">
                    <h1>Giỏ hàng của quý khách đang rỗng</h1>
                    <br>
                    <a href="/booktopia/shop.php" class="btn btn-primary btn-lg">Quay lại cửa hàng</a>
                </div>
            </div>';
    
        die();
    }
    
       

    $sql_giohang = "SELECT `KH_Ma`, `S_Ma`, `GH_SoLuong` FROM `giohang` WHERE KH_Ma = '$ND_Ma'";
    $result_giohang = mysqli_query($connection, $sql_giohang);
    
?>

<?php if (mysqli_num_rows($result_giohang) == 0) {


        echo '
                    <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                        <div class="col-12 text-center">
                            <h1>Giỏ hàng của quý khách đang rỗng</h1>
                            <br>
                            <a href="/booktopia/shop.php" class="btn btn-primary btn-lg">Quay lại cửa hàng</a>
                        </div>
                    </div>';
            
                die();

} ?>

        <div class="hiraola-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="javascript:void(0)">
                            <div class="table-content table-responsive">

<form action="./includes/functions/update_cart.php" method="post">                         
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="hiraola-product-select">
                                                <input type="checkbox"   id="selectAll" checked="" />
                                            </th>
                                            <th class="hiraola-product-thumbnail">Hình ảnh</th>
                                            <th class="cart-product-name">Tên sách</th>
                                            <th class="cart-product-name">Đơn giá</th>
                                            <th class="hiraola-product-quantity">Số lượng</th>
                                            <th class="hiraola-product-price">Thành tiền</th>
                                            <th class="hiraola-product-remove">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php while($row_giohang = mysqli_fetch_array($result_giohang)){

$S_Ma = $row_giohang['S_Ma']; // Mã sách
$GH_SoLuong = $row_giohang['GH_SoLuong']; // Số lượng

// Lấy thông tin sách từ bảng sản phẩm
$sql_sach = "SELECT `S_Ten`, `S_HinhAnh` FROM `sach` WHERE S_Ma = '$S_Ma'";
$result_sach = mysqli_query($connection, $sql_sach);
$row_sach = mysqli_fetch_array($result_sach);

$S_Ten = $row_sach['S_Ten']; // Tên sách
$S_HinhAnh = $row_sach['S_HinhAnh']; // Hình ảnh sách


$sql_giasach = "SELECT  `GNY_DonGia` FROM `gianiemyet` WHERE S_Ma = '$S_Ma' ORDER BY GNY_NgayHieuLuc DESC";
$result_dongia = mysqli_query($connection, $sql_giasach);
$row_dongia = mysqli_fetch_array($result_dongia);

$S_DonGia = $row_dongia['GNY_DonGia'];

?>
                                     
                                     <tr id="book-<?php echo $S_Ma; ?>"> <!-- Cập nhật id của tr bằng mã sách -->
    <td class="hiraola-product-select">
        <input type="checkbox" class="productSelect checked" checked=""/>
    </td>
    <td class="hiraola-product-thumbnail">
        <a href="/booktopia/book.php?bookid=<?php echo $S_Ma; ?>">
            <img src="<?php echo $S_HinhAnh ?>" width="100px" alt="Hiraola's Cart Thumbnail">
        </a>
    </td>
    <td class="hiraola-product-name">
        <a href="/booktopia/book.php?bookid=<?php echo $S_Ma; ?>"><?php echo $S_Ten; ?></a>
    </td>
    <td class="product-price"><span class="amount formatMoney" data-amount=<?php echo $S_DonGia; ?> ></span></td>
    <td class="quantity">
        <div class="cart-plus-minus">
            <input name="quantity[ <?php echo $S_Ma; ?> ]" class="cart-plus-minus-box" value="<?php echo $GH_SoLuong ?>" type="text" >
            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
        </div>
    </td>
    <td class="product-subtotal"><span class="amount formatMoney" data-amount=<?php echo $S_DonGia * $GH_SoLuong; ?> onchange="formatMoney()"></span></td>
    <td class="hiraola-product-remove">
        <a href="javascript:void(0)">
            <i class="fa fa-trash" title="Remove"></i>
        </a>
    </td>
</tr>

<?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        
                                        <div class="coupon2">
                                            <input hidden class="button" name="update_cart" value="Cập nhật giỏ hàng" type="button" id="update-cart-btn" onclick="updateCartAJAX(true)">
                                        </div>
                                    </div>
                                </div>
                            </div>
</form>  


<script>
function updateCartAJAX(isNotification) {
    event.preventDefault();  // Ngăn chặn hành động mặc định của nút

    var quantities = {};  // Chứa số lượng sản phẩm cần cập nhật

    // Lặp qua tất cả các sản phẩm trong giỏ hàng và thu thập số lượng
    document.querySelectorAll('.cart-plus-minus-box').forEach(function(input) {
        var productId = input.name.replace('quantity[', '').replace(']', '');  // Lấy mã sản phẩm từ name
        var quantity = input.value;  // Lấy số lượng người dùng nhập
        quantities[productId] = quantity;  // Lưu số lượng vào đối tượng quantities
    });

    // Gửi dữ liệu AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './includes/functions/update_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Chuyển đối tượng quantities thành chuỗi query string
    var data = 'quantities=' + encodeURIComponent(JSON.stringify(quantities));

    // Xử lý phản hồi từ server
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                // Kiểm tra xem phản hồi có phải là chuỗi JSON hợp lệ không
                var response = JSON.parse(xhr.responseText); // Nhận phản hồi từ server
                
                // Nếu isNotification là true, hiển thị thông báo SweetAlert2
                if (isNotification) {
                    Swal.fire({
                        title: 'Thông báo',
                        text: response.message,  // In ra thông báo từ PHP
                        icon: 'success',  // Có thể thay đổi icon nếu cần
                        confirmButtonText: 'OK'
                    });
                }

            } catch (e) {
                console.error("JSON parsing error: ", e, xhr.responseText); // Xử lý lỗi nếu phản hồi không hợp lệ
                
                // Nếu isNotification là true, hiển thị thông báo lỗi
                if (isNotification) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Đã xảy ra lỗi trong quá trình xử lý dữ liệu.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        } else {
            console.error("AJAX Error:", xhr.statusText);
            
            // Nếu isNotification là true, hiển thị thông báo lỗi
            if (isNotification) {
                Swal.fire({
                    title: 'Lỗi',
                    text: 'Không thể kết nối với máy chủ.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
    };

    // Gửi dữ liệu
    xhr.send(data);
}

</script>
    </form>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Tổng tiền: <span id="total" class="formatMoney" data-amount></span></h2>
<form id="checkoutForm" action="./payment.php" method="post">
    


    <button style="background-color: #cda557; border-color: #cda557;" class="btn btn-info btn-lg btn-block shadow-sm" type="submit" id="submitBtnEnabled">Tiến hành thanh toán</button>

</form>
<script>
document.querySelectorAll('.productSelect').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        // Kiểm tra xem có ít nhất một checkbox được chọn không
        var anyChecked = document.querySelectorAll('.productSelect:checked').length > 0;

        // Lấy checkbox 'selectAll' và kiểm tra trạng thái của nó
        var selectAll = document.getElementById('selectAll');

        // Lấy nút thanh toán
        var submitBtn = document.getElementById('submitBtnEnabled');

        // Kiểm tra nếu có ít nhất một checkbox được chọn hoặc checkbox 'selectAll' được chọn
        if (anyChecked || selectAll.checked) {
            // Nếu có ít nhất một checkbox được chọn hoặc selectAll được chọn
            submitBtn.classList.remove('disabled');   // Loại bỏ class 'disabled'
            submitBtn.removeAttribute('disabled');   // Loại bỏ thuộc tính 'disabled'
            submitBtn.style.pointerEvents = 'auto';   // Cho phép nút submit có thể click
        } else {
            // Nếu không có checkbox nào được chọn và selectAll không được chọn
            submitBtn.classList.add('disabled');     // Thêm class 'disabled'
            submitBtn.setAttribute('disabled', 'true'); // Thêm thuộc tính 'disabled'
            submitBtn.style.pointerEvents = 'none';   // Vô hiệu hóa khả năng click
        }
    });
});

// Thêm sự kiện cho checkbox 'selectAll' để cập nhật trạng thái khi thay đổi
document.getElementById('selectAll').addEventListener('change', function() {
    // Kiểm tra lại trạng thái sau khi thay đổi checkbox "selectAll"
    var anyChecked = document.querySelectorAll('.productSelect:checked').length > 0;
    var selectAll = document.getElementById('selectAll');
    var submitBtn = document.getElementById('submitBtnEnabled');

    if (anyChecked || selectAll.checked) {
        submitBtn.classList.remove('disabled');
        submitBtn.removeAttribute('disabled');
        submitBtn.style.pointerEvents = 'auto';   // Cho phép nút submit có thể click
    } else {
        submitBtn.classList.add('disabled');
        submitBtn.setAttribute('disabled', 'true');
        submitBtn.style.pointerEvents = 'none';   // Vô hiệu hóa khả năng click
    }
});

</script>


<script>
    document.querySelector('#checkoutForm').addEventListener('submit', function(event) {
    

    var selectedBooks = [];  // Mảng chứa các mã sách đã chọn

    // Lấy tất cả các checkbox đã chọn
    document.querySelectorAll('input.productSelect:checked').forEach(function(checkbox) {
        var row = checkbox.closest('tr');  // Tìm hàng tr chứa checkbox
        var bookId = row.id.replace('book-', '');  // Lấy id của tr (mã sách)

        selectedBooks.push(bookId);  // Thêm mã sách vào mảng
    });
    // Nếu có sách được chọn, tạo các trường ẩn cho mỗi mã sách và thêm vào form
    if (selectedBooks.length > 0) {
        // Xóa các trường ẩn cũ nếu có
        var hiddenInputs = document.querySelectorAll('#checkoutForm input[type="hidden"]');
        hiddenInputs.forEach(function(input) {
            input.remove();
        });

        // Thêm các mã sách đã chọn vào form dưới dạng các trường ẩn
        selectedBooks.forEach(function(bookId) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_books[]';  // Tên của trường này sẽ là mảng 'selected_books'
            input.value = bookId;  // Giá trị là mã sách
            document.querySelector('#checkoutForm').appendChild(input);
        });

        // Gửi form sau khi thêm các trường ẩn
        document.querySelector('#checkoutForm').submit();
    } else {
        // Sử dụng SweetAlert2 thay thế alert
        Swal.fire({
            title: 'Lỗi',
            text: 'Vui lòng chọn ít nhất một quyển sách để thanh toán.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    }
    
});

</script>                                        
                                       


                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Cart Area End Here -->

        </div>


<?php include('includes/footer.php'); ?>

<?php ob_end_flush(); ?>








<script>







document.querySelectorAll('.inc.qtybutton, .dec.qtybutton').forEach(button => {
    button.addEventListener('click', function () {
        const quantityInput = button.parentElement.querySelector('.cart-plus-minus-box');
        let quantity = parseInt(quantityInput.value);
        const row = button.closest('tr');
        const unitPrice = parseFloat(row.querySelector('.product-price .amount').getAttribute('data-amount')); // Đơn giá
        const rowTotalElement = row.querySelector('.product-subtotal .amount'); // Phần tử chứa tổng giá trị

        // Cập nhật giá trị số lượng
        quantityInput.value = quantity;

        // Tính toán tổng giá trị (số lượng * đơn giá)
        const total = quantity * unitPrice;

        // Cập nhật giá trị cho thuộc tính data-amount và nội dung hiển thị
        rowTotalElement.setAttribute('data-amount', total); // Cập nhật giá trị trong data-amount
        rowTotalElement.textContent = formatCurrency(total);
        
        updateCartAJAX(false);
        updateCartTotal() ;
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
        updateCartAJAX(false);
        updateCartTotal(); // Cập nhật tổng giỏ hàng
    });
});


// Hàm định dạng số tiền VND
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
}


// Hàm cập nhật tổng giỏ hàng
function updateCartTotal() {
    let total = 0;
    
    // Lặp qua tất cả các checkbox có lớp 'productSelect'
    document.querySelectorAll('.productSelect').forEach(checkbox => {
        // Kiểm tra nếu checkbox đã được chọn và có class 'checked'
        if (checkbox.classList.contains('checked')) {
            // Lấy dòng (tr) chứa checkbox
            const row = checkbox.closest('tr');
            if (row) {
                // Lấy giá trị amount từ thuộc tính data-amount
                const amount = parseFloat(row.querySelector('.product-subtotal .amount').getAttribute('data-amount')) || 0;
                total += amount; // Cộng tổng vào biến total
            }
        }
    });

    // Cập nhật tổng giỏ hàng
    const cartTotal = document.querySelector('#total');
    cartTotal.setAttribute('data-amount', total);
    cartTotal.textContent = formatCurrency(total);
}

// Hàm để cập nhật trạng thái của checkbox khi thay đổi
function toggleCheckboxState(event) {
    const checkbox = event.target;
    
    if (checkbox.checked) {
        checkbox.classList.add('checked'); // Thêm class 'checked' khi checkbox được chọn
    } else {
        checkbox.classList.remove('checked'); // Loại bỏ class 'checked' khi checkbox không được chọn
    }

    updateCartTotal(); // Cập nhật lại tổng giỏ hàng
    updateSelectAllState(); // Cập nhật lại trạng thái của checkbox "select all"
}

// Hàm kiểm tra và cập nhật trạng thái của checkbox "select all"
function updateSelectAllState() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const allCheckboxes = document.querySelectorAll('.productSelect');
    
    // Kiểm tra nếu tất cả checkbox đã được chọn
    const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);
    
    // Nếu tất cả các checkbox được chọn thì select all sẽ được chọn, ngược lại bỏ chọn
    selectAllCheckbox.checked = allChecked;
    
    // Thêm hoặc bỏ class 'selected' cho selectAllCheckbox tùy vào trạng thái
    if (allChecked) {
        selectAllCheckbox.classList.add('selected'); // Thêm class 'selected' nếu tất cả checkbox đã được chọn
        
    } else {
        selectAllCheckbox.classList.remove('selected'); // Loại bỏ class 'selected' nếu không tất cả đã được chọn
        
    }
}

// Thêm sự kiện click cho các checkbox
document.querySelectorAll('.productSelect').forEach(checkbox => {
    checkbox.addEventListener('change', toggleCheckboxState);
});

// Xử lý select all
const selectAllCheckbox = document.getElementById('selectAll');
selectAllCheckbox.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.productSelect');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked; // Đặt trạng thái checkbox dựa trên select all
        // Thêm hoặc loại bỏ class 'checked' cho từng checkbox
        if (checkbox.checked) {
            checkbox.classList.add('checked');
        } else {
            checkbox.classList.remove('checked');
        }
    });

    updateCartTotal(); // Cập nhật lại tổng giỏ hàng sau khi select all
    // Cập nhật trạng thái của select all
    updateSelectAllState();
});


</script>
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
    document.addEventListener('DOMContentLoaded', function() {
    updateCartTotal();  // Update total on page load
});
</script>



<script>
document.querySelectorAll('.hiraola-product-remove a').forEach(removeButton => {
    removeButton.addEventListener('click', function () {
        const row = removeButton.closest('tr'); // Lấy dòng sản phẩm tương ứng
        confirmRemoveItem(row);
    });
});

function confirmRemoveItem(row) {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa mặt hàng này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Vâng, xóa nó!'
    }).then((result) => {
        if (result.isConfirmed) {
            row.remove(); // Xóa dòng sản phẩm khỏi giỏ hàng
            updateCartTotal(); // Cập nhật lại tổng giỏ hàng
        }
    });
}
</script>


<?php 


?>



