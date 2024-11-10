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
                        <h4 class="mb-0">Sửa sách</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="sach_all.php">Sách</a></li>
                                <li class="breadcrumb-item active">Sửa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php 
            global $connection;
            // Lấy mã nhà cung cấp từ URL
            if (isset($_GET['S_Ma'])) {
                $S_Ma = $_GET['S_Ma'];

                // Truy vấn để lấy thông tin nhà cung cấp hiện tại
                $sql = "SELECT * FROM sach WHERE S_Ma = '$S_Ma'";
                $result = mysqli_query($connection, $sql);

                // Kiểm tra xem có dữ liệu hay không
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $S_Ma = $row['S_Ma'];
                } else {
                    echo "Không tìm thấy sách.";
                    exit();
                }
            } else {
                echo "ID sách không hợp lệ.";
                exit();
            }

                $new_s_Ma = $S_Ma;

                $sql_sach = "SELECT * FROM sach WHERE S_Ma = '$S_Ma'";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_assoc($result);
                    $S_Ten = $row['S_Ten'];
                    $S_HinhAnh = $row['S_HinhAnh'];
                    $S_NamXuatBan = $row['S_NamXuatBan'];
                    $S_NgonNgu = $row['S_NgonNgu'];
                    $S_TenNguoiDich = $row['S_TenNguoiDich'];
                    $S_TrongLuong = $row['S_TrongLuong'];
                    $S_KichThuoc = $row['S_KichThuoc'];
                    $S_SoTrang = $row['S_SoTrang'];
                    $S_HinhThuc = $row['S_HinhThuc'];
                    $S_MoTa = $row['S_MoTa'];
                    $TG_Ma = $row['TG_Ma'];
                    $NXB_Ma = $row['NXB_Ma'];
                    $NCC_Ma = $row['NCC_Ma'];
                    $CD_Ma = $row['CD_Ma'];
                
                
                $sql_dongia = "SELECT GNY_DonGia FROM gianiemyet WHERE S_Ma = '$S_Ma' ORDER BY GNY_NgayHieuLuc DESC";

                $result_dongia = mysqli_query($connection, $sql_dongia);
                $row_donGia = mysqli_fetch_assoc($result_dongia);
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="sachForm" action="functions/sach/sach_edit.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_ma">Mã sách</label>
                                            <input id="s_ma" name="s_ma" type="text" class="form-control" value="<?php echo $new_s_Ma; ?>" readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                                <h3>Thông tin sách:</h3>
                                            <div class="form-group">
                                                <label for="s_ten">Tên sách</label>
                                                <input value="<?php echo $S_Ten; ?>" id="s_ten" name="s_ten" required type="text" class="form-control" autofocus>
                                            </div>
                                         

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_namxuatban">Năm xuất bản</label>
                                            <input id="s_namxuatban" name="s_namxuatban" type="number" value="<?php echo $S_NamXuatBan; ?>" class="form-control" min="1000" max="9999">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
    <div class="form-group">
        <label for="s_ngonngu">Ngôn ngữ</label>
        <select id="s_ngonngu" name="s_ngonngu" class="form-control custom-select" title="Language">
            <option value="" disabled selected>Chọn ngôn ngữ</option>
            <?php 
                // Checking the value of $S_NgonNgu and setting the selected language
                if (strcmp($S_NgonNgu, "Tiếng Việt") == 0) {
                    // If $S_NgonNgu is "Tiếng Việt", set it as selected and display "Tiếng Anh" as the other option
                    echo "<option value='Tiếng Việt' selected>Tiếng Việt</option>";
                    echo "<option value='Tiếng Anh'>Tiếng Anh</option>";
                } else {
                    // If $S_NgonNgu is not "Tiếng Việt", assume it is "Tiếng Anh" and set it as selected
                    echo "<option value='Tiếng Việt'>Tiếng Việt</option>";
                    echo "<option value='Tiếng Anh' selected>Tiếng Anh</option>";
                } 
            ?>
        </select>
    </div>
</div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="s_tennguoidich">Tên người dịch</label>
                                            <input id="s_tennguoidich" name="s_tennguoidich" type="text" class="form-control" value="<?php echo $S_TenNguoiDich; ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div  class="col-md-4">
                                        <div class="form-group">
                                        <label for="CD_Ma">Chủ đề: </label>
                                        <select id="CD_Ma" name="CD_Ma" required class="form-control custom-select" title="Chủ đề">
                                             <option value="" disabled selected>Chọn chủ đề</option>

                                                <?php 
                                                    $query_ChuDe = "SELECT * FROM `chude` ORDER BY CD_Ma";
                                                    $result_ChuDe = mysqli_query($connection, $query_ChuDe);
                                                    
                                                    while ($row = mysqli_fetch_assoc($result_ChuDe)) {
                                                        $idx = (int) substr($row['CD_Ma'], 2);
                                                        if ($CD_Ma == $row['CD_Ma'])
                                                            echo "<option value='{$row['CD_Ma']}' selected>$idx - {$row['CD_Ten']}</option>";
                                                        else 
                                                            echo "<option value='{$row['CD_Ma']}'>$idx - {$row['CD_Ten']}</option>";
                                                    }
                                                    
                                                ?>
                                        </select>
                                        </div>
                                    </div>

                                    <div  class="col-md-4">
                                    <div class="form-group">
                                        <label for="TG_Ma">Tác giả: </label>
                                        <select id="TG_Ma" name="TG_Ma" required class="form-control custom-select" title="Tác giả">
                                             <option value="" disabled selected>Chọn tác giả</option>

                                                <?php 
                                                    $query_TacGia = "SELECT * FROM `TacGia` ORDER BY TG_Ma";
                                                    $result_TacGia = mysqli_query($connection, $query_TacGia);
                                                    
                                                    while ($row = mysqli_fetch_assoc($result_TacGia)) {
                                                        $idx = (int) substr($row['TG_Ma'], 2);
                                                        if ($TG_Ma == $row['TG_Ma'])
                                                            echo "<option value='{$row['TG_Ma']}' selected>$idx - {$row['TG_Ten']}</option>";
                                                        else
                                                            echo "<option value='{$row['TG_Ma']}'>$idx - {$row['TG_Ten']}</option>";

                                                    }
                                                    
                                                ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div  class="col-md-4">
                                        <div class="form-group">
                                        <label for="K_Ma">Lưu vào kho</label>
                                        <select id="K_Ma" name="K_Ma" required class="form-control custom-select" onchange="showQuantity(this.value)">
                                             <option value="" disabled selected>Chọn kho lưu trữ</option>

                                                <?php 
                                                    $query_kho = "SELECT * FROM `kho`";
                                                    $result_kho = mysqli_query($connection, $query_kho);
                                                    
                                                    while ($row = mysqli_fetch_assoc($result_kho)) {
                                                        $idx = (int) substr($row['K_Ma'], 1);
                                                        echo "<option value='{$row['K_Ma']}'>$idx - {$row['K_Ten']}</option>";
                                                    }
                                                    
                                                ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                <div  class="col-md-4">
                                        <div class="form-group">
                                        <label for="s_dongia">Đơn giá: </label>
                                        <input value="<?php echo $row_donGia['GNY_DonGia']; ?>" class="form-control" min="1000" type="number" name="s_dongia" id="s_dongia" required>
                                    </div>
                                    </div>
                                    <div  class="col-md-4">
                                        <div class="form-group">
                                        <label for="NCC_Ma">Nhà cung cấp: </label>
                                        <select id="NCC_Ma" name="NCC_Ma" required class="form-control custom-select" title="Nhà cung cấp">
                                                <option value="" disabled selected>Chọn nhà cung cấp</option>
                                                    
                                                <?php 
                                                    $query_NhaCungCap = "SELECT * FROM `NhaCungCap` ORDER BY NCC_Ma";
                                                    $result_NhaCungCap = mysqli_query($connection, $query_NhaCungCap);
                                                    
                                                    while ($row = mysqli_fetch_assoc($result_NhaCungCap)) {
                                                        $is_selected = "";
                                                        if ($NCC_Ma == $row['NCC_Ma'])
                                                            $is_selected = "selected";
                                                        $idx = (int) substr($row['NCC_Ma'], 3);
                                                        echo "<option value='{$row['NCC_Ma']}' $is_selected>$idx - {$row['NCC_Ten']}</option>";
                                                    }
                                                    
                                                ?>
                                        </select>
                                        </div>
                                    </div>

                                    <div  class="col-md-4">
                                        <div class="form-group">
                                        <label for="NXB_Ma">Nhà xuất bản: </label>
                                        <select id="NXB_Ma" name="NXB_Ma" required class="form-control custom-select" title="Nhà xuất bản">
                                                <option value="" disabled selected>Chọn nhà xuất bản</option>
                                                    
                                                <?php 
                                                    $query_NhaXuatBan = "SELECT * FROM `NhaXuatBan` ORDER BY NXB_Ma";
                                                    $result_NhaXuatBan = mysqli_query($connection, $query_NhaXuatBan);
                                                    
                                                    while ($row = mysqli_fetch_assoc($result_NhaXuatBan)) {
                                                        $is_selected = "";
                                                        if ($NXB_Ma == $row['NXB_Ma'])
                                                            $is_selected = "selected";
                                                        $idx = (int) substr($row['NXB_Ma'], 3);
                                                        echo "<option value='{$row['NXB_Ma']}' $is_selected>$idx - {$row['NXB_Ten']}</option>";
                                                    }
                                                    
                                                ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h3>Chi tiết sách</h3>
                                <div class="row">
                                    <div class="col-md-2">
                                            <div class="form-group">
                                            <label for="s_soluong">Số lượng: </label>
                                            <input value="" id="s_soluong" name="s_soluong" required type="number" class="form-control" min="1">
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <label for="s_trongluong">Trọng lượng (g)</label>
                                        <input id="s_trongluong" name="s_trongluong" value="<?php echo $S_TrongLuong; ?>" type="number" class="form-control" min="0">
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="s_kichthuoc">Kích thước (Dài x Rộng x Cao) cm</label>
                                            <input id="s_kichthuoc" name="s_kichthuoc" value="<?php echo $S_KichThuoc; ?>" type="text" class="form-control" placeholder="25x14x2">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_sotrang">Số trang</label>
                                            <input id="s_sotrang" name="s_sotrang" value="<?php echo $S_SoTrang; ?>" type="number" class="form-control" min="1" value="100">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_hinhthuc">Hình thức</label>
                                            <select id="s_hinhthuc" name="s_hinhthuc" class="form-control custom-select" title="Language">
                                                <option value="" disabled selected>Chọn ngôn ngữ</option>
                                                
                                                <option value="Bìa Mềm" <?php echo (isset($S_HinhThuc) && $S_HinhThuc == 'Bìa Mềm') ? 'selected' : ''; ?>>Bìa mềm</option>
                                                <option value="Bìa Cứng" <?php echo (isset($S_HinhThuc) && $S_HinhThuc == 'Bìa Cứng') ? 'selected' : ''; ?>>Bìa cứng</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                <div class="form-group">
                                    <label for="s_mota">Mô tả</label>
                                    <textarea id="s_mota" name="s_mota" class="form-control">
                                        <?php echo isset($S_Mota) ? htmlspecialchars($S_Mota) : ''; ?>
                                    </textarea>
                                </div>


                                
                                <h3>Hình ảnh sách</h3>
<div class="form-group">
    <label for="s_hinhanh">Hình ảnh</label>
    <input id="s_hinhanh" name="s_hinhanh" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
    <span id="fileName" style="display: block; margin-top: 10px; font-weight: bold;"></span> <!-- Hiển thị tên tệp -->
</div>

<!-- Hiển thị ảnh hiện có nếu có sẵn -->
<?php if (isset($S_HinhAnh) && !empty($S_HinhAnh)): ?>
    <img id="imagePreview" src="../<?php echo htmlspecialchars($S_HinhAnh); ?>" alt="Preview" style="width: 200px; display: block; max-width: 100%; height: auto; margin-top: 10px;">
<?php else: ?>
    <img id="imagePreview" src="../assets/images/book/no_image.jpg" alt="Preview" style="width: 200px; display: none; max-width: 100%; height: auto; margin-top: 10px;">
<?php endif; ?>

<script>
    // Hàm xem trước hình ảnh được chọn
    function previewImage(event) {
        var imagePreview = document.getElementById('imagePreview');
        var file = event.target.files[0];
        var reader = new FileReader();

        // Hiển thị hình ảnh xem trước sau khi tệp được tải
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }

        // Hiển thị tên tệp đã chọn
        var fileName = document.getElementById('fileName');
        if (file) {
            fileName.textContent = file.name;  // Hiển thị tên tệp
            reader.readAsDataURL(file);  // Đọc tệp dưới dạng URL
        }
    }
</script>



                                



                                
                                


<br>
<br>
<div class="row">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block waves-effect waves-light mb-1" name="sach_add">Sửa sách</button>
                                </div>
                        
                            </form>
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
        let arr_Book_check = [
            's_ten',       // Book Name
            's_soluong',   // Quantity
            'NXB_Ma',      // Publisher
            'NCC_Ma',      // Supplier
            'TG_Ma',       // Author
            'CD_Ma'        // Category
        ];

        let arr_Book_check_show = [
            'tên sách',
            'số lượng',
            'nhà xuất bản',
            'nhà cung cấp',
            'tác giả',
            'chủ đề'
        ];

        let isValid = true;  // Assume valid, set to false if any validation fails

        arr_Book_check.forEach((element, index) => {
            if (!is_null_input(element, arr_Book_check_show[index])) {
                isValid = false;
            }
        });

        return isValid;  // Return the final validity status
    }

    function is_null_input(input_name, show_name) {
        const inputElement = document.getElementById(input_name);
        const inputValue = inputElement.value.trim();

        if (inputValue === "") {
            swal({
                title: "Lỗi",
                text: `${show_name} không được để trống.`,
                icon: "error",
                button: "OK",
            });
            return false;  // Field is empty
        }
        return true;  // Field is not empty
    }
</script>
<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<script>
    function showQuantity(k_ma) {
        // Nếu không có mã kho, không làm gì
        if (k_ma == "") {
            document.getElementById("s_soluong").value = "";  // Cập nhật giá trị input, không dùng innerHTML
            return;
        }

        // Tạo yêu cầu AJAX
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log(this.readyState)
            console.log(this.status)
            console.log(this.responseText)


            if (this.readyState == 4 && this.status == 200) {
                // Hiển thị kết quả trả về từ PHP vào ô input
                document.getElementById("s_soluong").value = this.responseText;
            }
        };

        // Gửi yêu cầu tới PHP file xử lý, gửi k_ma bằng phương thức POST
        xmlhttp.open("POST", "./functions/sach/function_sach.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("k_ma=" + encodeURIComponent(k_ma));
    }
</script>


<?php
include('includes/footer.php');
?>
