<?php
include("dbconn.php");
session_start();

if(isset($_POST['Delete'])){
    $customerID = $_POST['customerID'];

    // Prepare the SQL statement
    $sql = "DELETE FROM customer WHERE customerID = ?";
    $stmt = mysqli_prepare($dbconn, $sql);

    if ($stmt === false) {
        die('MySQL prepare error: ' . mysqli_error($dbconn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $customerID);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Delete success";
    } else {
        die('MySQL execute error: ' . mysqli_stmt_error($stmt));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($dbconn);
?>
