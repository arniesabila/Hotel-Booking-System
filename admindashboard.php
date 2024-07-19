<?php
session_start();

if (!isset($_SESSION['empUsername'])) {
    header("Location: staffLogin.php");
    exit();
}

include("dbconn.php");

$searchResults = [];
$CustFirstName = null;

// Check if search results are set in the session
if (isset($_SESSION['searchResults'])) {
    $searchResults = $_SESSION['searchResults'];
    $CustFirstName = $_SESSION['CustFirstName'];
} else {
    // Fetch all booking data if no search results in session
    $query = "SELECT 
                c.CustFirstName,
				c.CustEmail,
                c.CustPhoneNum,
                ro.roomType,
                r.checkInDate,
				r.status,
                r.checkOutDate
            FROM 
                reservation r
                JOIN reservationDetails rd ON r.reservationID = rd.reservationID
                JOIN room ro ON rd.roomID = ro.roomID
                JOIN customer c ON r.customerID = c.customerID
            ORDER BY 
                r.checkInDate";

    $result = $dbconn->query($query);

    if ($result && $result->num_rows > 0) {
        $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Clear session search results
unset($_SESSION['searchResults']);
unset($_SESSION['CustFirstName']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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
            background-color: #f2f2f2; /* Light gray background */
        }
		.sidebar {
		  position: fixed;
		  height: 100%;
		  width: 260px;
		  background: #11101d;
		  padding: 15px;
		  z-index: 99;
		}
		.logo {
		  font-size: 25px;
		  padding: 0 15px;
		}
		.sidebar a {
		  color: #fff;
		  text-decoration: none;
		}
		.menu-content {
		  position: relative;
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
		.submenu-active .menu-items {
		  transform: translateX(-56%);
		}
		.menu-title {
		  color: #fff;
		  font-size: 14px;
		  padding: 15px 20px;
		}
		.item a,
		.submenu-item {
		  padding: 16px;
		  display: inline-block;
		  width: 100%;
		  border-radius: 12px;
		}
		.item i {
		  font-size: 12px;
		}
		.item a:hover,
		.submenu-item:hover,
		.submenu .menu-title:hover {
		  background: rgba(255, 255, 255, 0.1);
		}

		.navbar,
		.main {
		  left: 260px;
		  width: calc(100% - 260px);
		  transition: all 0.5s ease;
		  z-index: 1000;
		}
		.sidebar.close ~ .navbar,
		.sidebar.close ~ .main {
		  left: 0;
		  width: 100%;
		}
		.navbar {
		  position: fixed;
		  color: #fff;
		  padding: 15px 20px;
		  font-size: 25px;
		  background: #4070f4;
		  cursor: pointer;
		}
		.navbar #sidebar-close {
		  cursor: pointer;
		}
		.main {
		  position: relative;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  height: 100vh;
		  z-index: 100;
		  backgrounf-color: grey;
		  color: #A9A9A9;
		}
		.main h1 {
		  color: #11101d;
		  font-size: 40px;
		  text-align: center;
		}

		.wrapper {
            position: absolute;
            top: 30%;
            left: 10%;
            width: 80%;
            text-align: center;
            border: 1px solid #f1f1f1;
            border-radius: 20px;
            padding: 20px;
            background: white;
            opacity: 0.95;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.7);
        }

        .wrapper table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .wrapper th,
        .wrapper td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .wrapper th {
            background-color: #f4f4f4;
            color: #333;
        }

        .wrapper tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .wrapper tbody tr:hover {
            background-color: #ddd;
        }

	.search {
            position: absolute;
            top: 90px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
        }
        .search input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            width: 300px;
            font-size: 16px;
        }
        .search input[type="submit"] {
            padding: 10px 20px;
            margin-left: 10px;
            background: #4070f4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .search input[type="submit"]:hover {
            background: #365dcf;
        }


	.overlay {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	}

	.info-item {
	flex-basis: 48%; /* Adjust as needed to fit within the wrapper */
	margin-bottom: 10px;
	}

	.info-item label {
	font-weight: bold;
	}

	.info-item p {
	margin-top: 5px;
	margin-bottom: 10px;
	}

	table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 0px solid #ddd;
			color: black;
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
            background: transparent;
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
</style>
</head>
<body>
    <nav class="sidebar">
        <a href="#" class="logo">WELCOME!</a>
        <div class="menu-content">
            <ul class="menu-items">
                <div class="menu-title">STAFF</div>
                <li class="item">
                    <a href="adminDashboard.php">Search Bookings</a>
                </li>
                <li class="item">
                    <a href="user.php">Sales</a>
                </li>
                <li class="item">
                    <a href="createRoom.php">Create Bookings</a>
                </li>
                <br><br><br>
                <li class="item">
                    <a href="logoutStaff.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar">
        <i id="sidebar-close"></i>
    </nav>
    <main class="main">
        <div class="search">
            <form name="form" method="post" action="search0Cust.php">
                <input type="text" name="custNumber" placeholder="Enter Phone Number"/>
                <input type="submit" name="Submit" value="Search">
            </form>
        </div>
        <div class="wrapper">
            <div class="overlay">
                <?php if (!empty($searchResults)) { ?>
                    <table>
                        <tr>
                            <th>Name</th>
							<th>Email</th>
                            <th>Phone No.</th>
                            <th>Room</th>
                            <th>Check-In Date</th>
                            <th>Check-Out Date</th>
							<th>Status</th>
                        </tr>
                        <?php foreach ($searchResults as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['CustFirstName']); ?></td>
								<td><?php echo htmlspecialchars($row['CustEmail']); ?></td>
                                <td><?php echo htmlspecialchars($row['CustPhoneNum']); ?></td>
                                <td><?php echo htmlspecialchars($row['roomType']); ?></td>
                                <td><?php echo htmlspecialchars($row['checkInDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['checkOutDate']); ?></td>
								<td><?php echo htmlspecialchars($row['status']); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <p>No data found</p>
                <?php } ?>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>

    <script src="script.js"></script>
</body>
</html>