<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Lấy giá trị HD_Ma từ tham số GET hoặc POST (tuỳ vào yêu cầu)
$HD_Ma = isset($_GET['HD_Ma']) ? mysqli_real_escape_string($connection, $_GET['HD_Ma']) : null;

if ($HD_Ma) {
    // Truy vấn dữ liệu từ bảng hoadon
    $query = "SELECT `HD_Ma`, `HD_NgayLap`, `HD_TongTien`, `KH_Ma`, `NV_Ma`, `KM_ID`, `DC_Ma`, `TT_Ma`, `HTTT_Ma` FROM `hoadon` WHERE `HD_Ma` = '$HD_Ma'";
    $result = mysqli_query($connection, $query);

    // Kiểm tra kết quả truy vấn
    if ($result && mysqli_num_rows($result) > 0) {
        // Lấy dữ liệu từ kết quả truy vấn
        $row = mysqli_fetch_assoc($result);

        // Lưu dữ liệu vào các biến PHP
        $hoadon_HD_Ma = $row['HD_Ma'];
        $hoadon_HD_NgayLap = $row['HD_NgayLap'];
        $hoadon_HD_TongTien = $row['HD_TongTien'];
        $hoadon_KH_Ma = $row['KH_Ma'];
        $hoadon_NV_Ma = $row['NV_Ma'];
        $hoadon_KM_ID = $row['KM_ID'];
        $hoadon_DC_Ma = $row['DC_Ma'];
        $hoadon_TT_Ma = $row['TT_Ma'];
        $hoadon_HTTT_Ma = $row['HTTT_Ma'];
    } else {
        echo "Không tìm thấy hóa đơn với mã $HD_Ma.";
    }
} else {
    echo "Không có mã hóa đơn được cung cấp.";
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chỉnh sửa hóa dơn</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="chude_all.php">Hóa dơn</a></li>
                                <li class="breadcrumb-item active">Chỉnh sửa</li>
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
                                                        <span class="step-title">Thông tin cơ bản của hóa đơn</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#product-img" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">02</span>
                                                        <span class="step-title">Chi tiết hóa đơn</span>
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



                                            
                                                <div class="tab-pane active" id="basic-info">
                                                                     
                                                    <h4>Mã phiếu nhập hàng: <span style="font-size: 24px; color: red; font-weight :bold;" ><?php echo $HD_Ma; ?></span></h4>
                                                    <h3>Nhân viên phụ trách: <span ><?php echo $hoadon_NV_Ma; ?></span></h3>
<br>




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
                                                    <h4 class="card-title">Chi tiết hóa đơn</h4>



 



                                                    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        border: 1px solid #dee2e6;
    }

    .table thead th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .avatar-md {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>


   
                                                    <div class="table-responsive">
                                            <table class="table table-centered mb-0 table-nowrap">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Mã sách</th>
                                                        <th style="width: 120px">Hình ảnh</th>
                                                        <th>Tiêu đề sách</th>
                                                        <th>Đơn giá bán lẻ</th>
                                                        
                                                        <th>Số lượng nhập</th>
                                                        
                                                        <th>Tổng tiền</th>
                                                        <th>Hành động</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                <?php 
        // Truy vấn dữ liệu từ bảng chitiethd
        $sql_chitiethoadon = "SELECT `HD_Ma`, `S_Ma`, `CTHD_SoLuong`, `CTHD_DonGia` FROM `chitiethd` WHERE `HD_Ma` = '$HD_Ma'";
        $result = mysqli_query($connection, $sql_chitiethoadon);

        // Kiểm tra nếu có kết quả trả về
        if ($result && mysqli_num_rows($result) > 0) {
            // Duyệt qua từng hàng dữ liệu bằng vòng lặp while
            while ($row = mysqli_fetch_assoc($result)) {
                // Lưu dữ liệu từng hàng vào các biến
                $chitiethd_HD_Ma = $row['HD_Ma'];
                $chitiethd_S_Ma = $row['S_Ma'];
                $chitiethd_SoLuong = $row['CTHD_SoLuong'];
                $chitiethd_DonGia = $row['CTHD_DonGia'];

                // Tính tổng tiền cho sản phẩm
                $tongTien = $chitiethd_SoLuong * $chitiethd_DonGia;

                // Truy vấn thông tin từ bảng sach
                $sql_sach_show = "SELECT `S_Ten`, `S_HinhAnh` FROM `sach` WHERE `S_Ma` = '$chitiethd_S_Ma'";
                $sach_result = mysqli_query($connection, $sql_sach_show);

                if ($sach_result && mysqli_num_rows($sach_result) > 0) {
                    $sach_row = mysqli_fetch_assoc($sach_result);
                    $sach_Ten = $sach_row['S_Ten'];
                    $sach_HinhAnh = $sach_row['S_HinhAnh'];
                } else {
                    $sach_Ten = "Không tìm thấy tên sách";
                    $sach_HinhAnh = "placeholder.jpg"; // Đường dẫn ảnh placeholder nếu không tìm thấy
                }

                // Hiển thị dữ liệu dưới dạng hàng trong bảng
                echo "<tr>";
                echo "<td><p row-s-ma='{$chitiethd_S_Ma}'>{$chitiethd_S_Ma}</p></td>";
                echo "<td><img src='../{$sach_HinhAnh}' alt='product-img' class='avatar-md'></td>";
                echo "<td><h5 class='font-size-14 text-truncate'><a href='#' class='text-dark'>{$sach_Ten}</a></h5></td>";
                echo "<td>₫ " . number_format($chitiethd_DonGia, 0, ',', '.') . "</td>";
                echo "<td><p row-s-soluong='{$chitiethd_SoLuong}'>{$chitiethd_SoLuong}</p></td>";
                echo "<td><span id='row_tongtien'>₫ " . number_format($tongTien, 0, ',', '.') . "</span></td>";
                echo "<td>";
                echo "<button class='btn btn-sm btn-primary'";
                echo "<i class='fas fa-cogs'></i> Xử lý</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Không tìm thấy chi tiết hóa đơn với mã $HD_Ma.</td></tr>";
        }
    ?>

                                                    
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
                            <td style="color: red; font-size: 16px; font-weight: bold; text-align: center;">PN11240003</td>
                        </tr>
                        <tr>
                            <td><strong>Tên kho nhập vào:</strong></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td><strong>Họ tên nhân viên:</strong></td>
                            <td style="text-align: center;">Nguyễn Thành Phát</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    <br>
    <h4>Thông tin sách </h4>
    <div id="display-container-xacnhan-bang" class="text-center mt-4">
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
            
                    <tr>
                        <td style="text-align: center;">Không có dữ liệu</td>
                        <td style="text-align: center;"><img src="Không có dữ liệu" alt="Image" width="50" height="50"></td>
                        <td style="text-align: center;">Không có dữ liệu</td>
                        <td style="text-align: center;">Không có dữ liệu</td>
                        <td style="text-align: center;">đ0</td>
                    </tr>
                
                    </tbody>
                </table>
            </div>

    <div class="xacnhan-form">
        <form action="./functions/phieunhaphang/phieunhaphang_add.php" method="POST">
            <div id="input-form">
                    <input name="PNH_Ma" value="PN11240003" type="hidden">
                    <input name="NV_Ma" value="NV000003" type="hidden">
                    <input name="K_Ma" value="" type="hidden">
                
                        <input name="S_Ma[]" value="Không có dữ liệu" type="hidden">
                        <input name="CTPNH_SoLuong[]" value="Không có dữ liệu" type="hidden">
                        <input name="CTPNH_DonGia[]" value="Không có dữ liệu" type="hidden">
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

    
</div>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
function validateForm() {
    const cdTen = document.getElementById("cd_ten").value.trim();
    
    if (cdTen === "") {
        swal({
            title: "Lỗi",
            text: "Tên hóa dơn không được để trống.",
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
