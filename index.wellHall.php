<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
 <link rel="stylesheet" href="styles.css">

</head>
<style>
	 body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #343a40;
            padding: 1rem;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff;
            transition: color 0.3s;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #d4af37; /* Gold color for hover effect */
        }
        .navbar-nav .nav-link {
            margin-right: 15px;
            font-size: 16px;
        }
        .navbar-nav .nav-link.active {
            color: #d4af37; /* Gold color for active link */
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .navbar-collapse {
            justify-content: flex-end;
        }
        @media (max-width: 991.98px) {
            .navbar-nav {
                background-color: #343a40;
                padding: 1rem;
                border-radius: 5px;
            }
            .navbar-nav .nav-link {
                margin: 5px 0;
                text-align: center;
            }
        }
		
		/* header section */
		#header {
			background: url(img/backgroundimg.png) center center no-repeat;
		}
		.intro-img {
			display: table;
			width: 100%;
			padding: 0;
			background: url(img/backgroundimg.png) center center no-repeat;
			background-color: #e5e5e5;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
			-o-background-size: cover;
		}

		.intro .overlay {
			background: rgba(0,0,0,0.4);
		}
		.intro h1 {
			font-family: cursive;
			color: #fff;
			font-size: 10em;
			font-weight: 400;
			margin-top: 0;
		}
		.intro span {
			color: #a7c44c;
			font-weight: 600;
		}
		.intro p {
			color: #fff;
			font-size: 24px;
			font-weight: 400;
			margin-top: 150px;
		}
		header .intro-text {
			padding-top: 200px;
			padding-bottom: 50px;
			text-align: center;
			margin-left: 100px
		}
		/* General Form Styles */
		#search-form {
			background-color: transparent;
			border-radius: 8px;
		}

		/* Row Styles */
		#search-form .row {
			display: flex;
			flex-wrap: wrap;
			margin: 0 -10px;
		}

		#search-form .col-lg-3 {
			padding: 10px;
			flex: 1 0 25%;
			box-sizing: border-box;
		}
		
		.col-lg-12{
			margin-left: 180px;
		}
			
		/* Fieldset Styles */
		#search-form fieldset {
			margin: 0;
			padding: 0;
			border: none;
		}

		/* Select and Input Styles */
		#search-form .form-select,
		#search-form .searchText {
			width: 100%;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
		}

		/* Button Styles */
		#search-form .main-button {
			display: block;
			width: 100%;
			padding: 12px;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 4px;
			font-size: 16px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		#search-form .main-button:hover {
			background-color: #0056b3;
		}

		/* Responsive Adjustments */
		@media (max-width: 768px) {
			#search-form .col-lg-3 {
				flex: 1 0 50%;
			}
		}

		@media (max-width: 480px) {
			#search-form .col-lg-3 {
				flex: 1 0 100%;
			}
		}

		
		/* Features Section */
		#features {
			padding: 120px 0;
		}
		#features .features-item {
			margin: 0 20px;
		}
		#features img {
			margin: 30px auto 20px;
		}
		#features .about-img:before {
			display: block;
			content: '';
			position: absolute;
			top: 8px;
			right: 8px;
			bottom: 8px;
			left: 8px;
			border: 1px solid rgba(255, 255, 255, 0.5);
		}
		#features p {
			line-height: 24px;
			margin: 15px 0 30px;
		}
		
		/* About Section */
		#about {
			padding: 0;
			background: #f6f6f6;
		}
		#about h2::after {
			bottom: 0;
			margin-left: 0;
			left: 0;
		}
		#about .about-text {
			padding: 80px 0;
		}
		#about .about-img {
			background: #444 url(../img/about-bg.jpeg) center center no-repeat;
			background-size: cover;
			height: 570px;
		}
		#about p {
			line-height: 24px;
			margin: 15px 0 30px;
		}
		
		/* Menu Section */
		#restaurant-menu {
			padding: 100px 0 60px 0;
		}
		#restaurant-menu img {
			width: 300px;
			box-shadow: 15px 0 #a7c44c;
		}
		#restaurant-menu h3 {
			padding: 10px 0;
			text-transform: uppercase;
		}
		#restaurant-menu .menu-section hr {
			margin: 0 auto;
		}
		#restaurant-menu .menu-section {
			margin: 0 20px 80px;
		}
		#restaurant-menu .menu-section-title {
			font-size: 32px;
			display: block;
			font-weight: 400;
			color: #444;
			margin: 20px 0;
			text-align: center;
		}
		#restaurant-menu .menu-item {
			margin: 45px 0;
			font-size: 18px;
		}
		#restaurant-menu .menu-item-name {
			font-weight: 400;
			font-size: 20px;
			color: #444;
			margin-bottom: 10px;
		}
		#restaurant-menu .menu-item-description {
			font-size: 15px;
			width: 85%;
		}
		#restaurant-menu .menu-item-price {
			float: right;
			font-weight: 400;
			color: #555;
			margin-top: -36px;
		}
		
		
		#restaurant-menu .menu-section .menu-item .submit-button .submit{
		  border: none;
		  color: white;
		  padding: 9px 20px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 1px;
		  transition-duration: 0.4s;
		  cursor: pointer;
		}
		
		#restaurant-menu .menu-section .menu-item .submit-button .submit{
		  background-color: white; 
		  color: black; 
		  border: 2px solid red;
		}
		
		#restaurant-menu .menu-section .menu-item .submit-button .submit:hover{
			background-color: red;
			color: white;
		}
		
		/* Gallery section */
		#gallery .gallery-item {
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }
        #gallery .gallery-item:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        #gallery .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
        }
        #gallery .gallery-item .menu-item-description {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 10px;
            text-align: center;
        }
        #gallery .gallery-item .menu-item-description b {
            color: red;
        }
        #gallery .booknow {
            text-align: center;
        }
		#gallery .booknow .submit {
          border: none;
		  color: red;
		  padding: 9px 20px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 1px;
		  transition-duration: 0.4s;
		  cursor: pointer;
        }
        #gallery .booknow .submit {
          background-color: white; 
		  color: black; 
		  border: 2px solid red;
        }
        #gallery .booknow .submit:hover {
            background-color: red;
			color: white;
        }
		
		
		/* Team Section */
		#team {
			padding: 120px 0;
		}
		#team h2::after {
			bottom: 0;
			margin-left: 0;
			left: 0;
		}
		#team img {
			max-width: 550px;
		}
		#team .team-img {
			display: inline-block;
			position: relative;
		}
		
		
		/* Contact Section */
		#contact {
			padding: 100px 0;
			background: #333;
		}
		#contact .contact-item p {
			font-size: 15px;
			color: #777;
		}
		#contact .section-title {
			margin-top: 60px;
			margin-bottom: 40px;
		}
		#contact form {
			padding: 0;
		}
		#contact h3 {
			position: relative;
			text-transform: uppercase;
			font-size: 18px;
			font-weight: 400;
			color: #aaa;
			padding: 20px 0;
		}
		#contact h3::after {
			position: absolute;
			content: "";
			background: #d43031;
			height: 2px;
			width: 40px;
			bottom: 0;
			margin-left: -20px;
			left: 50%;
		}
		#contact .text-danger {
			color: #cc0033;
			text-align: left;
		}
		label {
			font-size: 12px;
			font-weight: 400;
			font-family: 'Open Sans', sans-serif;
			float: left;
		}
		#contact .form-control {
			display: block;
			width: 100%;
			padding: 6px 12px;
			font-size: 16px;
			line-height: 1.42857143;
			color: #ccc;
			background-color: rgba(255,255,255,.2);
			background-image: none;
			border: 0;
			border-radius: 0;
			-webkit-box-shadow: none;
			box-shadow: none;
			-webkit-transition: none;
			-o-transition: none;
			transition: none;
		}
		#contact .form-control:focus {
			border-color: #999;
			outline: 0;
			-webkit-box-shadow: transparent;
			box-shadow: transparent;
		}
		.form-control::-webkit-input-placeholder {
		color: #999;
		}
		.form-control:-moz-placeholder {
		color: #999;
		}
		.form-control::-moz-placeholder {
		color: #999;
		}
		.form-control:-ms-input-placeholder {
		color: #999;
		}
		#contact .contact-item {
			margin: 20px 0 40px 0;
		}
		#contact .contact-item span {
			font-weight: 400;
			color: #aaa;
			text-transform: uppercase;
			margin-bottom: 6px;
			display: inline-block;
		}
		
		#contact .container {
			margin-left: 450px;
		}
		
		#contact h2{
			margin-left: -20px;
		}
		
		
		/* Footer Section*/
		#footer {
			background: #262626;
			padding: 40px 0 20px 0;
		}
		#footer .social {
			margin-top: -5px;
			text-align: right;
			color: white;
		}
		#footer .social ul li {
			display: inline-block;
			margin: 0 15px;
		}
		#footer .social i.fa {
			font-size: 24px;
			padding: 4px;
			color: #888;
			transition: all 0.3s;
		}
		#footer .social i.fa:hover {
			color: #eee;
		}
		#footer p {
			font-size: 16px;
			color: #666;
			margin-left: 250px;
		}
		#footer a {
			color: #999;
		}
		#footer a:hover {
			color: #eee;
		}
	
		
</style>
<body>
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#features">Room</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#restaurant-menu">Details</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="customerLogin.php">Customer Login</a></li>
                <li class="nav-item"><a class="nav-link" href="customerSign_Up.php">Customer Register</a></li>
                <li class="nav-item"><a class="nav-link" href="staffLogin.php">Staff Login</a></li>
            </ul>
        </div>
    </nav>
	
	<!-- Header -->
	<header id="header">
	  <div class="intro">
		<div class="overlay">
		  <div class="container">
			<div class="row">
			  <div class="intro-text">
			  <div class="cool-xs-12 col-md-3 intro-img"></div>
				<h4 style="font-family:cursive ; color:white"> Welcome to</h4>
				<h1  style="font-family:cursive ; color:white">The Wellhall</h1>
				<h3 style="font-family:Coco Gothic ; color:white">Resort & Spa Hotel</h3>
				<p></p>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</header>
	
	<!-- Features Section -->
<div id="features" class="text-center">
  <div class="container">
    <div class="section-title">
      <h2><b>ROOM</b></h2>
    </div>
    <div class="row">
        <div class="features-item">
          <h3><b>Deluxe Room Japanase</b></h3>
          <img src="img/specials/DeluxeRoomJapanase.jpg" class="img-responsive" alt="">
          <p style="align:justify">Welcome to our Japanese deluxe rooms, where traditional elegance meets modern comfort, offering a unique and captivating lodging experience. 
		     Each room is meticulously decorated to reflect the beauty and serenity of Japanese culture.
             By incorporating elements such as shoji screens, tatami mats, and soothing color palettes, each room is an ideal sanctuary for rest and relaxation. 
			 Traditional Japanese decorations add an authentic touch to the space, while sleek wooden furniture and soft textiles provide comfort to guests.
             Modern amenities such as complimentary Wi-Fi access, flat-screen televisions, and bathrooms equipped with Japanese-style baths (Ofuro) ensure your comfort and satisfaction during your stay.
             Whether you're visiting for business or traveling with family, our Japanese deluxe rooms offer a charming and unforgettable lodging experience. 
			 Join us to experience the elegance and comfort of Japanese culture at your holiday destination.
		   </p>
        </div>
      </div>
        <div class="features-item">
          <h3><b>Premium Room</b></h3>
          <img src="img/specials/PremiumRoom.jpg" class="img-responsive" alt="">
          <p style="align:justify">Introducing our Premium Room, a pinnacle of luxury and sophistication within our hotel.
   		     Designed with an exquisite concept of opulence and elegance, this room offers an unparalleled experience for our esteemed guests.
             Immerse yourself in the epitome of luxury as you step into our Premium Room, where every detail has been meticulously curated to evoke a sense of grandeur and exclusivity.
			 The dominant theme of black creates a dramatic ambiance, exuding a sense of mystery and refinement.
             From the moment you enter, you'll be enveloped in a world of lavish comfort and modern indulgence. 
			 The sleek black furnishings, adorned with luxurious accents, provide a striking contrast against the backdrop of opulent décor.
			 Sink into the plush comforts of our sumptuous bedding, designed to ensure a restful night's sleep amidst an atmosphere of unparalleled luxury. 
			 The expansive living space offers ample room for relaxation and entertainment, with thoughtfully placed amenities catering to your every need.
			 Indulge in the ultimate pampering experience in the lavishly appointed en-suite bathroom, where sleek black marble and gleaming fixtures create an oasis of tranquility and refinement. 
			 Unwind in the deep soaking tub or revitalize your senses under the rainfall shower, surrounded by an ambiance of pure indulgence.
			 With impeccable attention to detail and a commitment to excellence, our Premium Room sets the standard for luxury accommodations.
			 Elevate your stay with us and experience the epitome of refinement and sophistication in the heart of our hotel.
		   </p>
        </div>
      </div>
        <div class="features-item">
          <h3><b>Luxury Room</b></h3>
          <img src="img/specials/LuxuryRoom.jpg" class="img-responsive" alt="">
          <p style="align:justify">Welcome to our luxury family room hotel, where elegance and opulence blend seamlessly in a palette of white and gold. 
		     Enjoy spacious accommodations tailored for families, providing ample space and comfort for all. 
		     Indulge in gourmet dining, pampering spa treatments, and state-of-the-art amenities, ensuring a memorable stay for every member of the family. 
		     Experience the perfect blend of luxury and convenience in our carefully curated rooms, designed to cater to your every need.
		  </p>
        </div>
      </div>
	  
	  <!-- About Section -->
		<div id="about">
		  <div class="container-fluid">
			<div class="row">
			 <img src="img/about-bg.jpg" alt="" align="left">
			 <div class="col-xs-12 col-md-5">
				<div class="about-text">
				  <div class="section-title">
					<h2 style=align:"center"><b>Our Story</b></h2>
				  <p><b>GREETINGS FROM WELL HALL HOTEL</b></p>
				  <p style=align:"center"> Situated in the heart of Genting Highlands, Pahang, Well Hall Hotel offers an unparalleled blend of luxury and comfort. 
					 Nestled within a vibrant district known for its dynamic street scenes, eclectic cafes, bustling markets, and rich cultural 
					 heritage, our hotel provides a unique gateway to the diverse experiences Kota Kinabalu has to offer.
					 Adding to these accolades, </p>
				  <p>Well Hall Hotel has received the Tripadvisor® 2023 Travellers’ Choice® Award, placing it in the top 10% of hotels worldwide. 
					 The hotel has also been honored with the International Travel Awards 2023, being voted ‘Best Family Hotel 2023’, and the Best Managed 
					 & Sustainable Property Award in the 10 years & above Specialized category by The Edge Malaysia 2023.
					 Experience the perfect blend of luxury, comfort, and tradition at Well Hall Hotel, where every stay is a journey of discovery and delight.</p>
			  </div>
				  </div>    
				</div>
			  </div>
			</div>
		  </div>
		  
		  <!-- Room section -->
<div id="restaurant-menu">
  <div class="container">
    <div class="section-title text-center">
      <h2><b>DETAILS</b></h2>
    </div>
<div class="row">
    <div class="col-xs-12 col-sm-6">
    <div class="menu-section">
        <h2 class="menu-section-title"><b>Room & Suites</b></h2>
        
        <div class="menu-item">
            <div class="menu-item-name">Deluxe Room Japanese</div>
            <div class="menu-item-price"> RM 559/night </div>
            <div class="menu-item-description">2 Adults | 1 child.</div><p></p>
            <div class="submit-button">
				<form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="559.00">
					<input type="hidden" name="roomType" value="Deluxe Room Jappanese">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
				</form>
            </div>
        </div>
        
        <div class="menu-item">
            <div class="menu-item-name">Premium Room</div>
            <div class="menu-item-price"> RM 750/night </div>
            <div class="menu-item-description">3 Adults | 2 child.</div>
            <div class="submit-button">
				<form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="750.00">
					<input type="hidden" name="roomType" value="Premium Room">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
				</form>
            </div>
        </div>
        
        <div class="menu-item">
			<div class="menu-item-name">Luxury Room</div>
			<div class="menu-item-price">RM 1020/night</div>
			<div class="menu-item-description">4 Adults | 3 child</div>
			<div class="submit-button">
				<form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="1020">
					<input type="hidden" name="roomType" value="Luxury Room">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
				</form>
			</div>
		</div>

        
        <div class="menu-item">
            <div class="menu-item-name">Family Suite</div>
            <div class="menu-item-price"> RM 1300/night </div>
            <div class="menu-item-description">5 Adults | 3 child.</div>
            <div class="submit-button">
				<form action="booking-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="1300.00"> 
					<input type="hidden" name="roomType" value="Family Suites">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
			</form>
            </div>
        </div>

    </div>
</div>


<script>
    function setRoomValues(form) {
        // Find the roomType and price inputs within the form
        var roomTypeInput = form.querySelector('input[name="roomType"]');
        var priceInput = form.querySelector('input[name="price"]');

        // Example of dynamically setting roomType and price based on conditions
        var roomName = form.querySelector('.menu-item-name').innerText.trim(); // Get room name
        if (roomName === 'Deluxe Room Japanese') {
            roomTypeInput.value = 'Deluxe Room Japanese';
            priceInput.value = '559.00';
        } else if (roomName === 'Premium Room') {
            roomTypeInput.value = 'Premium Room';
            priceInput.value = '750.00';
        } else if (roomName === 'Luxury Room') {
            roomTypeInput.value = 'Luxury Room';
            priceInput.value = '1020.00';
        } else if (roomName === 'Family Suite') {
            roomTypeInput.value = 'Family Suite';
            priceInput.value = '1300.00';
        }

        return true; 
    }
</script>


      <div class="col-xs-12 col-sm-6">
        <div class="menu-section">
          <h2 class="menu-section-title"><b>Amenities</b></h2>
          <div class="menu-item">
            <div class="menu-item-name">Free Wi-Fi</div>
            <div class="menu-item-price"><img src="img/gallery/wifilogo.jpg" style="width:10%; float:right;"></div>
           
          </div>
          <div class="menu-item">
            <div class="menu-item-name">Complimentary Breakfast</div>
            <div class="menu-item-price"><img src="img/gallery/breakfastlogo.jpg" style="width:15%; float:right;"></div>
           
          </div>
          <div class="menu-item">
            <div class="menu-item-name">Free Parking</div>
            <div class="menu-item-price"><img src="img/gallery/freeparkinglogo.jpg" style="width:10%; float:right;"></div>
            
          </div>
          <div class="menu-item">
            <div class="menu-item-name">Gym</div>
           <div class="menu-item-price"><img src="img/gallery/gymlogo.jpg" style="width:10%; float:right;"></div>
            
          </div>
      <div class="menu-item">
            <div class="menu-item-name">Swimming Pool</div>
            <div class="menu-item-price"><img src="img/gallery/swimmingpoollogo.png" style="width:10%; float:right;"></div> 
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-11.5">
        <div class="menu-section">
          <h2 class="menu-section-title"><b>MEETING & EVENTS</b></h2>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Gallery Section -->
<div id="gallery">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-6 col-md-3">
        <div class="gallery-item"> <img src="img/gallery/01.jpg" style="width:735px; height:225px;" class="img-responsive" alt=""></div><br>
		<div class="menu-item-description"> <b> DELUXE MEETING</b> </div><br>
		<div class="menu-item-description"> Our meeting rooms feature ample natural light and up-to-date technology to keep your meetings conducive. </div>
		<p></p>
		<p></p>
		<div class = "booknow">
			<form action="bookingEvents-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="859.00">
					<input type="hidden" name="roomType" value="Deluxe Meeting">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
			</form>
		</div>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="gallery-item"> <img src="img/gallery/02.jpg" class="img-responsive" alt=""></div><br>
		<div class="menu-item-description"><b> CONFERENCE ROOM </b></div><br>
		<div class="menu-item-description"> With LED screens and other modern facilities available in our conference rooms, you'll be able to host seamless events from start to finish. </div>
		<p></p>
		<p></p>
		<div class = "booknow">
			<form action="bookingEvents-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="4559.00">
					<input type="hidden" name="roomType" value="Conference Room">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
			</form>
		</div>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="gallery-item"> <img src="img/gallery/03.jpg" class="img-responsive" alt=""></div><br>
		<div class="menu-item-description"> <b>WEDDING HALL</b> </div><br>
		<div class="menu-item-description"> With our Grand Ballroom that fits up to 210 persons, you can be sure that you'll have a majestic venue for all your big celebrations. </div>
		<p></p>
		<p></p>
		<div class = "booknow">
			<form action="bookingEvents-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="13500.00">
					<input type="hidden" name="roomType" value="Weeding Hall">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
			</form>
		</div>
      </div>
      <div class="col-xs-6 col-md-3">
	   <div class="gallery-item"> <img src="img/gallery/04.jpg" style="width:735px; height:225px;" class="img-responsive" alt=""></div><br>
		<div class="menu-item-description"> <b>GRAND BALL ROOM </b></div><br>
		<div class="menu-item-description"> Enjoy the ritz and glamour of our 5-star hotel's Grand Ballroom, and make an impression with its pillarless halls and spacious interior. </div>
		<p></p>
		<p></p>
		<div class = "booknow">
			<form action="bookingEvents-form.php" method="POST" onsubmit="return setRoomValues(this);">
					<input type="hidden" name="price" value="18000.00">
					<input type="hidden" name="roomType" value="Grand Ball Room">
					<button class="submit" name="submit" value="Book Now">Book Now!</button>
			</form>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Contact Section -->
<div id="contact" class="text-center">
  <div class="container text-center">
    <div class="col-md-4">
      <h3>Reservations</h3>
      <div class="contact-item">
        <p>Please call</p>
        <p>033-36798123</p>
      </div>
    </div>
    <div class="col-md-4">
      <h3>Address</h3>
      <div class="contact-item">
        <p>Kota,Kinabalu, Sabah</p>
      </div>
    </div>
    <div class="col-md-4">
      <h3>Opening Hours</h3>
      <div class="contact-item">
        <p>Mon-Fri: 08:00 AM - 10:00 PM</p>
        <p>Sat-Sun 08:00 AM - 12:00 AM</p>
      </div>
    </div>
  </div>
</div>

<div id="footer">
  <div class="container text-center">
    <div class="col-md-6">
      <p>&copy; 2024 The Wellhall. All rights reserved.</p>
    </div>
    <div class="col-md-6">
      <div class="social">
        <ul>
          <li><a href="https://wa.link/pix8eb"><i class="fab fa-whatsapp fa-1.5x"></i></a></li>
          <li><a href="https://www.instagram.com/wellhall.hotel?igsh=N2xtZXBndm55eWlq&utm_source=qr"><i class="fab fa-instagram fa-1.5x"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

</body>
</html>
