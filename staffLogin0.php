<?php
session_start();
/* include db connection file */
include("dbconn.php");

if (isset($_POST['submit'])) {
    /* capture values from HTML form */
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Query for employee */
    $sql = "SELECT * FROM employee WHERE EmpUsername = ? AND EmpPassword = ?";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Employee found
        $row = mysqli_fetch_assoc($result);
        $_SESSION['empUsername'] = $row['EmpUsername'];
        header("Location: adminDashboard.php");
        exit();
    } else {
        // Invalid login
			echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password");';
            echo 'window.location.href = "staffLogin.php";';
            echo '</script>';
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($dbconn);
?>
