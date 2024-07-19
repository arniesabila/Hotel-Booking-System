<?php
session_start();

// Set session variables from POST data if they exist
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['price']) && isset($_POST['roomType'])) {
        $_SESSION['price'] = $_POST['price'];
        $_SESSION['roomType'] = $_POST['roomType'];
    }
}
?>

<!DOCTYPE.html>
<html>

	<head>
		<title>Booking-form</title>
		<style>
		
			body{
				background: url(Luxury-Hotel.jpg) no-repeat;
				background-color: dark chocolate;
				opacity: 05;
				background-position:center;
				background-size: cover;
				width: 400px;
				height: 600px;
				background-color: rgba(255, 255,255, 0.1);; /* Dark chocolate color with 50% transparency */
				background-blend-mode: lighten; 
			}
				
			.booking-form{
				position: absolute;
				top: 8%;
				bottom: 25%;
				left: 30%;
				width: 500px;
				height: 630px;
				text-align: center;
				border: 1px solid rgb(241,241,241);
				border-radius: 20px;
				padding: 10px 40px;
				background: transparent;
				backdrop-filter: blur(20px);
				box-shadow: 0px 0px 30px 0 rgba(0,0,0,0,0.7);
				}
				
			.booking-form .form-header{
				color: white;
				}
				
				
				
				.form-group input{
					border-radius: 5px;
					margin: 15px;
					height:30px;
					border: 1px solid;
					}
					
				.form-label {
					color: white;
					display: block;
					font-weight: bold;
					text-align: left;
				}
				
				 .form-control {
					width: calc(100% - 20px);
					padding: 8px;
					border: 1px solid #ccc;
					border-radius: 4px;
					box-sizing: border-box;
					margin-left: 10px;
				}
				
				.form-group select {
					width: 100%;
					padding: 5px;
					border: 1px solid #ccc;
					border-radius: 4px;
					box-sizing: border-box;
				}
				
				.submit {
					background-color: #BFA100;
					color: #fff;
					padding: 8px 20px;
					border: none;
					border-radius: 4px;
					cursor: pointer;
					font-size: 16px;
				}
				.submit:hover {
					background-color: gold;
				}
				
				.row {
					display: flex;
					justify-content: space-between;
				}

				.row .form-group {
					flex: 1;
					margin-right: 10px;
				}

				.row .form-group:last-child {
					margin-right: 0;
				}
				
				.booking-details {
					width: 40%;
					background: #f9f9f9;
					border-radius: 10px;
					position: absolute;
					top: 20%;
					left: 5%;
					width: 250px;
					height: 200px;
					text-align: center;
					border: 1px solid rgb(241,241,241);
					border-radius: 20px;
					background: transparent;
					backdrop-filter: blur(20px);
					box-shadow: 0px 0px 30px 0 rgba(0,0,0,0,0.7);
					
					
					}

					.booking-details p {
						margin-bottom: 10px;
						color: white;
					}
					
					.booking-details h2 {
						margin-bottom: 10px;
						color: white;
					}

				  

					@media (max-width: 768px) {
						.booking-container {
							flex-direction: column;
						}

						.booking-form,
						.booking-details {
							width: 100%;
						}
					}
    </style>
		</style>
	</head>
	
	<body>
	<div class = "booking-details">
		<div class="wrapper">
		<h2> Booking Details </h2>
			<p><b>Room:</b> <?php echo htmlspecialchars($_SESSION['roomType']); ?></p>
			<p><b>Price per Night:</b> RM <?php echo htmlspecialchars($_SESSION['price']); ?></p>
			<p id="totalPrice"></p>
		</div>
	</div>
		
		<div class = "booking-form">
		<form method = "post" action = "bookingEvents-form0.php">
			<div class = "form-header">
				<h2> Make Your Reservation </h2>
			</div>
			 <input type="hidden" name="loggedIn" value="<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>">
			 <input type="hidden" name="loggedIn" value="<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>">
            <input type="hidden" name="roomType" value="<?php echo htmlspecialchars($_SESSION['roomType']); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($_SESSION['price']); ?>">
			<div class = "row">
			<div class = "form-group">
					<span class = "form-label" > First Name </span>
					<input class ="form-control" type = "text" name = "FirstName" placeholder = "Enter your first name" required>
				</div>
				<div class = "form-group">
					<span class = "form-label" > Last Name </span>
					<input class ="form-control" type = "text" name = "LastName" placeholder = "Enter your last name" required>
				</div>
			</div>
			<div class = "form-group">
					<span class = "form-label" > Check-In </span>
					<input class ="form-control" type = "date" name = "checkIn" required>
			</div>
			<div class ="form-group">
				<span class ="form-label" > Pax</span>
				<input class = "form-control" type ="text" name = "pax" placeholder = "Enter your pax" required>
				<span class = "select-arrow"></span><br>
			</div>
			<div class = "form-group">
				<span class ="form-label">Email</span>
				<input class = "form-control" type ="email" name = "email" placeholder = "Enter your Email" required>
			</div>
			<div class = "form-group">
				<span class ="form-label">Phone</span>
				<input class ="form-control" type = "text" name = "PhoneNum" placeholder = "Enter your phone number" required>
			</div>
			<div class="form-group">
                <button class="submit" name="submit"> Book Now </button>
            </div>
			</form>
			
		</div>
		<div class="back">
            <button class="submit">
                <a href="<?php echo isset($_SESSION['username']) ? 'customerBooking.php' : 'index.wellHall.php'; ?>">Back</a>
            </button>
			</div>
	</body>
</html>
