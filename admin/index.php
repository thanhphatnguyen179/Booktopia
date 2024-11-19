<?php include('../includes/db.php'); ?>
<?php include('includes/header.php'); ?>

<!-- ========== Left Sidebar Start ========== -->
<?php include('includes/navbar.php'); ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Thống kê</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Booktopia</a></li>
                                <li class="breadcrumb-item active">Thống kê</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <!-- Total Invoices -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <?php 
                                            $sql_tonghoadon = "SELECT COUNT(*) AS total_invoices FROM hoadon;";
                                            $result_tonghoadon = mysqli_query($connection, $sql_tonghoadon);
                                            $row_tonghoadon = mysqli_fetch_assoc($result_tonghoadon);
                                        ?>
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Tổng hóa đơn</p>
                                            <h4 class="mb-0"><?php echo $row_tonghoadon['total_invoices']; ?></h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-stack-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Incoming Invoices -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <?php 
                                            $sql_phieunhaphang = "SELECT COUNT(*) AS tong_phieunhaphang FROM phieunhaphang;";
                                            $result_phieunhaphang = mysqli_query($connection, $sql_phieunhaphang);
                                            $row_phieunhaphang = mysqli_fetch_assoc($result_phieunhaphang);
                                        ?>
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Tổng số phiếu nhập hàng</p>
                                            <h4 class="mb-0"><?php echo $row_phieunhaphang['tong_phieunhaphang']; ?></h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-store-2-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Customers -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <?php 
                                            $sql_khachhang = "SELECT COUNT(*) AS tong_khachhang FROM nguoidung WHERE ND_Ma LIKE 'KH%';";
                                            $result_khachhang = mysqli_query($connection, $sql_khachhang);
                                            $row_khachhang = mysqli_fetch_assoc($result_khachhang);
                                        ?>
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Tổng số lượng khách hàng</p>
                                            <h4 class="mb-0"><?php echo $row_khachhang['tong_khachhang']; ?></h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-briefcase-4-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <?php 
                                            $sql_nhaxuatban = "SELECT COUNT(*) AS tong_nhaxuatban FROM nhaxuatban";
                                            $result_nhaxuatban = mysqli_query($connection, $sql_nhaxuatban);
                                            $row_nhaxuatban = mysqli_fetch_assoc($result_nhaxuatban);
                                        ?>
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Tổng số nhà xuất bản</p>
                                            <h4 class="mb-0"><?php echo $row_nhaxuatban['tong_nhaxuatban']; ?></h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-briefcase-4-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <?php 
                                            $sql_nhacungcap = "SELECT COUNT(*) AS tong_nhacungcap FROM nhacungcap";
                                            $result_nhacungcap = mysqli_query($connection, $sql_nhacungcap);
                                            $row_nhacungcap = mysqli_fetch_assoc($result_nhacungcap);
                                        ?>
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Tổng số nhà cung cấp</p>
                                            <h4 class="mb-0"><?php echo $row_nhacungcap['tong_nhacungcap']; ?></h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-briefcase-4-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <?php 
                                            $sql_tacgia = "SELECT COUNT(*) AS tong_tacgia FROM tacgia";
                                            $result_tacgia = mysqli_query($connection, $sql_tacgia);
                                            $row_tacgia = mysqli_fetch_assoc($result_tacgia);
                                        ?>
                                        <div class="media-body overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Tổng số tác giả</p>
                                            <h4 class="mb-0"><?php echo $row_tacgia['tong_tacgia']; ?></h4>
                                        </div>
                                        <div class="text-primary">
                                            <i class="ri-briefcase-4-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Biểu đồ tròn - Trạng Thái Hóa Đơn</h4>
                            <!-- Pie chart will be displayed here -->
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
<!-- End main content -->

<!-- END layout-wrapper -->
<?php include('includes/footer.php'); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            <?php
                // Query for each status count
                $sql = "
                    SELECT 'Đang Chờ Xử Lý' AS status, COUNT(TT_Ma) AS count FROM hoadon WHERE TT_Ma = 'TT00000001'
                    UNION ALL
                    SELECT 'Đã Xác Nhận', COUNT(TT_Ma) FROM hoadon WHERE TT_Ma = 'TT00000003'
                    UNION ALL
                    SELECT 'Đã Hủy', COUNT(TT_Ma) FROM hoadon WHERE TT_Ma = 'TT00000005'";

                $result = mysqli_query($connection, $sql);

                // Output result for pie chart
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['status'] . "', " . $row['count'] . "],";
                    
                }
            ?>
        ]);

        var options = {
            title: 'Trạng Thái Hóa Đơn',
            is3D: true,
            pieSliceText: 'percentage',
            slices: {
                0: {offset: 0.1},
                1: {offset: 0.1},
                2: {offset: 0.1}
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
