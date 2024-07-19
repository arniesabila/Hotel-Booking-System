<?php
session_start();
if (!isset($_SESSION['empUsername'])) {
    header("Location: staffLogin.php");
    exit();
}

?>

<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Room</title>
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
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 140vh;
            background-image: url('img/specials/FamilySuite.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .main h1 {
            color: #11101d;
            font-size: 40px;
            text-align: center;
        }

        .wrapper {
            position: absolute;
            top: 10%;
            left: 15%;
            width: 70%;
            max-width: 900px;
            height: auto;
            text-align: center;
            border: 1px solid rgb(241, 241, 241);
            border-radius: 20px;
            padding: 20px 40px;
            background: white;
            opacity: 0.9;
            box-shadow: 0px 0px 30px 0 rgba(0, 0, 0, 0.7);
        }

        .input-field {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-field p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
            text-align: left;
        }

        .input-field input,
        .input-field select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .input-field .form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
            text-align: left;
        }

        .input-field .submit {
            background-color: #4070f4;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .input-field .submit:hover {
            background-color: #3352c1;
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
        <form method="POST" action="createRoom0.php">
            <div class="input-field">
                <p>Customer FirstName</p>
                <input type="text" name="FirstName" placeholder="Customer First Name" required><br><br>
            </div>

            <div class="input-field">
                <p>Customer LastName</p>
                <input type="text" name="LastName" placeholder="Customer Last Name"><br><br>
            </div>
			
			<div class="input-field">
                <p>Customer Email</p>
                <input type="email" name="email" placeholder="email"><br><br>
            </div>

            <div class="input-field">
                <p>Phone Number</p>
                <input type="text" name="PhoneNum" placeholder="Phone Number" required><br><br>
            </div>

            <div class="input-field">
                <span class="form-label">Room Type</span>
                <select class="form-control" name="RoomType" required>
                    <option value="Deluxe Room Japanese">Deluxe Room Japanese</option>
                    <option value="Premium Room">Premium Room</option>
                    <option value="Luxury Room">Luxury Room</option>
                    <option value="Family Suite">Family Suite</option>
                </select>
            </div>

            <div class="input-field">
                <span class="form-label">Check-In</span>
                <input class="form-control" type="date" name="checkIn" required>
            </div>

            <div class="input-field">
                <span class="form-label">Check-Out</span>
                <input class="form-control" type="date" name="checkOut" required>
            </div>

            <div class="input-field">
                <input type="submit" class="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</main>


    <script src="script.js"></script>
  </body>
</html>
