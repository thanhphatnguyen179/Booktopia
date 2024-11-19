<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Thêm phiếu nhập hàng</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="nhaxuatban_all.php">Phiếu nhập hàng</a></li>
                                <li class="breadcrumb-item active">Thêm</li>
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
                                        
                                        <div id="addproduct-nav-pills-wizard" class="twitter-bs-wizard">
                                            <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                                                <li class="nav-item">
                                                    <a href="#basic-info" class="nav-link active" data-toggle="tab">
                                                        <span class="step-number">01</span>
                                                        <span class="step-title">Thông tin cơ bản cho phiếu nhập</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#product-img" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">02</span>
                                                        <span class="step-title">Chi tiết phiếu nhập</span>
                                                    </a>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a href="#metadata" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">03</span>
                                                        <span class="step-title">Xác nhận</span>
                                                    </a>
                                                </li>
                                            </ul>




                                            <div class="tab-content twitter-bs-wizard-tab-content">



<?php 


// Lấy tháng và năm hiện tại
$currentMonth = date('m'); // Tháng (2 chữ số)
$currentYear = date('y'); // 2 chữ số cuối của năm
$prefix = "PN" . $currentMonth . $currentYear;

// Truy vấn để lấy mã phiếu nhập hàng mới nhất theo tháng và năm hiện tại
$sql = "SELECT PNH_Ma FROM phieunhaphang WHERE PNH_Ma LIKE '$prefix%' ORDER BY PNH_Ma DESC LIMIT 1";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Lấy mã phiếu nhập hàng mới nhất
    $row = mysqli_fetch_assoc($result);
    $latestPNH_Ma = $row['PNH_Ma'];

    // Tách phần số cuối và tăng giá trị
    $number = substr($latestPNH_Ma, -4); // Lấy 4 số cuối
    $newNumber = str_pad((int)$number + 1, 4, "0", STR_PAD_LEFT); // Tăng số và giữ định dạng 4 chữ số
    $newPNH_Ma = $prefix . $newNumber;
} else {
    // Nếu chưa có phiếu nhập hàng nào trong tháng và năm hiện tại, bắt đầu với số 0001
    $newPNH_Ma = $prefix . "0001";
}




?>                                            
                                                <div class="tab-pane active" id="basic-info">
                                                                     
                                                    <h4>Mã phiếu nhập hàng: <span style="font-size: 24px; color: red; font-weight :bold;" id="id_final-form-pnh-ma" final-form-pnh-ma="<?php echo $newPNH_Ma ?>"><?php echo $newPNH_Ma ?></span></h4>
                                                    <h3>Nhân viên phụ trách: <span id="id_final-form-nv-ma" final-form-nv-ma="<?php echo $_SESSION['ND_Ma'] ?>"><?php echo $_SESSION['ND_HoTen']; ?></span></h3>
<br>

<div class="col-md-4">
<div class="form-group">
    <label for="kho">Vui lòng chọn kho nhập:</label>
    <select id="kho" name="kho" class="form-control" required final-form-k-id="" final-form-k-ten="">
        <option value="" disabled selected>Chọn kho nhập</option>
        <?php 
        $sql_kho = "SELECT * FROM kho";
        $result_kho = mysqli_query($connection, $sql_kho);

        if ($result_kho) {
            while ($kho = mysqli_fetch_assoc($result_kho)) { // Lặp qua từng dòng kết quả
                $kho_id = $kho['K_Ma'];
                $kho_ten = $kho['K_Ten'];
                echo "<option value='$kho_id' >$kho_ten</option>";
            }
        } else {
            echo "<option value='' disabled>Không có kho nào</option>";
        }
        ?>
    </select>
</div>
</div>
<script>
    // Lắng nghe sự kiện thay đổi lựa chọn trong select
document.getElementById('kho').addEventListener('change', function() {
    // Lấy giá trị của option đã chọn
    var selectedValue = this.value;
    var innerHTML = this.options[this.selectedIndex].innerHTML;
    // Gán giá trị đó vào thuộc tính 'final-form-k-id' của select
    this.setAttribute('final-form-k-id', selectedValue);
    this.setAttribute('final-form-k-ten', innerHTML);
});

</script>

<style>
#searchResults {
    display: none;
    position: absolute;
    z-index: 1000;
    background: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}
/* Container for the dropdown items */
/* Flex container for dropdown items */
/* Container cho item trong dropdown */
/* Cấu trúc item */
.dropdown-item {
    display: flex;
    justify-content: space-between; /* Phân bố các phần tử */
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd; /* Đường viền giữa các item */
    transition: background-color 0.3s ease;
}

/* Hover hiệu ứng khi rê chuột vào item */
.dropdown-item:hover {
    background-color: #f0f0f0;
}

/* Thông tin sách (mã, hình ảnh, tên sách) */
.book-info {
    display: flex;
    align-items: center; /* Căn chỉnh theo chiều ngang */
    flex: 1; /* Cột này chiếm không gian còn lại */
    gap: 20px;
    
}

.book-image {
    width: 50px;
    height: 50px;
    margin-right: 10px;
    object-fit: cover;
    border-radius: 5px;
}

.book-title {
    font-size: 16px;
    color: #333;
    font-weight: 600;
    width: 250px; /* Độ dài cố định cho cột */
    word-wrap: break-word; /* Cho phép chữ xuống hàng khi vượt quá chiều rộng */
    white-space: normal; /* Đảm bảo chữ xuống dòng khi cần thiết */
}

/* Chi tiết sách: tác giả, nhà xuất bản, nhà cung cấp, thể loại */
.book-details {
    display: flex;
    flex-grow: 1; /* Chiếm không gian còn lại */
    justify-content: flex-start;
    margin-left: 20px;
    margin-right: 20px;
    gap: 20px;
}

.book-details span {
    width: 100px;
    font-size: 14px;
    color: #555;
    margin-right: 10px; /* Khoảng cách giữa các phần tử */
    word-wrap: break-word; /* Cho phép chữ xuống hàng khi vượt quá chiều rộng */
    white-space: normal; /* Đảm bảo chữ xuống dòng khi cần thiết */
}

/* Giá sách */
.price {
    font-size: 16px;
    font-weight: bold;
    color: #FF5733; /* Màu nổi bật cho giá */
    min-width: 80px;
    text-align: right;
}

/* Thêm hiệu ứng khi hover vào giá */
.price[s-dongia] {
    cursor: pointer;
}

/* Điều chỉnh cho màn hình nhỏ */
@media (max-width: 768px) {
    .dropdown-item {
        flex-direction: column; /* Đổi thành cột dọc trên màn hình nhỏ */
        align-items: flex-start;
    }

    .book-info {
        margin-bottom: 10px;
    }

    .book-details {
        flex-direction: column;
        margin-left: 0;
    }

    .price {
        text-align: left;
        margin-top: 10px;
    }
}


</style>
                                                </div>
                                                <div class="tab-pane" id="product-img">
                                                    <h4 class="card-title">Chi tiết phiếu nhập hàng</h4>
<div class="row mb-12">
    <div class="col-md-12">
        <input 
            type="text" 
            id="searchInput" 
            class="form-control" 
            placeholder="Tìm kiếm sản phẩm..." 
            autocomplete="off"
        >
        <div id="searchResults" class="dropdown-menu w-100" style="max-height: 300px; overflow-y: auto;"></div>
    </div>

    
</div>

<script>




document.getElementById("searchInput").addEventListener("focus", function () {
    let searchValue = this.value.trim();
    let resultsContainer = document.getElementById("searchResults");

    // Hiển thị tất cả kết quả khi ô input được focus
    resultsContainer.style.display = "block";

    
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./functions/sach/nhaphang_timkiemsach.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Hiển thị kết quả tìm kiếm
                resultsContainer.innerHTML = xhr.responseText;
            }
        };

        xhr.send("search=" + encodeURIComponent(searchValue));
    
});

document.getElementById("searchInput").addEventListener("input", function () {
    let searchValue = this.value.trim();
    let resultsContainer = document.getElementById("searchResults");

    // Gửi yêu cầu AJAX đến server khi người dùng nhập vào ô tìm kiếm
    if (searchValue) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "./functions/sach/nhaphang_timkiemsach.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Hiển thị kết quả tìm kiếm
                resultsContainer.innerHTML = xhr.responseText;
            }
        };

        xhr.send("search=" + encodeURIComponent(searchValue));
    }
});

document.addEventListener("click", function (e) {
    let resultsContainer = document.getElementById("searchResults");
    let searchInput = document.getElementById("searchInput");

    // Nếu người dùng không nhấp vào ô input tìm kiếm hoặc kết quả tìm kiếm, ẩn dropdown
    if (!e.target.closest("#searchInput") && !e.target.closest("#searchResults")) {
        resultsContainer.style.display = "none";
    }
});


    document.getElementById("searchInput").addEventListener("input", function () {
    let searchValue = this.value.trim();
    let resultsContainer = document.getElementById("searchResults");

    // Gửi yêu cầu AJAX đến server
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./functions/sach/nhaphang_timkiemsach.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Hiển thị kết quả
            resultsContainer.innerHTML = xhr.responseText;
            resultsContainer.style.display = "block";
        }
    };

    // Nếu ô tìm kiếm rỗng, yêu cầu tất cả sản phẩm, nếu không tìm kiếm theo từ khóa
    xhr.send("search=" + encodeURIComponent(searchValue)); // Ensure dynamic data is sent here
});


// Ẩn dropdown khi người dùng nhấp ra ngoài
document.addEventListener("click", function (e) {
    let resultsContainer = document.getElementById("searchResults");
    if (!e.target.closest("#searchInput")) {
        resultsContainer.style.display = "none";
    }
});

</script>
    <br>


<script>

function phieunhaphang_themsach(productId) {
    // Tìm phần tử chứa thông tin sản phẩm theo data-id
    let productElement = document.querySelector('.dropdown-item[data-id="' + productId + '"]');
    
    if (productElement) {
        // Lấy thông tin sản phẩm
        let productData = {
            id: productId,
            img: productElement.querySelector('.book-image').src,
            name: productElement.querySelector('.book-title').textContent,
            category: productElement.querySelector('.category').textContent,
            price: parseFloat(productElement.querySelector('.price').getAttribute('s-dongia')) || 0,
            dongianhap_vaokho: 0,
            quantity: 1
        };

        // Kiểm tra giá trị `price`
        if (productData.price <= 0) {
            alert("Giá sản phẩm không hợp lệ.");
            return;
        }

        // Lấy tbody của bảng
        let tableBody = document.querySelector("table tbody");

        // Kiểm tra nếu sản phẩm đã tồn tại trong bảng chưa
        let existingRow = Array.from(tableBody.querySelectorAll('tr')).find(row => {
            let existingName = row.querySelector('h5 a')?.textContent.trim();
            return existingName === productData.name;
        });

        if (existingRow) {
            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: 'Sản phẩm đã được thêm vào phiếu nhập hàng.',
                timer: 2000,
                showConfirmButton: true
            });
            return;
        }

        // Tạo dòng mới nếu sản phẩm chưa tồn tại
        let newRowElement = document.createElement("tr");
        newRowElement.innerHTML = `
            <td>
                <p class="class_final-form-s-ma" final-form-s-ma="${productData.id}" class="font-size-14 text-truncate">${productData.id}</p>
            </td>
            <td>
                <img src="${productData.img}" alt="product-img" class="avatar-md class_final-form-s-hinhanh">
            </td>
            <td>
                <h5 class="font-size-14 text-truncate">
                    <a href="ecommerce-product-detail.html" class="text-dark class_final-form-s-ten">${productData.name}</a>
                </h5>
                <p class="mb-0">Thể loại: <span class="font-weight-medium">${productData.category}</span></p>
            </td>
            <td>
                ₫ ${productData.price.toLocaleString('vi-VN')}
                <input type="hidden" class="dongianhap" value="${productData.price}">
            </td>
            <td>
                <input oninput="formatCurrency(this); updateRowTotal(this)" 
                       form-s-dongianhap_vaokho="0" 
                       type="text" 
                       class="dongianhap_vaokho class_final-form-pnh-dongianhap_vaokho" 
                       value="${productData.dongianhap_vaokho}"
                       final-form-pnh-dongianhap_vaokho=""
                       >
            </td>
            <td>
                <div style="width: 120px;" class="product-cart-touchspin">
                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                        <span class="input-group-btn input-group-prepend">
                            <button class="btn btn-primary bootstrap-touchspin-down" 
                                    type="button" 
                                    onclick="updateQuantity(this, -1)">-</button>
                        </span>
                        <input final-form-pnh-soluongnap_vaokho="1" onchange="updateRowTotal(this)"  data-toggle="touchspin" type="text" value="${productData.quantity}" class="form-control quantity-input class_final-form-pnh-soluongnap_vaokho">
                        <span class="input-group-btn input-group-append">
                            <button class="btn btn-primary bootstrap-touchspin-up" 
                                    type="button" 
                                    onclick="updateQuantity(this, 1)">+</button>
                        </span>
                    </div>
                </div>
            </td>

            <td>
                <span id='row_tongtien'>₫ 0</span>
            <td/>

            <td class="text-center">
                <a href="javascript:void(0);" class="action-icon text-danger" onclick="removeRow(this)">
                    <i class="mdi mdi-trash-can font-size-18"></i>
                </a>
            </td>
        `;

        // Thêm dòng mới vào trong tbody của bảng
        tableBody.appendChild(newRowElement);

        // Cập nhật lại tổng tiền
        updateTotal();
    } else {
        alert('Sản phẩm không tồn tại.');
    }
}
function updateRowTotal(element) {
    // Tìm dòng chứa phần tử đang thay đổi
    let row = element.closest('tr');

    // Lấy giá trị từ các trường liên quan
    let priceInput = row.querySelector('.dongianhap_vaokho');
    let quantityInput = row.querySelector('.quantity-input');
    let rowTotalElement = row.querySelector('#row_tongtien');

    element.setAttribute("final-form-pnh-soluongnap_vaokho", quantityInput.value);
    // Giá nhập kho
    let price = parseFloat(priceInput.getAttribute('form-s-dongianhap_vaokho')) || 0;

    // Số lượng
    let quantity = parseInt(quantityInput.value) || 0;

    // Tính tổng tiền
    let rowTotal = price * quantity;

    // Cập nhật tổng tiền hiển thị
    rowTotalElement.textContent = `₫ ${rowTotal.toLocaleString('vi-VN')}`;

    // Cập nhật tổng tiền toàn bảng (nếu cần)
    updateTotal();
}



 // Hàm định dạng số thành VNĐ
// Hàm định dạng số thành VNĐ với dấu chấm
function formatCurrency(input) {
    let value = input.value.replace(/\D/g, '');  // Loại bỏ tất cả các ký tự không phải là số
    if (value) {
        // Định dạng số theo kiểu VNĐ (ngăn cách 3 chữ số 1 lần bằng dấu chấm)
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        input.value = `₫ ${value}`;  // Hiển thị theo định dạng VNĐ

        // Cập nhật giá trị vào thuộc tính 'form-s-dongianhap_vaokho'
        input.setAttribute('form-s-dongianhap_vaokho', value.replace(/\./g, '')); // Loại bỏ dấu '.' để lưu giá trị số thực
        input.setAttribute('final-form-pnh-dongianhap_vaokho', value.replace(/\./g, '')); // Loại bỏ dấu '.' để lưu giá trị số thực

    } else {
        input.value = '';  // Nếu không có số, để trống
        input.setAttribute('form-s-dongianhap_vaokho', '0'); // Thiết lập giá trị mặc định là 0
        input.setAttribute('final-form-pnh-dongianhap_vaokho', '0'); // Thiết lập giá trị mặc định là 0


    }
}


// Hàm cập nhật tổng tiền
function updateTotal() {
    let tableBody = document.querySelector("table tbody");
    let total = 0;

    // Lặp qua tất cả các dòng trong bảng để tính tổng tiền
    tableBody.querySelectorAll('tr').forEach(row => {
        let priceInput = row.querySelector('.dongianhap_vaokho');
        let quantityInput = row.querySelector('.quantity-input');

        if (priceInput && quantityInput) {
            let price = parseFloat(priceInput.getAttribute('form-s-dongianhap_vaokho')) || 0;
            let quantity = parseInt(quantityInput.value) || 0;

            if (price > 0 && quantity > 0) {
                total += price * quantity;
            }
        }
    });

    // Cập nhật tổng tiền vào phần tử hiển thị
    document.getElementById('total-price-display').textContent = `₫ ${total.toLocaleString('vi-VN')}`;
}



// Hàm xóa dòng
function removeRow(element) {
    let row = element.closest("tr");
    row.remove();

    // Cập nhật lại tổng tiền sau khi xóa
    updateTotal();
}

// Hàm thay đổi số lượng
function updateQuantity(button, increment) {
    let quantityInput = button.closest('.input-group').querySelector('.quantity-input');
    let currentQuantity = parseInt(quantityInput.value) || 0;

    // Cập nhật số lượng mới
    let newQuantity = currentQuantity + increment;
    if (newQuantity < 1) newQuantity = 1; // Không cho phép số lượng nhỏ hơn 1

    quantityInput.value = newQuantity;

    updateRowTotal(quantityInput); // Gọi hàm updateRowTotal để tính lại tổng tiền của dòng
    // Cập nhật tổng tiền sau khi thay đổi số lượng
    updateTotal();
}



// Hàm cập nhật lại tổng tiền khi thay đổi số lượng
document.querySelectorAll(".quantity-input").forEach(input => {
    input.addEventListener('change', function() {
        updateTotal();  // Gọi lại hàm cập nhật tổng tiền khi thay đổi số lượng
    });
});
</script>


   
                                                    <div class="table-responsive">
                                            <table class="table table-centered mb-0 table-nowrap">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Mã sách</th>
                                                        <th style="width: 120px">Hình ảnh</th>
                                                        <th>Tiêu đề sách</th>
                                                        <th>Đơn giá bán lẻ</th>
                                                        <th>Đơn giá nhập</th>
                                                        <th>Số lượng nhập</th>
                                                        
                                                        <th>Tổng tiền</th>
                                                        <th></th>
                                                        <th class="text-center">Xóa</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    
                                                    
                                                    
                                                    
                                                    
                                                </tbody>
                                                
                                            </table>
                                           

                                        </div>                    
        <br>
        <br>
                                        <div class="total-container" style="text-align: right; color: red;">
                                            <h4>Tổng tiền: <span id="total-price-display">₫ 0</span></h4>
                                        </div>


                                                </div>

                                                    
                                                
                                                <div class="tab-pane" id="metadata">
    <!-- Nội dung tab Metadata -->
    <script>
        function collectAndDisplayData() {
            // Lấy giá trị từ các phần tử có ID
            let finalFormPnhMa = document.getElementById('id_final-form-pnh-ma') ? document.getElementById('id_final-form-pnh-ma').getAttribute('final-form-pnh-ma') : 'Không có dữ liệu';
            let finalFormKhoId = document.getElementById('kho') ? document.getElementById('kho').getAttribute('final-form-k-id') : 'Không có dữ liệu';
            let finalFormKhoTen = document.getElementById('kho') ? document.getElementById('kho').getAttribute('final-form-k-ten') : 'Không có dữ liệu';
            let finalFormNvMa = document.getElementById('id_final-form-nv-ma') ? document.getElementById('id_final-form-nv-ma').getAttribute('final-form-nv-ma') : 'Không có dữ liệu';
            let finalFormNvTen = document.getElementById('id_final-form-nv-ma') ? document.getElementById('id_final-form-nv-ma').innerHTML : 'Không có dữ liệu';

            // Lấy tất cả các phần tử có class và lấy thuộc tính 'final-form-*' của chúng
            let finalFormSma = Array.from(document.querySelectorAll('.class_final-form-s-ma')).map(el => el.getAttribute('final-form-s-ma')).join(', ') || 'Không có dữ liệu';
            let finalFormDongianhapVaokho = Array.from(document.querySelectorAll('.class_final-form-pnh-dongianhap_vaokho')).map(el => el.getAttribute('final-form-pnh-dongianhap_vaokho')).join(', ') || 'Không có dữ liệu';
            let finalFormSoluongnapVaokho = Array.from(document.querySelectorAll('.class_final-form-pnh-soluongnap_vaokho')).map(el => el.getAttribute('final-form-pnh-soluongnap_vaokho')).join(', ') || 'Không có dữ liệu';

            // Lấy tất cả các phần tử có class "class_final-form-s-hinhanh" và lấy thuộc tính 'src' của hình ảnh
            let finalFormHinhanh = Array.from(document.querySelectorAll('.class_final-form-s-hinhanh')).map(el => el.src).join(', ') || 'Không có dữ liệu';

            // Lấy tất cả các phần tử có class "class_final-form-s-ten" và lấy 'innerHTML'
            let finalFormTen = Array.from(document.querySelectorAll('.class_final-form-s-ten')).map(el => el.innerHTML).join(', ') || 'Không có dữ liệu';

            const displayContent = `
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><strong>Thông tin</strong></th>
                            <th><strong>Giá trị</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Mã đơn hàng:</strong></td>
                            <td style="color: red; font-size: 16px; font-weight: bold; text-align: center;">${finalFormPnhMa}</td>
                        </tr>
                        <tr>
                            <td><strong>Tên kho nhập vào:</strong></td>
                            <td style="text-align: center;">${finalFormKhoTen}</td>
                        </tr>
                        <tr>
                            <td><strong>Họ tên nhân viên:</strong></td>
                            <td style="text-align: center;">${finalFormNvTen}</td>
                        </tr>
                    </tbody>
                </table>
            `;

            // Hiển thị thông tin ở tab thông tin chung
            const displayContainer = document.getElementById('display-container-xacnhan');
            if (displayContainer) {
                displayContainer.innerHTML = displayContent;
            } else {
                console.error('Không tìm thấy phần tử với id "display-container-xacnhan"');
            }

            // Hiển thị thông tin bảng chi tiết
            let displayContentTable = `
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Mã</th>
                            <th style="text-align: center;">Hình ảnh</th>
                            <th style="text-align: center;">Tên</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: center;">Đơn giá nhập</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            // Lặp qua các giá trị finalFormSma và tạo các dòng bảng cho mỗi phần tử
            finalFormSma.split(', ').forEach((item, index) => {
                // Chuyển đổi giá trị đơn nhập về định dạng VND, ví dụ: 10000 -> đ10,000
                let formattedDongianhap = formatCurrency3(finalFormDongianhapVaokho.split(', ')[index] || '0');

                displayContentTable += `
                    <tr>
                        <td style="text-align: center;">${item}</td>
                        <td style="text-align: center;"><img src="${finalFormHinhanh.split(', ')[index] || ''}" alt="Image" width="50" height="50"></td>
                        <td style="text-align: center;">${finalFormTen.split(', ')[index] || ''}</td>
                        <td style="text-align: center;">${finalFormSoluongnapVaokho.split(', ')[index] || ''}</td>
                        <td style="text-align: center;">${formattedDongianhap}</td>
                    </tr>
                `;
            });

            displayContentTable += `
                    </tbody>
                </table>
            `;

            // Gán nội dung vào phần tử display-container-xacnhan-bang
            const displayContainerBang = document.getElementById('display-container-xacnhan-bang');
            if (displayContainerBang) {
                displayContainerBang.innerHTML = displayContentTable;  // Gán nội dung vào phần tử
            } else {
                console.error('Không tìm thấy phần tử với id "display-container-xacnhan-bang"');
            }

            

                
                // Construct hidden form content
                let form_hidden_content = `
                    <input name="PNH_Ma" value="${finalFormPnhMa}" type="hidden">
                    <input name="NV_Ma" value="${finalFormNvMa}" type="hidden">
                    <input name="K_Ma" value="${finalFormKhoId}" type="hidden">
                `;

                finalFormSma.split(', ').forEach((item, index) => {
                    form_hidden_content += `
                        <input name="S_Ma[]" value="${item}" type="hidden">
                        <input name="CTPNH_SoLuong[]" value="${finalFormSoluongnapVaokho.split(', ')[index]}" type="hidden">
                        <input name="CTPNH_DonGia[]" value="${finalFormDongianhapVaokho.split(', ')[index]}" type="hidden">
                    `;
                });

                // Inject the hidden form content into the form
                const displayform = document.getElementById('input-form');
                if (displayform) {
                    displayform.innerHTML = form_hidden_content;
                } else {
                    console.error('Không tìm thấy phần tử với id "input-form"');
                }
                
        }

        // Hàm định dạng giá trị tiền tệ
        function formatCurrency3(value) {
            let number = parseInt(value, 10);
            if (isNaN(number)) {
                return 'đ0';  // Trường hợp không có giá trị hợp lệ, trả về đ0
            }
            return 'đ' + number.toLocaleString(); // Định dạng số với dấu phân cách hàng nghìn
        }

        // Thêm sự kiện click vào tab
        document.querySelectorAll('.nav-link').forEach(tab => {
            tab.addEventListener('click', function () {
                // Gọi lại hàm collectAndDisplayData khi nhấp vào tab
                collectAndDisplayData();

            });
        });

        // Gọi hàm khi tài liệu đã được tải
        document.addEventListener('DOMContentLoaded', collectAndDisplayData);


        
    </script>

    <h4>Thông tin phiếu nhập hàng</h4>
    <!-- Phần tử hiển thị dữ liệu -->
    <div id="display-container-xacnhan" class="text-center mt-4">
        <!-- Dữ liệu sẽ được hiển thị ở đây -->
    </div>
    <br>
    <h4>Thông tin sách </h4>
    <div id="display-container-xacnhan-bang" class="text-center mt-4">
        <!-- Dữ liệu sẽ được hiển thị ở đây -->
    </div>

    <div class="xacnhan-form">
        <form action="./functions/phieunhaphang/phieunhaphang_add.php" method="POST">
            <div id="input-form">
                <!-- Hidden inputs will be injected here -->
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Xác nhận</button>
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

               
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Nazox.
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

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function validateForm() {
    const NXB_Ten = document.getElementById("NXB_Ten").value.trim();
    
    if (NXB_Ten === "") {
        swal({
            title: "Lỗi",
            text: "Tên nhà xuất bản không được để trống.",
            icon: "error",
            button: "OK",
        });
        return false; // Ngăn form submit
    }
    return true; // Cho phép form submit nếu hợp lệ
}
</script>

<?php
include('includes/footer.php');
?>



<script>
    // Hàm cập nhật giá trị của phần tử với class "previous"
function updatePreviousValue() {
    // Lấy tất cả các phần tử có class "previous"
    let elements = document.querySelectorAll('.previous');

    elements.forEach(element => {
        // Tìm phần tử liền trước trong DOM
        let previousSibling = element.previousElementSibling;

        // Nếu tồn tại phần tử liền trước và nó có giá trị
        if (previousSibling && previousSibling.value !== undefined) {
            // Cập nhật giá trị của phần tử "previous"
            element.value = previousSibling.value;
        }
    });
}

// Gọi hàm khi cần thiết (ví dụ khi tài liệu tải xong hoặc khi có sự kiện)
document.addEventListener('DOMContentLoaded', () => {
    updatePreviousValue();
});

</script>



<script>
    function showData() {
    // Lấy giá trị từ các attribute
    const attributeData = {
        pnhMa: document.getElementById('final-form-pnh-ma').getAttribute('final-form-pnh-ma'),
        kId: document.getElementById('final-form-k-id').getAttribute('final-form-k-id'),
        nvMa: document.getElementById('final-form-nv-ma').getAttribute('final-form-nv-ma')
    };

    // Lấy giá trị từ các mảng
    const arrayData = {
        sMa: document.getElementById('final-form-s-ma').getAttribute('final-form-s-ma'),
        dongianhapVaokho: document.getElementById('final-form-pnh-dongianhap_vaokho').getAttribute('final-form-pnh-dongianhap_vaokho'),
        soluongnapVaokho: document.getElementById('final-form-pnh-soluongnap_vaokho').getAttribute('final-form-pnh-soluongnap_vaokho')
    };

    // Tạo một danh sách HTML để hiển thị kết quả
    const resultList = document.getElementById('result-list');
    resultList.innerHTML = ''; // Xóa danh sách cũ nếu có

    // Thêm thông tin từ các attribute
    resultList.innerHTML += `<li class="list-group-item"><strong>Mã PN:</strong> ${attributeData.pnhMa}</li>`;
    resultList.innerHTML += `<li class="list-group-item"><strong>Mã Kho:</strong> ${attributeData.kId}</li>`;
    resultList.innerHTML += `<li class="list-group-item"><strong>Mã NV:</strong> ${attributeData.nvMa}</li>`;

    // Thêm thông tin từ các mảng
    resultList.innerHTML += `<li class="list-group-item"><strong>Mã Sản phẩm:</strong> ${arrayData.sMa}</li>`;
    resultList.innerHTML += `<li class="list-group-item"><strong>Giá nhập kho:</strong> ${arrayData.dongianhapVaokho}</li>`;
    resultList.innerHTML += `<li class="list-group-item"><strong>Số lượng nhập kho:</strong> ${arrayData.soluongnapVaokho}</li>`;

    // Hiển thị kết quả
    document.getElementById('result-container').style.display = 'block';
}

</script>



