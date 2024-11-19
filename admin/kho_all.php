<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Fetching suppliers
$query = "SELECT tk.K_Ma, k.K_Ten, k.K_DiaChi,  SUM(tk.SoLuong) AS TK_SoLuong FROM `kho` k JOIN tonkho tk ON k.K_Ma = tk.K_Ma GROUP BY tk.K_Ma"; 
$kho_QUERY = mysqli_query($connection, $query);

// Check if the query was successful
if (!$kho_QUERY) {
    die("Database query failed: " . mysqli_error($connection));
}

?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Kho</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Kho</a></li>
                                <li class="breadcrumb-item active">Danh sách</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <a href="kho_add.php" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> Thêm Kho mới</a>
                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mã Kho</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tên Kho</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tổng sách</th>

                                                    <th style="width: 120px;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($kho_QUERY)) {
                                                    $K_Ma = htmlspecialchars($row["K_Ma"]); 
                                                    $K_Ten = htmlspecialchars($row["K_Ten"]); 
                                                    $TK_SoLuong = htmlspecialchars($row["TK_SoLuong"]); 

                                                    echo $i % 2 != 0 ? "<tr role='row' class='odd'>" : "<tr role='row' class='even'>";
                                                ?>
                                                    <td><?php echo $K_Ma; ?></td>
                                                    <td><?php echo $K_Ten; ?></td>
                                                    <td><?php echo $TK_SoLuong; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="kho_edit.php?K_Ma=<?php echo $K_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a onclick="confirmDelete('<?php echo $K_Ma; ?>');" class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
                                                    </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function confirmDelete(K_ma) {
    swal({
        title: "Bạn chắc chứ?",
        text: "Một khi đã xóa, thì không thể phục hồi lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = 'http://localhost/booktopia/admin/functions/kho/kho_delete.php?K_Ma=' + K_ma;
        } else {
            swal("Mẫu tin của bạn an toàn!");
        }
    });
}
</script>

<?php
include('includes/footer.php');
?>
