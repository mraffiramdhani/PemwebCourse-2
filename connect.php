<?php


// Connection Properties
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "pemweb";

// Variabel Koneksi
$con = mysqli_connect($server, $user, $pass, $dbname);

// Fungsi Registrasi User
function register($data){

	global $con;

	// Register Input Properties
	$username = $data["usernameInput"];
	$email = $data["emailInput"];
	$password = mysqli_real_escape_string($con, $data["passwordInput"]);
	$password2 = mysqli_real_escape_string($con, $data["retypeInput"]);

	// Pengecekan Ketersediaan User
	$result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' OR email = '$email'");

	if( mysqli_fetch_assoc($result) ){
		echo "<script>
			alert('Username or Email is already used!');
		</script>";
		return false;
	}

	// Validasi Username

	// Validasi Username Input Tidak Diisi
	if(empty($username)){
		echo "<script>alert('Username Must Be Filled');</script>";
		return false;
	}
	// Validasi Username kurang dari 4 karakter dan lebih dari 26 karakter
	elseif(strlen($username) < 4 || strlen($username) > 26){
		echo "<script>alert('Username Must Contain 4 to 26 Character');</script>";
		return false;
	}
	// Validasi Username Mengandung Simbol Khusus
	elseif(preg_match("~[^a-zA-Z0-9_.]+~i", $username)){
		echo "<script>alert('Username Alphanumeric Only');</script>";
		return false;
	}


	// Validasi Password

	// Validasi Password Input Tidak Diisi
	if(empty($password)){
		echo "<script>alert('Password Must Be Filled');</script>";
		return false;
	}
	// Validasi Password kurang dari 6 karakter
	elseif( strlen($password) < 6 ){
		echo "<script>
			alert('Must be at least 6 character!');
		</script>";
		return false;
	}
	// Validasi Re-Type Password Tidak Sama dengan Password
	elseif( $password !== $password2 ){

		echo "<script>
			alert('Password Mismatch');
		</script>";
		return false;

	} 

	// Enkripsi Password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// Menambahkan User
	mysqli_query($conn, "INSERT INTO user(username, email, password) VALUES('$username', '$email', '$password')");

	return mysqli_affected_rows($con);

}


function logout(){

	$_SESSION = [];
	session_unset();
	session_destroy();

	setcookie('login', '', time() - 7200);

	header("Location: login.php");
	exit;

}

?>