<?php 

require "connect.php";
session_start();


	if( isset($_SESSION["login"]) ){

		header("Location: index.php");
		exit;

	}

	if( isset($_COOKIE["login"] )){

		if($_COOKIE["login"] == true ){

			$_SESSION["login"] = true;

		}

	}

	if( isset($_POST["login"]) ){

		// Login Input Properties
		$email = $_POST["emailInput"];
		$password = $_POST["passwordInput"];

		// Pengecekan Ketersediaan User
		$result = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
		if(mysqli_num_rows($result) === 1 ){

			// Validasi Password
			$row = mysqli_fetch_assoc($result);
			if( password_verify($password, $row["password"]) ){

				$_SESSION["login"] = true;
				$_SESSION["username"] = $row["username"];

				if( isset($_POST["rememberInput"]) ){

					setcookie('id', $row['id_user'], time() + 10);
					setcookie('key', hash('sha256', $row['email']), time() + 10);
					setcookie('login', 'true', time() + 10);

				}

				header("Location: index.php");
				exit;

			}else{
				echo "<script>alert('Password Mismatch!');</script>";
			}

		}else{
			echo "<script>alert('Email Mismatch!');</script>";
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Course 1 - Statefull | Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="jumbotron col-md-6 offset-md-3" style="margin-top: 50px;">
		<h1 class="display-3">Hi, Let's Log-In!</h1>
		<form method="post" action="">
			<fieldset>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailInput" placeholder="Enter email" required>
					<small id="emailHelp" class="form-text text-muted" hidden>We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="passwordInput" placeholder="Password" required>
				</div>
				<div class="form-group" >
					<input type="checkbox" id="exampleInputRemember" name="rememberInput">
					<label for="exampleInputRemember"> Remember Me</label>
				</div>
				</fieldset>
				<button type="submit" name="login" class="btn btn-primary">Submit</button>
				<button type="button" name="cancel" class="btn btn-default" onclick="homePage()">Cancel</button>
			</fieldset>
		</form>
		<div style="margin-top: 30px;">
			<center>
				<p>Not Have an Account Yet?<br/></p>
				<button class="btn btn-default" onclick="registerPage()">Register</button>
			</center>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/control.js"></script>
</body>
</html>