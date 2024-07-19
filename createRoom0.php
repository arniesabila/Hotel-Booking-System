<?php
include("dbconn.php");
session_start();

if (isset($_POST['submit'])) {
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
	$email = $_POST['email'];
    $PhoneNum = $_POST['PhoneNum'];
    $RoomType = $_POST['RoomType'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
	
	 // Validate check-in and check-out dates
     $currentDate = date("Y-m-d");
    if ($checkIn < $currentDate) {
        echo '<script>alert("Check-in date cannot be in the past."); window.location.href = "createRoom.php";</script>';
        exit();
    }

    // Set the room price based on the room type
    $roomPrices = [
        'Deluxe Room Japanese' => 559.00, // Deluxe Room Japanese
        'Premium Room' => 750.00, // Premium Room
        'Luxury Room' => 1020.00, // Luxury Room
        'Family Suite' => 1300.00  // Family Suite
    ];

    $price = $roomPrices[$RoomType];

    // Insert new customer data
	$sql2 = "INSERT INTO customer (CustFirstName, CustLastName, CustEmail, CustPhoneNum) VALUES (?,?,?,?)";
    $stmt2 = mysqli_prepare($dbconn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ssss", $FirstName, $LastName, $email, $PhoneNum);
    if (!mysqli_stmt_execute($stmt2)) {
        die("Error: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmt2);

    // Retrieve the last inserted customer ID
    $user_id = mysqli_insert_id($dbconn);

    // Insert reservation data
    $sql3 = "INSERT INTO reservation (customerID, CheckInDate, CheckOutDate) VALUES (?, ?, ?)";
    $stmt3 = mysqli_prepare($dbconn, $sql3);
    mysqli_stmt_bind_param($stmt3, "iss", $user_id, $checkIn, $checkOut);
    if (!mysqli_stmt_execute($stmt3)) {
        die("Error: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmt3);

    // Retrieve the last inserted reservation ID
    $reservation_id = mysqli_insert_id($dbconn);

    // Insert room data
    $sql4 = "INSERT INTO room (roomType) VALUES (?)";
    $stmt4 = mysqli_prepare($dbconn, $sql4);
    mysqli_stmt_bind_param($stmt4, "s", $RoomType); // 
    if (!mysqli_stmt_execute($stmt4)) {
        die("Error: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmt4);

    // Retrieve the last inserted room ID
    $room_id = mysqli_insert_id($dbconn);

    // Insert reservation details
    $sql5 = "INSERT INTO reservationDetails (reservationID, price, roomID) VALUES (?, ?, ?)";
    $stmt5 = mysqli_prepare($dbconn, $sql5);
    mysqli_stmt_bind_param($stmt5, "idi", $reservation_id, $price, $room_id);
    if (!mysqli_stmt_execute($stmt5)) {
        die("Error: " . mysqli_error($dbconn));
    }
    mysqli_stmt_close($stmt5);
	
	$sqlUpdateReservation = "UPDATE reservation SET status = 'PAID' WHERE reservationID = ?";
	$stmtUpdateReservation = mysqli_prepare($dbconn, $sqlUpdateReservation);
	mysqli_stmt_bind_param($stmtUpdateReservation, "i", $reservation_id);

	if (!mysqli_stmt_execute($stmtUpdateReservation)) {
		die("Error updating reservation status: " . mysqli_error($dbconn));
	}

mysqli_stmt_close($stmtUpdateReservation);

    echo '<script language="javascript">';
	echo 'alert("Succesfully Booked!");';
	echo 'window.location.href = "createRoom.php";';
	echo '</script>';
}else {
	 die("Error: " . mysqli_error($dbconn));
}

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
        echo 'window.location.href = "createRoom.php";';
        echo '</script>';
    }
});
</script>
