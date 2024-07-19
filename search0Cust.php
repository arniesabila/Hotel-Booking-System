<?php
session_start();

if (!isset($_SESSION['empUsername'])) {
    header("Location: staffLogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("dbconn.php");

    $custNumber = $_POST['custNumber'];

    // Validate input if needed

    // Query to fetch bookings based on customer's phone number
    $query = "SELECT 
                c.CustFirstName,
                c.CustPhoneNum,
                c.CustEmail,
                r.status,
                ro.roomType,
                r.checkInDate,
                r.checkOutDate
            FROM 
                reservation r
                JOIN reservationDetails rd ON r.reservationID = rd.reservationID
                JOIN room ro ON rd.roomID = ro.roomID
                JOIN customer c ON r.customerID = c.customerID
            WHERE 
                c.CustPhoneNum = '$custNumber'
            ORDER BY 
                r.checkInDate";

    $result = $dbconn->query($query);

    if ($result) {
        // Check if any results found
        if ($result->num_rows > 0) {
            // Fetch all rows as associative array
            $searchResults = $result->fetch_all(MYSQLI_ASSOC);

            // Store results and customer's first name in session variables
            $_SESSION['searchResults'] = $searchResults;
            $_SESSION['CustFirstName'] = $searchResults[0]['CustFirstName']; // Assuming all rows are for the same customer
        } else {
            // No bookings found for the given phone number
            $_SESSION['searchResults'] = [];
            $_SESSION['CustFirstName'] = null;
        }
    } else {
        // Error in query execution
        $_SESSION['searchResults'] = [];
        $_SESSION['CustFirstName'] = null;
    }

    // Redirect back to adminDashboard.php after processing search
    header("Location: adminDashboard.php");
    exit();
} else {
    // If accessed directly without POST method, redirect to index or appropriate page
    header("Location: staffLogin.php");
    exit();
}
?>
