<?php 

require "connect.php";
session_start();

if(isset($_POST["register"])){

  if(register($_POST) > 0 ){

    $_SESSION["login"] = true;
    header("Location: home.php");
    exit;

  } else{

    echo mysqli_error($con);

  }

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="jumbotron col-md-6 offset-md-3" style="margin-top: 20px;">
	  <h1 class="display-3">Hi, Stranger!</h1>
	  <form method="post" action="">
      <fieldset>
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" name="usernameInput" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailInput" placeholder="Enter email" required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="passwordInput" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Re-type Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="retypeInput" placeholder="Password" required>
        </div>
        </fieldset>
        <button type="submit" name="register" class="btn btn-primary">Submit</button>
        <button type="button" name="cancel" class="btn btn-default" onclick="homePage()">Cancel</button>
      </fieldset>
    </form>
    <div style="margin-top: 30px;">
      <center>
        <p>Already Have an Account?<br/></p>
        <button class="btn btn-default" onclick="loginPage()">Login</button>
      </center>
    </div>
	</div>
</div>
<script type="text/javascript" src="js/control.js"></script>
</body>
</html>