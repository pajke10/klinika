<?php 
include "db.php";
session_start();
if (!isset($_SESSION['users']) || $_SESSION['role']!="doktor") {
	header("location:login.php");
}
$id_doce = $_SESSION['id_doce'];
$date = date('Y-m-d');	
$result = $mysqli->query("select p.ime, p.prezime,p.id_p,p.datumRodjenja, d.datum, d.id_doktora,r.id,r.name from pacijent p join dnevna_lista d on p.id_p=d.id_pacijenta join doktori r on r.id = d.id_doktora  where d.datum='$date' and d.id_doktora = $id_doce") or die($mysqli->error);

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
		<a class="navbar-brand" href="index.php">Profmedika</a>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" id="log" href="logout.php"><b>ODJAVI SE</b></a>
				</li>				
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" id="doc" href="logout.php" ><b> doktor: <?= $_SESSION['users']?></b></a>
				</li>
			</ul>
		</div>
	</nav>
	<?php 
	if (isset($_SESSION["message"])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php
			echo "<h1 style=text-align:center;>" . $_SESSION['message'] . "</h1>";
			unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>
	<!-- pregled kardiologa -->
	<div class="container">
		<div class="row justify-content-center">
			<form method="post" action="dnevnalistaR.php">
				<table class="table" id="table_field">
					<thead>
						<tr>
							<th>Broj kartona</th>							
							<th>Ime</th>
							<th>Prezime</th>
							<th>Datum</th>
							<th colspan="3" style="text-align: center;"></th>
						</tr>
					</thead>
					<?php 
					while ($row=mysqli_fetch_assoc($result)) { ?>
						<?php $id=$row['id_p']; ?>
						<?php $_SESSION['idPacijenta']=$row['id_p']; ?>
						<?php $_SESSION['ime']=$row['ime']; ?>
						<?php $_SESSION['prezime']=$row['prezime']; ?>
						<tr>
							<td align="center"><?php echo $row['id_p']; ?></td>
							<td><?php echo $row['ime']; ?></td>
							<td><?php echo $row['prezime']; ?></td>
							<td><?php echo $row['datumRodjenja']; ?></td>
							<td><a href="posetaDejan.php?poseta=<?php echo $row['id_p'];?>" class="btn btn-info">Novi pregled</a></td>
							<td><a href="pregledPosetaKardio.php?pregled=<?php echo $row['id_p'];?>" class="btn btn-secondary view_btn">Pregled poseta</a></td>
						</tr>
					<?php } ?>				
				</table>

			</form>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>

