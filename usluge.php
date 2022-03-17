<?php 
include "db.php";
session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Fakturisanje</title>
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
					<a class="nav-link" id="log" href="pretragaPacijenataN.php"><b>NAZAD</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="log" href="logout.php"><b>ODJAVI SE</b></a>
				</li>				
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#"><b>sestra: <?php                  
					echo $_SESSION['users'];
				?></b></a>
			</li>
		</ul>
	</div>
</nav>
<br>
<div class="container">
	<h1 style="text-align:center;color: red;">Pregled usluga za svakog doktora na dan <?php echo date('d-m-Y'); ?></h1>
	<div class="row">
		<?php 
		$datum = date("Y/m/d");
		$fdate = strtotime($datum);
		$fdate= date("Y-m-d", $fdate);
		$ord = $mysqli->prepare("select DISTINCT d.id,d.name,d.specijalnost,dd.id_dnevne_liste,dd.datum from dnevna_lista dd JOIN doktori d on dd.id_doktora = d.id where datum ='$fdate' GROUP BY id_doktora; ");
		if ($ord->execute()) {
			$result1 = $ord->get_result();
			if ($result1->num_rows > 0) {
				while ($row=$result1->fetch_assoc()) { ?>
					<div class="col-lg-3">
						<!-- <h6 class="card-title" style="text-align:center;color: red;"><?php echo $row["name"]; ?></h6> -->
						<a href="usluga_fak.php?ooo=<?php echo $row["id"]; ?>" class="btn btn-primary" style="margin-left: 15spx;text-align: center;margin-top:10px;"><?php echo $row["name"]; ?></a>
					</div>	

				<?php	}
			}

		}  
		?>

		
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>

