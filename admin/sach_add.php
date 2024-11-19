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
                        <h4 class="mb-0">Thêm sách mới</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="sach_all.php">Sách</a></li>
                                <li class="breadcrumb-item active">Thêm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php 
            global $connection;
            // Truy vấn để lấy prefix và số lớn nhất
            $sql = "
                SELECT 
                    SUBSTRING(S_Ma, 1, 3) AS prefix,
                    MAX(CAST(SUBSTRING(S_Ma, 4) AS UNSIGNED)) AS max_number  
                FROM 
                    sach
                WHERE 
                    S_Ma LIKE 'S%'
                GROUP BY 
                    prefix;
            ";

            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
            $prefix = $row['prefix'];
            $max_number = $row['max_number'];
            $new_number = $max_number + 1;
            $new_s_Ma = $prefix . str_pad($new_number, 5, '0', STR_PAD_LEFT);
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="sachForm" action="functions/sach/sach_add.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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
                                                <input id="s_ten" name="s_ten" required type="text" class="form-control" autofocus>
                                            </div>
                                         

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_namxuatban">Năm xuất bản</label>
                                            <input id="s_namxuatban" name="s_namxuatban" type="number" value="2024" class="form-control" min="1000" max="9999">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_ngonngu">Ngôn ngữ</label>
                                            <select id="s_ngonngu" name="s_ngonngu" class="form-control custom-select" title="Language">
                                                <option value="" disabled selected>Chọn ngôn ngữ</option>
                                                <option value="Tiếng Việt" >Tiếng Việt</option>
                                                <option value="Tiếng Anh">Tiếng Anh</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="s_tennguoidich">Tên người dịch</label>
                                            <input id="s_tennguoidich" name="s_tennguoidich" type="text" class="form-control">
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
                                                        echo "<option value='{$row['TG_Ma']}'>$idx - {$row['TG_Ten']}</option>";
                                                    }
                                                    
                                                ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div  class="col-md-4">
                                        <div class="form-group">
                                        <label for="K_Ma">Lưu vào kho</label>
                                        <select id="K_Ma" name="K_Ma" required class="form-control custom-select" title="Lưu vào kho">
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
                                        <input class="form-control" min="10000" type="number" name="s_dongia" id="s_dongia" required>
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
                                                        $idx = (int) substr($row['NCC_Ma'], 3);
                                                        echo "<option value='{$row['NCC_Ma']}'>$idx - {$row['NCC_Ten']}</option>";
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
                                                        $idx = (int) substr($row['NXB_Ma'], 3);
                                                        echo "<option value='{$row['NXB_Ma']}'>$idx - {$row['NXB_Ten']}</option>";
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
                                            <input id="s_soluong" name="s_soluong" required type="number" class="form-control" min="1">
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <label for="s_trongluong">Trọng lượng (g)</label>
                                        <input id="s_trongluong" name="s_trongluong"  type="number" class="form-control" min="0">
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="s_kichthuoc">Kích thước (Dài x Rộng x Cao) cm</label>
                                            <input id="s_kichthuoc" name="s_kichthuoc" type="text" class="form-control" placeholder="25x14x2">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_sotrang">Số trang</label>
                                            <input id="s_sotrang" name="s_sotrang" type="number" class="form-control" min="1" value="100">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="s_hinhthuc">Hình thức</label>
                                            <select id="s_hinhthuc" name="s_hinhthuc" class="form-control custom-select" title="Language">
                                            <option value="" disabled selected>Chọn ngôn ngữ</option>
                                                

                                                <option value="Bìa Mềm" selected>Bìa mềm</option>
                                                <option value="Bìa Cứng">Bìa cứng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                <div class="form-group">
                                    <label for="s_mota">Mô tả</label>
                                    <textarea id="s_mota" name="s_mota" class="form-control"></textarea>
                                </div>

                                <h3>Hình ảnh sách</h3>
                                <div class="form-group">
                                    <label for="s_hinhanh">Hình ảnh</label>
                                    <input id="s_hinhanh" name="s_hinhanh" type="file" class="form-control" accept="image/*" onchange="previewImage(event)">
                                </div>


<img id="imagePreview" src="" alt="Preview" style="width: 200px; display: none; max-width: 100%; height: auto; margin-top: 10px;">




                                



                                
                                


<br>
<br>
<div class="row">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block waves-effect waves-light mb-1" name="sach_add">Tạo sách mới</button>
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

<?php
include('includes/footer.php');
?>
