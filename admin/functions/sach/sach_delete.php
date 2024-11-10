<?php
include('../../../includes/db.php');

$deleteSuccess = false; // Variable to track deletion status
$hasBooks = false; // Variable to check if there are associated books

if (isset($_GET["S_Ma"])) {
    $NXB_Ma = $_GET["S_Ma"];

    // Escape the input to prevent SQL injection
    $S_Ma = mysqli_real_escape_string($connection, $S_Ma);

    
    // Perform the deletion query
    $sql = "DELETE FROM sach WHERE S_Ma = '$S_Ma'";
    
    if (mysqli_query($connection, $sql)) {
        $deleteSuccess = true; // Mark deletion as successful
    } else {
        echo "Error: " . mysqli_error($connection);
    }
    
}

// Close the connection
$connection->close();
?>

