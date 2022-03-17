<!-- stranica za logovanje -->
<?php
session_start();
include "db.php";
global $mysqli;
$msg="";
$first_name="";
$password="";
if (isset($_POST['login'])) {

	$first_name=$_POST['first_name'];
	$password=$_POST['password'];

	// $password=sha1($password);	
	$upit="SELECT * FROM doktori WHERE username=? AND password=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("ss",$first_name,$password);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	session_regenerate_id();
	$_SESSION['users']=$row['username'];
	$_SESSION['role']=$row['role'];
	$_SESSION['sluzba']=$row['specijalnost'];
	$_SESSION['id_doce']=$row['id'];
	$_SESSION['ime_doce']=$row['name'];
	session_write_close();
	if ($result->num_rows==1 && $_SESSION['role']=="sestra") {
		header("location:pretragaPacijenataNew.php");
	}else if ($result->num_rows==1 && $_SESSION['role']=="doktor" && $_SESSION['sluzba']=="pedijatrija"){
		header("location:doktor.php");
	}else if ($result->num_rows==1 && $_SESSION['role']=="doktor" && $_SESSION['sluzba']=="kardiologija") {
		header("location:doktorK.php");
	}else{
		$msg="Korisničko ime, lozinka ili uloga su pogrešni. Pokušajte ponovo!!!";
	}
	

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profimedika Simeunovic</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/simeun.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="index.php">
					<span class="login100-form-title">
						<b><i>Unesite podatke za pristup</i></b>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text"  name="first_name" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">

						</span>
						<a class="txt2" href="#">
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">

							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
	<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	

</body>
</html>