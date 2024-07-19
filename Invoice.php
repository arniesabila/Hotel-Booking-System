<?php 
session_start();

$userLoggedIn = isset($_SESSION['username']);

// Determine the link destination based on login status
$backLink = $userLoggedIn ? 'customerBooking.php' : 'index.wellHall.php';

include("dbconn.php");

if (!isset($_SESSION['reservation_id'])) {
    die("No reservation found.");
}	
	$reservation_id = $_SESSION['reservation_id'];
	$totalPrice = $_SESSION['totalPrice'];
	$roomType = $_SESSION['roomType'];
	$checkIn = $_SESSION['checkIn'];
	$checkOut = $_SESSION['checkOut'];
	$price = $_SESSION['price'];
	
	/* Fetch Data from database */
	$sql = "SELECT c.CustFirstName, c.CustEmail, c.CustPhoneNum, c.CustAddress 
	FROM customer c 
	JOIN reservation r  
	ON c.customerID = r.customerID
	WHERE r.reservationID =?";
	

$stmt = $dbconn->prepare($sql);
if ($stmt) {
    // Bind the reservation ID to the placeholder
    $stmt->bind_param("i", $reservation_id);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($customerName, $customerEmail, $customerPhone, $customerAddress);

    // Fetch the result
    if ($stmt->fetch()) {
        // Customer data successfully fetched
    } else {
        die("No customer found for the given reservation ID.");
    }

    // Close the statement
    $stmt->close();
} else {
    die("Error preparing statement: " . $dbconn->error);
}

$isLoggedIn = isset($_SESSION['cust_id']);

// Close the database connection
mysqli_close($dbconn); 

?>

<!DOCTYPE html>
<html>
<header>
	<title>
		<h2> Invoice Cust <h2>
	</title>
	<style>
		 body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .invoice-title h2, .invoice-title h4 {
            margin: 0;
            padding-bottom: 10px;
			margin-left: 20px;
        }
		.invoice-title p {
			margin-left: 20px;
        }
		.row {
			margin-left: 20px;
		}
		. wrapper .h5 {
			margin-left: 20 px;
		}
        .table th {
            background-color: #f8f9fa;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }
        .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table-responsive {
            margin-top: 20px;
			width: 5500px;
        }
        .badge-success {
            background-color: #28a745;
        }
        .text-muted {
            color: #6c757d !important;
        }
        .btn-success, .btn-primary {
            border-radius: 20px;
        }
		.total {
			margin-left: 800px;
			margin-top: 3rem!important;
		}
		
		 .print-button {
            background: black;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
        }
		
		.print-button {
			margin-left: 900px;
		}
		
		.back-home {
			background: green;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
		}
		
		.table th, .table td {
			padding: 15px;
			text-align: left;
		}
		.table thead th {
			background-color: #f8f9fa;
			border-bottom: 2px solid #dee2e6;
		}
			
	</style>
	<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15">#<?php echo $reservation_id; ?><span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">WELL HALL HOTEL</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">Kota,Kinabalu, Sabah</p>
                            <p><i class="uil uil-phone me-1"></i> 033-36798123</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5><?php echo $customerName; ?></h5>
                                <p><?php echo $customerAddress; ?></p>
                                <p><?php echo $customerEmail; ?></p>
                                <p><?php echo $customerPhone; ?></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p><?php echo date("d M, Y"); ?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p><?php echo $reservation_id; ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="wrapper">
                        <h3 class="font-size-15">ORDER SUMMARY</h3>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">No.</th>
                                        <th style="width: 480px;">Item</th>
                                        <th style="width: 10px;">Price</th>
                                        <th class="text-end" >Check-In</th>
                                        <th class="text-end" >Check-Out</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            <div>
                                                <h3 class="text-end"><?php echo $roomType; ?></h3>
                                            </div>
                                        </td>
                                        <td class="text-end" ><?php echo $price; ?></td>
                                        <td class="text-end"><?php echo $checkIn; ?></td>
                                        <td class="text-end"><?php echo $checkOut; ?></td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div><!-- end table responsive -->
						<hr>
						<div class="total">
						  <div class="d-flex justify-content-end">
							<p class="text-muted me-3">Tax:</p>
							<span>RM 12.00</span>
						  </div>
						  <div class="d-flex justify-content-end mt-3">
							<h5 class="me-3">Total:</h5>
							<h3 class="text-success">RM <?php echo $totalPrice; ?></h3>
						  </div>
						</div>
						
                        <div class="print">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="print-button"><i class="fa fa-print"></i></a>
                               <div class="back">
								<button class="submit">
									<a href="<?php echo $backLink; ?>">Back</a>
								</button>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	</body>
</header>
</html>