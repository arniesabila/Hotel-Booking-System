<html>
	<head>
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
            background: url(img/backgroundimg.png) no-repeat center center/cover;
            background-blend-mode: lighten;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            width: 350px;
			margin-left: 25px;
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

        .login {
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

        .login:hover {
            background-color: #365dcf;
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
		<title>
			<h2>Customer LogIn</h2>
		</title>
	<head>
			<body>
				<div class="wrapper">
				<h2> STAFF LOG IN</h2>
					<form method= "post" action="staffLogin0.php">
					<div class = "input-field">
					
					<div class = "input-field">
						<input type = "text" name = "username" placeholder = "Username"  required>
						<i class ='bx bxs-user'></i>
					</div>
					
					<div class="input-field">
						<input type = "password" name = "password" placeholder = "Password" required>
						<i class = 'bx bxs-lock-alt'></i>
					</div>
					<button type = "submit" name = "submit" class = "Login" >Log In</button>
					</form>
				</div>
				</div>
				<div class="form-group">
                <button class="back-home" name="submit"><a href="index.wellHall.php" style="color: white; text-decoration: none;">Back To Home</a></button>
				</div>
				<script>
					// Clear password field on page load
					document.getElementById('password').value = '';
				</script>
				
			</body>
</html>			