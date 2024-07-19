<?php
/* Include db connection file */
include("dbconn.php");
session_start();

/* Check if user is logged in */
if (!isset($_SESSION['cust_id'])) {
    die("Please log in to cancel your booking.");
}

// Get reservation ID from POST data
$reservation_id = $_POST['reservationID'];
$cust_id = $_SESSION['cust_id'];

// Update reservation status to "CANCEL"
$sqlUpdateReservation = "UPDATE reservation SET status = 'CANCELLED' WHERE reservationID = ?";
$stmtUpdateReservation = mysqli_prepare($dbconn, $sqlUpdateReservation);
mysqli_stmt_bind_param($stmtUpdateReservation, "i", $reservation_id);

if (!mysqli_stmt_execute($stmtUpdateReservation)) {
    die("Error updating reservation status: " . mysqli_error($dbconn));
}

mysqli_stmt_close($stmtUpdateReservation);
mysqli_close($dbconn);

// Redirect back to customer dashboard with a success message
echo '<script language="javascript">';
echo 'alert("Booking successfully cancelled."); location.href="viewHistory.php"';
echo '</script>';
?>
