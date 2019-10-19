<?php 

session_start();
if(!isset($_SESSION['cart'])){
	
}else{
	setcookie('cart', serialize($_SESSION['cart']), time() + (86400*30));
}
require 'connect.php';
$sql = 'SELECT * FROM product';
$result = mysqli_query($con, $sql);

if( !isset($_SESSION["login"]) ){

    header("Location: login.php");
    exit;

  }

  if( isset($_POST["logout"]) ){
    logout();
  }

?>
<!DOCTYPE html>
<head>
	<title>Index - shopping cart</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<style type="text/css">
		body{
			font-family: calibri;
		}
		table#product td{
			padding: 15px 0px;
		}
		table#product th{
			padding: 5px 0px;
		}
		a#orderbtn{
			color: green;
			font-size: 20px;
			text-decoration: none;
		}
		a#orderbtn:hover{
			text-decoration: none;
		}
		table#product{
			width: 60%;
		}

	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="#">PemwebCourse</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link navMenu" href="#"><?php echo $_SESSION['username']; ?> <span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <ul class="navbar-nav nav-right">
	    	<?php if(isset($_SESSION['cart'])){ ?>
	   		<button type="button" class="btn btn-danger" style="margin-right: 10px;padding: 0px 20px;" name="cart" onclick="cartPage()">Cart</button>
	   		<?php } ?>
	        <form method="post" action="">
	      <li class="nav-item">
	          <button type="submit" class="btn btn-primary" name="logout">Logout</button>
	        </form>
	      </li>
	      <!-- <li class="nav-item">
	        <a class="nav-link" href="#">About</a>
	      </li> -->
	    </ul>
	  </div>
</nav>

<h2 style="font-size: 34px; padding-top: 50px;" align="center"> Product List </h2>
 <table id="product" align="center">
 <tr>
 	<th>Id</th>
 	<th>Name</th>
 	<th>Price</th>
 	<th>Quantity (in stock)</th>
 	<th>Buy</th>
 </tr>
 	<?php while($product = mysqli_fetch_object($result)) { ?> 
	<tr>
		<td> <?php echo $product->id; ?> </td>
		<td> <?php echo $product->name; ?> </td>
		<td> <?php echo $product->price; ?> </td>
		<td> <?php echo $product->quantity; ?> </td>
		<td> <b><a href="cart.php?id= <?php echo $product->id; ?>" id="orderbtn">Order Now</a></b> </td>
	</tr>
	<?php } ?>
 </table>
 <script type="text/javascript" src="js/control.js"></script>
</body>

 </html>