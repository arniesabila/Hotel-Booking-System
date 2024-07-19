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
            width: calc(100% - 260px); /* Adjusted width to accommodate sidebar */
            max-width: 1200px; /* Increased max-width for better responsiveness */
            padding: 20px;
            margin-left: 260px;
            display: flex;
            flex-wrap: wrap; /* Enable wrapping for room items */
            justify-content: center; /* Center items horizontally */
            gap: 20px; /* Gap between room items */
            overflow-y: auto; /* Enable scrolling for main content */
        }
        
        .wrapper {
            width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center; /* Center text within wrapper */
        }
        
        .room-item {
            width: 100%; /* Set full width for each room item */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }
        
        .room-item h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .room-item img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 10px; /* Centers image horizontally and adds bottom margin */
            border-radius: 10px; /* Rounded corners for images */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for image */
        }
        
        .room-item p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .button:hover {
            background-color: #0056b3;
        }
        
        @media (max-width: 768px) {
            .main {
                margin-left: 0;
                padding: 20px;
            }
            
            .room-item {
                width: 100%; /* Set full width for each room item on small screens */
                max-width: 100%; /* Ensure room items take full width */
            }
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
      <i id="sidebar-close"></i>
    </nav>

 <div class="main">
        <div class="wrapper">
            <div class="room-item">
			<br></br>
                <h2>Deluxe Room Japanese</h2>
                <img src="img/specials/DeluxeRoomJapanase.jpg" alt="Deluxe Room Japanese" class="room-image">
				 <p style="align:justify">Experience the elegance of our Japanese deluxe rooms, where traditional charm meets modern comfort. Each room is meticulously decorated with shoji screens, tatami mats, and soothing colors, creating an ideal sanctuary for relaxation. Traditional Japanese decor enhances the authentic atmosphere, complemented by sleek wooden furniture and soft textiles for ultimate comfort. Enjoy modern amenities like complimentary Wi-Fi, flat-screen TVs, and Japanese-style baths (Ofuro), ensuring a delightful stay whether for business or leisure. Discover the allure of Japanese culture and comfort in every detail of your stay with us
			   </p><br></br>
			   <p><b>Price:</b> RM 559/night</p>
				<form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="559">
					<input type="hidden" name="roomType" value="Deluxe Room Japanese">
					<button class="button" name="submit" value="Book Now">Book Now!</button>
				</form>
              
            </div>
        </div>

        <div class="wrapper">
            <div class="room-item">
                <h2>Premium Room</h2>
                <img src="img/specials/PremiumRoom.jpg" alt="Premium Room" class="room-image">
				<p style="align:justify">Experience our Premium Room, a pinnacle of luxury and sophistication.
				Designed with exquisite opulence, it offers an unparalleled guest experience.
				Step into luxury with meticulously curated details evoking grandeur and exclusivity.
				The dominant black theme creates a dramatic, refined ambiance.
				Enjoy plush comfort and modern indulgence from the moment you enter.
				Sleek black furnishings and luxurious accents provide striking contrast.
				Sink into sumptuous bedding for a restful night amidst unparalleled luxury.
				The expansive living space offers relaxation and entertainment.
				Indulge in ultimate pampering in the lavishly appointed en-suite bathroom.
				Impeccable attention to detail sets the standard for luxury.
				Elevate your stay and experience refined sophistication in our Premium Room.
			   </p><br></br>
			    <p><b>Price:</b> RM 750/night</p>
                 <form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="750.00">
					<input type="hidden" name="roomType" value="Premium Room">
					<button class="button" name="submit" value="Book Now">Book Now!</button>
				</form>
            </div>
        </div>

        <div class="wrapper">
            <div class="room-item">
                <h2>Luxury Room</h2>
                <img src="img/specials/LuxuryRoom.jpg" alt="Luxury Room" class="room-image">
				<p style="align:justify">Welcome to our luxury room hotel, where elegance meets opulence in a palette of white and gold. Enjoy spacious accommodations tailored for families, offering ample comfort.
				Indulge in gourmet dining, spa treatments, and state-of-the-art amenities for a memorable stay.
				Experience the perfect blend of luxury and convenience in our thoughtfully curated rooms, designed to cater to your every need.
				</p><br></br>
				 <p><b>Price:</b> RM 1020/night</p>
                 <form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="1020">
					<input type="hidden" name="roomType" value="Luxury Room">
					<button class="button" name="submit" value="Book Now">Book Now!</button>
				</form>
            </div>
        </div>

        <div class="wrapper">
            <div class="room-item">
                <h2>Family Suite</h2>
                <img src="img/specials/FamilySuite.jpg" alt="Family Suite" class="room-image">
				<p style="align:justify">Experience unparalleled luxury and comfort in our Family Suite, meticulously designed for families seeking an indulgent stay. Spanning over spacious quarters, this suite accommodates up to 5 adults and 3 children, ensuring ample room for everyone to relax and unwind. Adorned with plush furnishings and elegant decor, every detail exudes sophistication and warmth, creating a serene retreat amidst the bustling city. Enjoy panoramic views of the city skyline or tranquil garden vistas, complemented by modern amenities including a fully-equipped kitchenette, luxurious bedding, and a private balcony. Perfect for creating unforgettable family memories, our Family Suite offers a harmonious blend of opulence and convenience, making it your ultimate choice for an extraordinary stay.</p><br></br>
                <p><b>Price:</b> RM 1300/night</p>
               <form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="1300.00">
					<input type="hidden" name="roomType" value="Family Suite">
					<button class="button" name="submit" value="Book Now">Book Now!</button>
				</form>
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