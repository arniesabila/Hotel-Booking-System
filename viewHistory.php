<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: customerLogin.php");
    exit();
}

// Check if cust_id is set in session
if (isset($_SESSION['cust_id'])) {
    $cust_id = $_SESSION['cust_id'];

    // Include database connection
    include("dbconn.php");

    // Fetch user information from the database
    $sql = "SELECT CustUsername, CustPassword, CustFirstName, CustLastName, CustEmail, CustPhoneNum, CustAddress FROM customer WHERE customerID = ?";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cust_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $password, $FirstName, $LastName, $email, $phoneNum, $address);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer View</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        /* Import Google font - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
        }

        .sidebar {
            position: fixed;
            height: 100%;
            width: 260px;
            background: #11101d;
            padding: 15px;
            z-index: 99;
            transition: all 0.5s ease;
        }

        .sidebar.close {
            width: 80px;
        }

        .logo {
            font-size: 25px;
            padding: 0 15px;
            text-align: center;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .menu-content {
            height: 100%;
            width: 100%;
            margin-top: 40px;
            overflow-y: scroll;
        }

        .menu-content::-webkit-scrollbar {
            display: none;
        }

        .menu-items {
            height: 100%;
            width: 100%;
            list-style: none;
            transition: all 0.4s ease;
        }

        .menu-title {
            color: #fff;
            font-size: 14px;
            padding: 15px 20px;
        }

        .item a {
            padding: 16px;
            display: inline-block;
            width: 100%;
            border-radius: 12px;
        }

        .item a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar {
            left: 260px;
            width: calc(100% - 260px);
            transition: all 0.5s ease;
            z-index: 1000;
            position: fixed;
            color: #fff;
            padding: 15px 20px;
            font-size: 25px;
            background: #4070f4;
        }

        .navbar .fa-bars {
            cursor: pointer;
        }

        .main {
            width: calc(100% - 260px);
            padding: 20px;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            overflow-y: auto;
            transition: all 0.5s ease;
        }

        .sidebar.close ~ .main {
            margin-left: 100px;
            width: calc(100% - 80px);
        }

        .history-container {
            width: 100%;
            max-width: 1200px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .history-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background: #f4f4f4;
            color: #333;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        @media (max-width: 768px) {
            .main {
                margin-left: 80px;
                width: calc(100% - 80px);
            }

            .sidebar.close ~ .main {
                margin-left: 0;
                width: 100%;
            }
        }
		
		.wrapper{
			padding: 100px;
		}
		
		button[type='submit'] {
			background-color: #f44336; /* Red background */
			color: white; /* White text color */
			border: none; /* No border */
			padding: 10px 20px; /* Padding */
			cursor: pointer; /* Pointer cursor */
			border-radius: 5px; /* Rounded corners */
			transition: background-color 0.3s; /* Smooth transition */
		}

		button[type='submit']:hover {
			background-color: #df352b; /* Darker red on hover */
		}
    </style>
</head>
<body>
    <nav class="sidebar">
        <a href="#" class="logo">WELCOME!</a>
        <div class="menu-content">
            <ul class="menu-items">
                <div class="menu-title">Customer</div>
                <li class="item">
                    <a href="userProfile.php">Profile</a>
                </li>
                <li class="item">
                    <a href="customerBooking.php">Booking</a>
                </li>
                <li class="item">
                    <a href="viewHistory.php">History</a>
                </li>
                <br><br><br>
                <li class="item">
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar">
        <i  id="sidebar-toggle"></i>
    </nav>
    <div class="main">
	<div class = "wrapper">
        <div class="history-container">
            <h2>PAID Booking History</h2>
			<?php
			// Include database connection
			include("dbconn.php");

			// Fetch PAID booking history based on customer ID
			$sqlFetchPaid = "SELECT r.reservationID, ro.roomType, r.checkInDate, r.checkOutDate, c.CustFirstName, c.CustLastName
							 FROM reservation r
							 JOIN reservationDetails rd ON r.reservationID = rd.reservationID
							 JOIN room ro ON rd.roomID = ro.roomID
							 JOIN customer c ON r.customerID = c.customerID
							 WHERE c.customerID = ? AND r.status = 'PAID'";
			$stmtFetchPaid = mysqli_prepare($dbconn, $sqlFetchPaid);
			mysqli_stmt_bind_param($stmtFetchPaid, "i", $cust_id);
			mysqli_stmt_execute($stmtFetchPaid);
			$resultPaid = mysqli_stmt_get_result($stmtFetchPaid);

			if (mysqli_num_rows($resultPaid) > 0) {
				echo "<table>
						<tr>
							<th>Booking ID</th>
							<th>Room Type</th>
							<th>Check-In Date</th>
							<th>Check-Out Date</th>
							<th>Action</th>
						</tr>";
				while ($row = mysqli_fetch_assoc($resultPaid)) {
					echo "<tr>
							<td>{$row['reservationID']}</td>
							<td>{$row['roomType']}</td>
							<td>{$row['checkInDate']}</td>
							<td>{$row['checkOutDate']}</td>
							<td>
                                    <form method='post' action='cancelBooking.php'>
                                        <input type='hidden' name='reservationID' value='{$row['reservationID']}'>
                                        <button type='submit'>Cancel</button>
                                    </form>
                                </td>
						  </tr>";
				}
				echo "</table>";
			} else {
				echo "<p>No PAID booking History found.</p>";
			}

			mysqli_stmt_close($stmtFetchPaid);
			?>
			<br><br><br><h2>CANCELLED Booking History</h2>
			<?php
			// Fetch CANCELLED booking history based on customer ID
			$sqlFetchCancelled = "SELECT r.reservationID, ro.roomType, r.checkInDate, r.checkOutDate, c.CustFirstName, c.CustLastName
								  FROM reservation r
								  JOIN reservationDetails rd ON r.reservationID = rd.reservationID
								  JOIN room ro ON rd.roomID = ro.roomID
								  JOIN customer c ON r.customerID = c.customerID
								  WHERE c.customerID = ? AND r.status = 'CANCELLED'";
			$stmtFetchCancelled = mysqli_prepare($dbconn, $sqlFetchCancelled);
			mysqli_stmt_bind_param($stmtFetchCancelled, "i", $cust_id);
			mysqli_stmt_execute($stmtFetchCancelled);
			$resultCancelled = mysqli_stmt_get_result($stmtFetchCancelled);

			if (mysqli_num_rows($resultCancelled) > 0) {
				echo "<table>
						<tr>
							<th>Booking ID</th>
							<th>Room Type</th>
							<th>Check-In Date</th>
							<th>Check-Out Date</th>
						</tr>";
				while ($row = mysqli_fetch_assoc($resultCancelled)) {
					echo "<tr>
							<td>{$row['reservationID']}</td>
							<td>{$row['roomType']}</td>
							<td>{$row['checkInDate']}</td>
							<td>{$row['checkOutDate']}</td>
						  </tr>";
				}
				echo "</table>";
			} else {
				echo "<p>No CANCELLED bookings found.</p>";
			}

			mysqli_stmt_close($stmtFetchCancelled);
			mysqli_close($dbconn);
			?>

        </div>
	</div>
    </div>

    <script>
        // JavaScript to toggle sidebar
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('close');
        });
    </script>
</body>
</html>
