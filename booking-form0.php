<?php
// Include database connection file
include("dbconn.php");
session_start();

if (isset($_POST['submit'])) {
    // Capture values from HTML form
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $Adult = $_POST['Adult'];
    $Child = $_POST['Child'];
    $email = $_POST['email'];
    $PhoneNum = $_POST['PhoneNum'];
    $loggedIn = $_POST['loggedIn'];
    $roomType = $_POST['roomType']; // Capture roomType from POST data
    $price = floatval($_POST['price']); // Capture price from POST data

    // Validate check-in and check-out dates
     $currentDate = date("Y-m-d");
    if ($checkIn < $currentDate) {
        echo '<script>alert("Check-in date cannot be in the past."); window.location.href = "booking-form.php";</script>';
        exit();
    }

    // Check if the customer already exists
    $sqlCheck = "SELECT customerID FROM customer WHERE CustEmail = ?";
    $stmtCheck = mysqli_prepare($dbconn, $sqlCheck);
    if ($stmtCheck) {
        mysqli_stmt_bind_param($stmtCheck, "s", $email);
        mysqli_stmt_execute($stmtCheck);
        mysqli_stmt_bind_result($stmtCheck, $existingCustomerID);
        mysqli_stmt_fetch($stmtCheck);
        mysqli_stmt_close($stmtCheck);

        if ($existingCustomerID) {
            // Customer exists, use existing customer ID
            $user_id = $existingCustomerID;
        } else {
            // Insert new customer data
            $sql2 = "INSERT INTO customer (CustFirstName, CustLastName, CustEmail, CustPhoneNum) VALUES (?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($dbconn, $sql2);
            if ($stmt2) {
                mysqli_stmt_bind_param($stmt2, "ssss", $FirstName, $LastName, $email, $PhoneNum);
                if (!mysqli_stmt_execute($stmt2)) {
                    die("Error executing statement: " . mysqli_error($dbconn));
                }
                mysqli_stmt_close($stmt2);

                // Retrieve the last inserted ID
                $user_id = mysqli_insert_id($dbconn);
            } else {
                die("Error preparing statement: " . mysqli_error($dbconn));
            }
        }
    } else {
        die("Error preparing statement: " . mysqli_error($dbconn));
    }

    // Insert reservation data
    $sql3 = "INSERT INTO reservation (CustomerID, NumOfAdult, NumOfChild, CheckInDate, CheckOutDate) VALUES (?, ?, ?, ?, ?)";
    $stmt3 = mysqli_prepare($dbconn, $sql3);
    if ($stmt3) {
        mysqli_stmt_bind_param($stmt3, "iisss", $user_id, $Adult, $Child, $checkIn, $checkOut);
        if (!mysqli_stmt_execute($stmt3)) {
            die("Error executing statement: " . mysqli_error($dbconn));
        }
        // Retrieve the last inserted reservation ID
        $reservation_id = mysqli_insert_id($dbconn);
        mysqli_stmt_close($stmt3);
    } else {
        die("Error preparing statement: " . mysqli_error($dbconn));
    }

    // Insert room data
    $sql4 = "INSERT INTO room (RoomType) VALUES (?)";
    $stmt4 = mysqli_prepare($dbconn, $sql4);
    if ($stmt4) {
        mysqli_stmt_bind_param($stmt4, "s", $roomType);
        if (!mysqli_stmt_execute($stmt4)) {
            die("Error executing statement: " . mysqli_error($dbconn));
        }
        // Retrieve the last inserted room ID
        $room_id = mysqli_insert_id($dbconn);
        mysqli_stmt_close($stmt4);
    } else {
        die("Error preparing statement: " . mysqli_error($dbconn));
    }

    // Calculate total price based on check-in and check-out dates
    function calculateTotalPrice($checkIn, $checkOut, $price) {
        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);
        $interval = $checkInDate->diff($checkOutDate);
        $numberOfNights = $interval->days;
        $totalPrice = (0.12 * $numberOfNights * $price) + $numberOfNights * $price;
        return $totalPrice;
    }

    // Calculate total price
    $totalPrice = calculateTotalPrice($checkIn, $checkOut, $price);

    // Insert reservation details
    $sql5 = "INSERT INTO reservationDetails (reservationID, price, roomID) VALUES (?, ?, ?)";
    $stmt5 = mysqli_prepare($dbconn, $sql5);
    if ($stmt5) {
        mysqli_stmt_bind_param($stmt5, "idi", $reservation_id, $totalPrice, $room_id);
        if (!mysqli_stmt_execute($stmt5)) {
            die("Error executing statement: " . mysqli_error($dbconn));
        }
        mysqli_stmt_close($stmt5);
    } else {
        die("Error preparing statement: " . mysqli_error($dbconn));
    }
	
	$paymentDate = date('Y-m-d'); // Current date
    $sqlPayment = "INSERT INTO payment (paymentDate, totalPaid, reservationID) VALUES (?, ?, ?)";
    $stmtPayment = mysqli_prepare($dbconn, $sqlPayment);
    mysqli_stmt_bind_param($stmtPayment, "sdi", $paymentDate, $totalPrice, $reservation_id);
    if (!mysqli_stmt_execute($stmtPayment)) {
        die("Error inserting payment data: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmtPayment);
	

    // Store booking details in session variables
    $_SESSION['reservation_id'] = $reservation_id;
    $_SESSION['totalPrice'] = $totalPrice;
    $_SESSION['roomType'] = $roomType;
    $_SESSION['checkIn'] = $checkIn;
    $_SESSION['checkOut'] = $checkOut;
    $_SESSION['price'] = $price;
    $_SESSION['cust_id'] = $user_id;
    $_SESSION['CustFirstName'] = $FirstName;
    $_SESSION['CustEmail'] = $email;
    $_SESSION['CustAddress'] = '';

    // Redirect to payment page
    header("Location: payment-form.php");
    exit();
}

// Close db connection
mysqli_close($dbconn);
?>

<script>
document.getElementById("booking-form").addEventListener("submit", function(event) {
    let checkInDate = new Date(document.getElementById("checkIn").value);
    let today = new Date();
    
    // Set the time part of both dates to zero
    checkInDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);

    if (checkInDate < today) {
        event.preventDefault();
        echo '<script language="javascript">';
        echo 'alert("checkIn date acnnot be in the past.");';
        echo 'window.location.href = "booking-form.php";';
        echo '</script>';
    }
});
</script>
