<?php
include('../../../includes/db.php');

$deleteSuccess = false; // Variable to track deletion status
$hasBooks = false; // Variable to check if there are associated books

if (isset($_GET["NCC_Ma"])) {
    $NCC_Ma = $_GET["NCC_Ma"];

    // Escape the input to prevent SQL injection
    $NCC_Ma = mysqli_real_escape_string($connection, $NCC_Ma);

    // Check if there are any books associated with this topic
    $checkSql = "SELECT COUNT(*) AS book_count FROM sach WHERE NCC_Ma = '$NCC_Ma'";
    $checkResult = mysqli_query($connection, $checkSql);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['book_count'] > 0) {
        $hasBooks = true; // There are associated books
    } else {
        // Perform the deletion query
        $sql = "DELETE FROM nhacungcap WHERE NCC_Ma = '$NCC_Ma'";
        
        if (mysqli_query($connection, $sql)) {
            $deleteSuccess = true; // Mark deletion as successful
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    }
}

// Close the connection
$connection->close();
?>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if ($deleteSuccess): ?> // Check if deletion was successful
            swal({
                title: "Đã xóa!",
                text: "Nhà cung cấp đã được xóa thành công!",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "../../nhacungcap_all.php"; // Redirect after closing alert
            });
        <?php elseif ($hasBooks): ?> // Check if there are associated books
            swal({
                title: "Không thể xóa!",
                text: "Nhà cung cấp này đang được sử dụng trong dữ liệu sách, không thể xóa!",
                icon: "error",
                button: "OK",
            }).then(() => {
                window.location.href = "../../nhacungcap_all.php"; // Redirect after closing alert
            });
        <?php endif; ?>
    });
</script>
