<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
/* Include db connection file */
include("dbconn.php");

if (isset($_POST['submit'])) {
    /* Capture values from HTML form */
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Prepare statement to fetch user details based on username */
    $sqlFetch = "SELECT customerID, CustPassword, CustFirstName, CustLastName FROM customer WHERE CustUsername = ?";
    $stmtFetch = mysqli_prepare($dbconn, $sqlFetch);
    mysqli_stmt_bind_param($stmtFetch, "s", $username);
    mysqli_stmt_execute($stmtFetch);
    mysqli_stmt_bind_result($stmtFetch, $user_id, $hashedPassword, $firstName, $lastName);
    mysqli_stmt_fetch($stmtFetch);


    if ($user_id > 0) {
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables and redirect
            $_SESSION['cust_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;

            // Ensure employee session variable is unset (if previously set)
            unset($_SESSION['empUsername']);

            mysqli_stmt_close($stmtFetch);
            mysqli_close($dbconn);

            header("Location: userProfile.php");
            exit();
        } else {
            // Password is incorrect
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password");';
            echo 'window.location.href = "customerLogin.php";';
            echo '</script>'; 
        }
    } else {
        // Username not found
        echo '<script language="javascript">';
        echo 'alert("Username not found");';
        echo 'window.location.href = "customerLogin.php";';
        echo '</script>';
    }

    /* Close statement */
    mysqli_stmt_close($stmtFetch);
}

/* Close db connection */
mysqli_close($dbconn);
?>
