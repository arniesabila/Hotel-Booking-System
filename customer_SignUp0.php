
<?php
/* Include db connection file */
include("dbconn.php");

if (isset($_POST['submit'])) {
    /* Capture values from HTML form */
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
	$comfirmPassword = $_POST['comfirmPassword'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	echo "Hashed Password: $hashedPassword";

    /* Prepare statement to check if email exists */
    $sqlCheck = "SELECT CustomerID, CustEmail, CustUsername FROM customer WHERE CustEmail = ?";
    $stmtCheck = mysqli_prepare($dbconn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "s", $email);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        // Customer already exists, update username and password if not set
        $sqlUpdate = "UPDATE customer SET CustUsername = ?, CustPassword = ? WHERE CustEmail = ?";
        $stmtUpdate = mysqli_prepare($dbconn, $sqlUpdate);
        mysqli_stmt_bind_param($stmtUpdate, "sss", $username, $hashedPassword, $email);
        if (!mysqli_stmt_execute($stmtUpdate)) {
            die("Error updating customer details: " . mysqli_error($dbconn));
        }
        mysqli_stmt_close($stmtUpdate);
    } else {
        // Insert new customer if not already existing
        $sqlInsert = "INSERT INTO customer (CustFirstName, CustLastName, CustEmail, CustUsername, CustPassword) VALUES (?, ?, ?, ?, ?)";
        $stmtInsert = mysqli_prepare($dbconn, $sqlInsert);
        mysqli_stmt_bind_param($stmtInsert, "sssss", $FirstName, $LastName, $email, $username, $hashedPassword);
        if (!mysqli_stmt_execute($stmtInsert)) {
            die("Error inserting new customer: " . mysqli_error($dbconn));
        }
        mysqli_stmt_close($stmtInsert);
    }
	
	if ($password != $comfirmPassword) {
    echo '<script language="javascript">';
    echo 'alert("Passwords do not match");';
    echo 'window.location.href = "customerSign_up.php";'; // Redirect back to signup page
    echo '</script>';
	exit();
}
else{
	echo '<script language="javascript">';
    echo 'alert("Successfully Registered!");';
    echo 'window.location.href = "customerLogin.php";'; // Redirect back to signup page
    echo '</script>';
	exit(); 

  
}
} 

/* Close db connection */
mysqli_close($dbconn);
?>