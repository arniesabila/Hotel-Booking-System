<?php
include('dbconn.php');

$sql = "SELECT * FROM custsignup"; // Select all customer information
$query = mysqli_query($dbconn, $sql);

if (!$query) {
    die("Query failed: " . mysqli_error($dbconn));
}

// Assuming you want to display information of the first row (you can loop through all rows as needed)
if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $CustID = $row['CustID'];
    $custfullname = $row['custfullname'];
    $custemail = $row['custemail'];
    $custusername = $row['custusername'];
    $custpassword = $row['custpassword'];
} else {
    // Handle case where no customer information is found
    $custID = '';
    $custfullname = '';
    $custemail = '';
    $custusername = '';
    $custpassword = '';
}
?>


<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer view</title>
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
  color: #A9A9A9;
}
.main h1 {
  color: #11101d;
  font-size: 40px;
  text-align: center;
}

.wrapper
{
	position: absolute;
	top: 30%;
	bottom: 25%;
	left: 15%;
	width: 900px;
	height: 810px;
	text-align: center;
	border: 10px solid rgb(241,241,241);
	border-radius: 20px;
	padding: 10px 40px;
	background: white;
	opacity: 0.85;
	box-shadow: 0px 0px 30px 0 rgba(0,0,0,0,0.7);
}

.wrapper {
    width: 80%;
    background-color: #f0f0f0; /* Light gray background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	
.wrapper label{
margin-right: 10px
}


/*style for profile*/
.main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Ensures the form is centered vertically on the page */
}

.wrapper {
    width: 80%; /* Adjust the width of the form container as needed */
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.overlay {
    padding: 20px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Ensures padding is included in input width */
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #007bff; /* Changed button background color to blue */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3; /* Darker shade of blue on hover */
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
            <a href="user.php">Profile</a>
          </li>

          <li class="item">
            <a href="viewRoom.php">Booking</a>
          </li>
		  
		  <li class="item">
            <a href="viewHistory.php">History</a>
          </li>

        </ul>
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

   <main class="main">
    <div class="wrapper">
        <div class="overlay">
            <h2 style="text-align: center;"><b>Welcome to Your Profile</b></h2>
            <br><br>
            
            <form action="editProfile.php" method="POST">
                <div class="col-xs-12 col-sm-6">
                    <label for="CustID">Customer ID:</label>
                    <input type="text" id="CustID" name="CustID" value="<?php echo $CustID; ?>" readonly><br><br>
                    
                    <label for="custfullname">Full Name:</label>
                    <input type="text" id="custfullname" name="custfullname" value="<?php echo $custfullname; ?>" readonly><br><br>
                    
                    <label for="custusername">Username:</label>
                    <input type="text" id="custusername" name="custusername" value="<?php echo $custusername; ?>" readonly><br><br>
                    
                    <label for="custemail">Email:</label>
                    <input type="email" id="custemail" name="custemail" value="<?php echo $custemail; ?>" readonly><br><br>
                    
                    <label for="custpassword">Password:</label>
                    <input type="password" id="custpassword" name="custpassword" value="<?php echo $custpassword; ?>" readonly><br><br>
                    
                    <input type="submit" value="Edit">
                </div>
            </form>
        </div>
    </div>
</main>



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
