<?php
session_start();

if (!isset($_SESSION['empUsername'])) {
    header("Location: staffLogin.php");
    exit();
}

include("dbconn.php");

// Query to get rooms booked by type
$sql2 = "SELECT 
    ro.roomType,
    COUNT(*) AS roomsBooked
FROM 
    reservationDetails rd
    JOIN room ro ON rd.roomID = ro.roomID
GROUP BY 
    ro.roomType
ORDER BY 
    roomsBooked DESC";

$result2 = mysqli_query($dbconn, $sql2);

if (!$result2) {
    die("Error fetching room data: " . mysqli_error($dbconn));
}

// Query to get total sales
$sql3 = "SELECT 
    SUM(rd.price) AS totalSales
FROM 
    reservationDetails rd";

$result3 = mysqli_query($dbconn, $sql3);

if (!$result3) {
    die("Error fetching total sales: " . mysqli_error($dbconn));
}

// Query to get total price of rooms booked based on room type
$sql4 = "SELECT 
    ro.roomType,
    SUM(rd.price) AS totalPrice
FROM 
    reservationDetails rd
    JOIN room ro ON rd.roomID = ro.roomID
GROUP BY 
    ro.roomType
ORDER BY 
    totalPrice DESC";

$result4 = mysqli_query($dbconn, $sql4);

if (!$result4) {
    die("Error fetching total price of rooms booked: " . mysqli_error($dbconn));
}
?>

<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User view</title>
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
  background: #e7f2fd
  color: light blue;
}
.main h1 {
  color: #11101d;
  font-size: 40px;
  text-align: center;
}

.wrapper {
            position: absolute;
            top: 20%;
            left: 15%;
            width: 70%;
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
</style>


</style>


	</style>
  </head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">WELCOME!</a>

      <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title">STAFF</div>

        
		<li class="item">
            <a href="adminDashboard.php">Bookings</a>
          </li>

          <li class="item">
            <a href="user.php">Sales</a>
          </li>

		   <li class="item">
            <a href="createRoom.php">Create Bookings</a>
          </li><br><br><br>
		  <li class="item">
             <a href="logoutStaff.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <nav class="navbar">
      <i  id="sidebar-close"></i>
    </nav>

<main class="main">
    <div class="wrapper">
        <div class="overlay">
            <table>
                <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Rooms Booked</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Fetch rooms booked data
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $roomType = $row2['roomType'];
                    $roomsBooked = $row2['roomsBooked'];

                    // Find corresponding total price
                    $totalPrice = 0;
                    mysqli_data_seek($result4, 0); // Reset pointer for result4
                    while ($row4 = mysqli_fetch_assoc($result4)) {
                        if ($row4['roomType'] === $roomType) {
                            $totalPrice = $row4['totalPrice'];
                            break;
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($roomType); ?></td>
                        <td><?php echo htmlspecialchars($roomsBooked); ?></td>
                        <td><?php echo htmlspecialchars($totalPrice); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
			
			<table>
                <thead>
                <tr>
                    <th>Total Sales</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['totalSales']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
			
        </div>
    </div>
</main>


<?php
mysqli_close($dbconn);
?>

	
<script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('message') && urlParams.get('message') === 'success') {
                alert('User has been successfully deleted!');
            }
        };
    </script>

     <script>
        // JavaScript to toggle sidebar
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('close');
        });

        // For small screens
        window.addEventListener('resize', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('close');
            } else {
                sidebar.classList.remove('close');
            }
        });
    </script>
  </body>
</html>
