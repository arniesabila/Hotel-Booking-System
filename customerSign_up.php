<html>
<head>
	</head>
	
	<style>	
	
		 * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: url(img/backgroundimg.png) no-repeat center center/cover;
            background-blend-mode: lighten;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            width: 350px;
			margin-left: 35px;
            padding: 20px 40px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        .wrapper h2 {
            color: black;
            margin-bottom: 20px;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: grey;
        }

        .SignUp {
            width: 100%;
            padding: 10px;
            background-color: #4070f4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .SignUp:hover {
            background-color: #365dcf;
        }

        .forgot {
            color: lightgrey;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .Log-In {
            color: red;
            text-decoration: none;
        }

        .Log-In:hover {
            text-decoration: underline;
        }

        .back-home {
			position: absolute;
			top: 20px;
			left: 20px;
			padding: 10px 20px;
			background-color: #4070f4;
			color: white;
			border: none;
			border-radius: 5px;
			text-align: center;
			text-decoration: none;
			transition: background-color 0.3s;
			text-transform: uppercase;
			letter-spacing: 1px;
		}

		.back-home:hover {
			background-color: #365dcf;
		}
				
	</style>
		<body>
		
			<div class="wrapper">
			<h2>SIGN UP</h2>
				<form name = "form"  method="post" action="customer_SignUp0.php">
				
					<div class = "input-field">
						<input type = "text" name = "FirstName" placeholder = "FirstName" required>
						<i class ='bx bxs-user'></i>
					</div>
					<div class = "input-field">
						<input type = "text"  name = "LastName" placeholder = "LastName" required>
						<i class ='bx bxs-user'></i>
					</div>
					<div class = "input-field">
						<input type = "email" name = "email" placeholder = "Email" required>
						<i class ='bx bxs-user'></i>
					</div>
					
					<div class = "input-field">
						<input type = "text" name = "username" placeholder = "Usename" required>
						<i class ='bx bxs-user'></i>
					</div>
					
					<div class="input-field">
						<input type = "password" name = "password" placeholder = "Password" required>
						<i class = 'bx bxs-lock-alt'></i>
					</div>
					
					<div class = "input-field">
						<input type = "password"  name = "comfirmPassword" placeholder = "Comfirm Password" required>
						<i class ='bx bxs-user'></i>
					</div>
						
						
					<button type = "submit" name = "submit" class = "SignUp" >Sign Up</button>
					<p>Already have an account? <a href="customerLogin.php" class="Log-In">Login</a></p>
				</form>
				
			</div>
			<div class="form-group">
                <button class="back-home" name="back-home"><a href="index.wellHall.php" style="color: white; text-decoration: none;">Back To Home</a></button>
            </div>

		</body>
	</head>
</html>