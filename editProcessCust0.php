<?php
/* Include db connection file */
include("dbconn.php");
session_start();

/* Check if user is logged in */
if (!isset($_SESSION['cust_id'])) {
    die("Please log in to edit your profile.");
}

$cust_id = $_SESSION['cust_id'];

if (isset($_POST['Edit'])) {
    /* Capture values from HTML form */
    $FirstName = htmlspecialchars($_POST['FirstName']);
    $LastName = htmlspecialchars($_POST['LastName']);
    $email = htmlspecialchars($_POST['email']);
    $phoneNum = htmlspecialchars($_POST['phoneNum']);
    $address = htmlspecialchars($_POST['address']);

    /* Validate email format */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    /* Update process */
    $sql = "UPDATE customer SET 
                CustFirstName = '$FirstName', 
                CustLastName = '$LastName', 
                CustEmail = '$email', 
                CustPhoneNum = IF('$phoneNum' = '', CustPhoneNum, '$phoneNum'), 
                CustAddress = IF('$address' = '', CustAddress, '$address') 
            WHERE customerID = $cust_id";

    $query = mysqli_query($dbconn, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($dbconn));
    } else {
        echo '<script language="javascript">';
		echo 'alert("Successfully Upadated"); location.href="userProfile.php"';
		echo '</script>';
    }
}

if (isset($_POST['Delete'])) {
    /* Delete process */
    $deleteSql = "DELETE FROM customer WHERE customerID = $cust_id";
    $deleteQuery = mysqli_query($dbconn, $deleteSql);

    if (!$deleteQuery) {
        die("Error: " . mysqli_error($dbconn));
    } else {

        /* Log the user out and destroy the session */
        session_unset();
        session_destroy();

        /* Redirect to home page or login page */
        echo '<script language="javascript">';
		echo 'alert("Account Succesfully Deleted!")';
		echo '</script>';
		
		header("Location: customerLogin.php");
        exit();
    }
}

/* Close db connection */
mysqli_close($dbconn);
?>
