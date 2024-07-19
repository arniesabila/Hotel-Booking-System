<?php
/* Include db connection file */
include("dbconn.php");
session_start();

/* Capture room type and price from URL */
$roomType = isset($_GET['room']) ? htmlspecialchars($_GET['room']) : 'N/A';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0.00; 

if (isset($_POST['submit'])) {
    /* Capture values from HTML form */
    $FirstName = isset($_POST['FirstName']) ? htmlspecialchars($_POST['FirstName']) : '';
    $LastName = isset($_POST['LastName']) ? htmlspecialchars($_POST['LastName']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '';
    $zip = isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : '';

    /* Validate email format */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    /* Check if email already exists */
    $sqlCheck = "SELECT CustomerID, CustFirstName, CustLastName, CustEmail, CustAddress FROM customer WHERE CustEmail = ?";
    $stmtCheck = mysqli_prepare($dbconn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "s", $email);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        // Customer already exists, update address if provided
        mysqli_stmt_bind_result($stmtCheck, $user_id, $existingFirstName, $existingLastName, $existingEmail, $existingAddress);
        mysqli_stmt_fetch($stmtCheck);
        mysqli_stmt_close($stmtCheck);

        // Update customer address if provided and different
        if (!empty($address) && $existingAddress != $address) {
            $sqlUpdate = "UPDATE customer SET CustAddress = ? WHERE CustEmail = ?";
            $stmtUpdate = mysqli_prepare($dbconn, $sqlUpdate);
            mysqli_stmt_bind_param($stmtUpdate, "ss", $address, $email);
            if (!mysqli_stmt_execute($stmtUpdate)) {
                die("Error updating customer address: " . mysqli_error($dbconn));
            }
            mysqli_stmt_close($stmtUpdate);
        }
    } 
	
	else {
        // Insert new customer if not already existing
        $sqlInsert = "INSERT INTO customer (CustFirstName, CustLastName, CustEmail, CustAddress, CustCity, CustState, CustZip) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = mysqli_prepare($dbconn, $sqlInsert);
        mysqli_stmt_bind_param($stmtInsert, "sssssss", $FirstName, $LastName, $email, $address, $city, $state, $zip);
        if (!mysqli_stmt_execute($stmtInsert)) {
            die("Error inserting new customer: " . mysqli_error($dbconn));
        }
        mysqli_stmt_close($stmtInsert);

        // Retrieve the last inserted ID
        $user_id = mysqli_insert_id($dbconn);
    }

    // Retrieve reservation ID from session
    if (!isset($_SESSION['reservation_id'])) {
        die("No reservation found in session");
    }
    $reservation_id = $_SESSION['reservation_id'];

    // Calculate total paid
    $numberOfNights = isset($_SESSION['numberOfNights']) ? intval($_SESSION['numberOfNights']) : 1; 
    $totalPrice = $price * $numberOfNights;

    // Insert payment data
    $paymentDate = date('Y-m-d'); // Current date
    $sqlPayment = "INSERT INTO payment (paymentDate, totalPaid, reservationID) VALUES (?, ?, ?)";
    $stmtPayment = mysqli_prepare($dbconn, $sqlPayment);
    mysqli_stmt_bind_param($stmtPayment, "sdi", $paymentDate, $price, $reservation_id);
    if (!mysqli_stmt_execute($stmtPayment)) {
        die("Error inserting payment data: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmtPayment);
	
	// Update reservation status to "PAID"
    $sqlUpdateReservation = "UPDATE reservation SET status = 'PAID' WHERE reservationID = ?";
    $stmtUpdateReservation = mysqli_prepare($dbconn, $sqlUpdateReservation);
    mysqli_stmt_bind_param($stmtUpdateReservation, "i", $reservation_id);
    if (!mysqli_stmt_execute($stmtUpdateReservation)) {
        die("Error updating reservation status: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmtUpdateReservation);

    /* Redirect to Invoice page */
    header("Location: Invoice.php");
    exit();

} else {
    echo "Failed";
}

/* Close db connection */
mysqli_close($dbconn);
?>
