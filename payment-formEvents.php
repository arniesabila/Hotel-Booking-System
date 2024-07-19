<?php
session_start();
include("dbconn.php");

// Ensure reservation data exists in session
if (!isset($_SESSION['reservation_id'])) {
    die("No reservation found.");
}

// Retrieve session variables
$reservation_id = $_SESSION['reservation_id'];
$roomType = $_SESSION['roomType'];
$checkIn = $_SESSION['checkIn'];
$checkOut = $_SESSION['checkOut'];
$price = $_SESSION['price'];
$totalPrice = $_SESSION['totalPrice'];

$reservation_id = $_SESSION['reservation_id'];

// Fetch reservation details from the database
$sqlReservation = "SELECT c.CustFirstName, c.CustLastName, c.CustEmail, c.CustPhoneNum, c.CustAddress
                   FROM reservation r
                   JOIN reservationDetails rd ON r.reservationID = rd.reservationID
                   JOIN customer c ON r.CustomerID = c.customerID
                   JOIN room rm ON rd.roomID = rm.roomID
                   WHERE r.reservationID = ?";
$stmtReservation = mysqli_prepare($dbconn, $sqlReservation);
if ($stmtReservation) {
    mysqli_stmt_bind_param($stmtReservation, "i", $reservation_id);
    mysqli_stmt_execute($stmtReservation);
    mysqli_stmt_bind_result($stmtReservation, $firstName, $lastName, $email, $phoneNum, $address);
    mysqli_stmt_fetch($stmtReservation);
    mysqli_stmt_close($stmtReservation);
} else {
    die("Error preparing statement: " . mysqli_error($dbconn));
}



// Close database connection
mysqli_close($dbconn);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
	<div class="row">
	  <div class="col-75">
		<div class="container">
		  <form method="post" action="payment-formEvents0.php">
			<div class="row">
			  <div class="col-50">
				<h3>Billing Address</h3>
				<label for="fname"><i class="fa fa-user"></i> Full Name</label>
				<input type="text" id="fname" name="FirstName" placeholder="John M. Doe" value="<?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>"required >
				<label for="email"><i class="fa fa-envelope"></i> Email</label>
				<input type="text" id="email" name="email" placeholder="john@example.com" value="<?php echo htmlspecialchars($email); ?>"required>
				<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
				<input type="text" id="adr" name="address" placeholder="542 W. 15th Street" value="<?php echo htmlspecialchars($address); ?>"required>
				<label for="city"><i class="fa fa-institution"></i> City</label>
				<input type="text" id="city" name="city" placeholder="New York" required>

				<div class="row">
				  <div class="col-50">
					<label for="state">State</label>
					<input type="text" id="state" name="state" placeholder="NY" required>
				  </div>
				  <div class="col-50">
					<label for="zip">Zip</label>
					<input type="text" id="zip" name="zip" placeholder="10001" required>
				  </div>
				</div>
			  </div>

			  <div class="col-50">
				<h3>Payment</h3>
				<label for="fname">Accepted Cards</label>
				<div class="icon-container">
				  <i class="fa fa-cc-visa" style="color:navy;"></i>
				  <i class="fa fa-cc-amex" style="color:blue;"></i>
				  <i class="fa fa-cc-mastercard" style="color:red;"></i>
				  <i class="fa fa-cc-discover" style="color:orange;"></i>
				</div>
				<label for="cname">Name on Card</label>
				<input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
				<label for="ccnum">Credit card number</label>
				<input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
				<label for="expmonth">Exp Month</label>
				<input type="text" id="expmonth" name="expmonth" placeholder="September" required>
				<div class="row">
				  <div class="col-50">
					<label for="expyear">Exp Year</label>
					<input type="text" id="expyear" name="expyear" placeholder="2018" required>
				  </div>
				  <div class="col-50">
					<label for="cvv">CVV</label>
					<input type="text" id="cvv" name="cvv" placeholder="352" required>
				  </div>
				</div>
			  </div>
			  
			</div>
			<button class="submit" name="submit">Proceed To Payment</button>
		  </form>
		</div>
	  </div>
	  <div class="col-25">
		<div class="container">
		  <h4>Booking Details</h4>
			<p>Room Type: <?php echo htmlspecialchars($roomType); ?></p>
			<p>Date: <?php echo htmlspecialchars($checkIn); ?></p>
            <p>Price Per Night: RM<?php echo htmlspecialchars($price); ?></p>
			<p> Tax: RM 12.00</p>
		  <hr>
		  <p>Total <span class="price" style="color:black"><b>RM <?php echo htmlspecialchars($totalPrice); ?></b></span></p>
		</div>
	  </div>
	</div>

</body>
</html>