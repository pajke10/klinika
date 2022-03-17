<?php 
include "db.php";
$date = date('Y-m-d');		
$result = $mysqli->query("select p.ime, p.prezime,p.id,p.datumRodjenja, d.datum from pacijent p join dnevna_lista d on p.id=d.id_pacijenta where d.datum='$date'") or die($mysqli->error);

?>

<?php
function pre_r($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Doktor</title>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- 	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<style type="text/css">
	
	body, td, th {
		font-family: Calibri, "Calibri Light";
		font-size: 18px;
		font-weight: bolder;
		color: #666;
	}
	body{
		height: 100%;
		background:url('logo2.jpg') no-repeat center center fixed;
		-webkit-background-size:cover;
		-moz-background-size:cover;
		background-size: color;

	}
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php">Klinika</a>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" id="log" href="logout.php"><b>ODJAVI SE</b></a>
				</li>				
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" id="doc" href="logout.php" ><b><!-- doktor: <?= $_SESSION['users']?> --></b></a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<form action="">
			<div class="form-group">
				<label>PT</label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<label>Anamneza</label>
				<input type="text" style="margin-top:5px;" name="" size =50 style="border:none;">
			</div>
			<div class="form-group">
				<label>Klinicki status:</label>
				<textarea name="" cols="50" rows="2"></textarea>
			</div>
			<div class="form-group">
				<label>Neuroloski nalaz: </label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<label>Otoskopski nalaz: </label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<label>ECHO CNS-a</label>
				<textarea name="" cols="80" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label>ECHO Kukova</label>
				<textarea name="" cols="80" rows="3"></textarea>
			</div>
			<div class="form-group">
				<label>DG</label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<label>TH</label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<label>Ishrana</label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<label>Kontrola </label>
				<input type="text" style="margin-top:5px;" name="" size =100 style="border:none;">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-danger form-control" name="unesiPosetu" value="Snimi">
			</div>
		</form>
	</div>
</body>
</html>
</form>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>