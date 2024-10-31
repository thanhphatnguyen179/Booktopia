<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Fetching suppliers
$query = "SELECT * FROM nhacungcap ORDER BY NCC_Ma"; 
$nhacungcap_QUERY = mysqli_query($connection, $query);

// Check if the query was successful
if (!$nhacungcap_QUERY) {
    die("Database query failed: " . mysqli_error($connection));
}

// Count total entries
$countQuery = "SELECT COUNT(*) as total FROM nhacungcap";
$countResult = mysqli_query($connection, $countQuery);
$totalEntries = mysqli_fetch_assoc($countResult)['total'];
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Nhà cung cấp</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Nhà cung cấp</a></li>
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
                                <a href="nhacungcap_add.php" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> Thêm nhà cung cấp mới</a>
                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mã nhà cung cấp</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tên nhà cung cấp</th>
                                                    <th style="width: 120px;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($nhacungcap_QUERY)) {
                                                    $NCC_Ma = htmlspecialchars($row["NCC_Ma"]); 
                                                    $NCC_Ten = htmlspecialchars($row["NCC_Ten"]); 

                                                    echo $i % 2 != 0 ? "<tr role='row' class='odd'>" : "<tr role='row' class='even'>";
                                                ?>
                                                    <td><?php echo $NCC_Ma; ?></td>
                                                    <td><?php echo $NCC_Ten; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="nhacungcap_edit.php?NCC_Ma=<?php echo $NCC_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a onclick="confirmDelete('<?php echo $NCC_Ma; ?>');" class="text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function confirmDelete(NCC_ma) {
    swal({
        title: "Bạn chắc chứ?",
        text: "Một khi đã xóa, thì không thể phục hồi lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = 'http://localhost/booktopia/admin/functions/nhacungcap/nhacungcap_delete.php?NCC_Ma=' + NCC_ma;
        } else {
            swal("Mẫu tin của bạn an toàn!");
        }
    });
}
</script>

<?php
include('includes/footer.php');
?>
