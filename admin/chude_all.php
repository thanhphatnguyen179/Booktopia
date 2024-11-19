<?php
include('includes/header.php');
include('includes/navbar.php');
include('../includes/db.php');

// Fetch all topics
$query = "SELECT * FROM chude ORDER BY CD_Ma"; 
$CHUDE_QUERY = mysqli_query($connection, $query);

// Count total entries
$countQuery = "SELECT COUNT(*) as total FROM chude";
$countResult = mysqli_query($connection, $countQuery);
$totalEntries = mysqli_fetch_assoc($countResult)['total'];
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Chủ đề</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Chủ đề</li>
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
                                <a href="chude_add.php" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> Thêm chủ đề mới</a>
                            </div>

                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Mã chủ đề</th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1">Tên chủ đề</th>
                                                    <th style="width: 120px;">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($CHUDE_QUERY)) {
                                                    $CD_Ma = htmlspecialchars($row["CD_Ma"]); 
                                                    $CD_Ten = htmlspecialchars($row["CD_Ten"]); 

                                                    echo "<tr role='row' class='" . ($i % 2 == 0 ? 'even' : 'odd') . "'>";
                                                    ?>
                                                    <td><?php echo $CD_Ma; ?></td>
                                                    <td><?php echo $CD_Ten; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="chude_edit.php?cd_ma=<?php echo $CD_Ma; ?>" class="mr-3 text-primary" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a onclick="confirmDelete('<?php echo $CD_Ma; ?>');" class="text-danger" data-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
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
function confirmDelete(cd_ma) {
    swal({
        title: "Bạn chắc chứ?",
        text: "Một khi đã xóa, thì không thể phục hồi lại được!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = 'http://localhost/booktopia/admin/functions/chude/chude_delete.php?cd_ma=' + cd_ma;
        } else {
            swal("Mẫu tin của bạn an toàn!");
        }
    });
}
</script>

<?php
include('includes/footer.php');
?>
