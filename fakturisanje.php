<!-- stranica za fakturisanje usluga -->
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
					<a class="nav-link" id="log" href="pretragaPacijenataNew.php"><b>NAZAD</b></a>
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
	<h1 style="text-align:center;">Pregled zauzetosti ordinacija na dan <?php echo date('d-m-Y'); ?></h1>
	<div class="row">
		<?php 
		$ord = $mysqli->prepare('select * from ordinacija');
		if ($ord->execute()) {
			$result1 = $ord->get_result();
			if ($result1->num_rows > 0) {
				while ($row=$result1->fetch_assoc()) { ?>
					<div class="col-lg-4">
						<div class="card" style="width:200px; height: 150px;">
							<img class="card-img-top" src="img_avatar1.png" alt="" style="width:100%">
							<div class="card-body">								
								<h4 class="card-title" style="text-align:center;"><?php echo $row["name_o"]; ?></h4>
								<p class="card-text"></p>
								<a href="print_ord_1.php?ooo=<?php echo $row["id"]; ?>" class="btn btn-primary" style="margin-left: 38px;">Pogledaj</a>
							</div>
						</div>	
						<br>
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

