<?php 
include "db.php";
include "poseta_sablon.php";
session_start();
if (isset($_GET['sablon'])) {
	$_SESSION['id_doce'];
	$id_pacijenta_poseta = $_GET['sablon'];
	$upit="SELECT * FROM pacijent WHERE id_p=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id_pacijenta_poseta);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();	
	$id_pacijenta_p=$row['id_p'];
	$_SESSION['brojKartona']=$id_pacijenta_p;
	$ime_pacijenta=$row['ime'];
	$prezime_pacijenta=$row['prezime'];
	$datum_pacijenta=$row['datumRodjenja'];
	$datum = date('d-m-Y',strtotime($datum_pacijenta));

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Colorlib Templates">
	<meta name="author" content="Colorlib">
	<meta name="keywords" content="Colorlib Templates">
	<link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
	<script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
	<script src="library/dselect.js"></script>

	<!-- Title Page-->
	<title>Kreiranje posete</title>

	<!-- Font special for pages-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Main CSS-->
	<link href="css/maina.css" rel="stylesheet" media="all">
</head>

<body>
	<div class="page-wrapper">
		<div class="wrapper wrapper--w900">
			<div class="card card-6">
				<div class="card-heading">
					<h6 class="title" style="color:black; text-align:center; font-size:22px">Pacijent: <?php if (isset($ime_pacijenta) & isset($prezime_pacijenta) & isset($datum)) {
						echo $ime_pacijenta . " " . $prezime_pacijenta . ", datum rodjenja: " . $datum;
					} ?></h6>
				</div>
				<div class="card-body">
					<form method="POST" action="sablon2.php">
						<div class="form-row">
							<div class="name">STAROST</div>
							<div class="value">
								<input class="input--style-6" type="text" name="starost">
							</div>
						</div>
						<div class="form-row">
							<input type="hidden" name="doktor_id" value="<?php echo $_SESSION['id_doce']; ?>">
							<input type="hidden" name="pacijent_id" value="<?php echo $id_pacijenta_p; ?>">
							<input type="hidden" name="sablon" value="da">
							<div class="name">PT</div>
							<div class="value">
								<input class="input--style-6" type="text" name="pt">
							</div>
						</div>
												<div class="form-row">
							<div class="name">Anamneza</div>
							<div class="value">
								<input class="input--style-6" type="text" name="anamneza">
							</div>
						</div>
						<div class="form-row">
							<div class="name">KLINČKI STATUS</div>
							<div class="value">
								<input class="input--style-6" type="text" name="k_status">
							</div>
						</div>
						<div class="form-row">
							<div class="name">NEUROLOŠKI STATUS</div>
							<div class="value">
								<input class="input--style-6" type="text" name="neuro_nal">
							</div>
						</div>
						<div class="form-row">
							<div class="name">OTOSKOPSKI STATUS</div>
							<div class="value">
								<input class="input--style-6" type="text" name="otos_nal">
							</div>
						</div>
						<div class="form-row">
							<div class="name">NAPOMENA</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="napomena" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<div class="form-row" style="border:1px solid black;">
							<div class="name">DIJAGNOZA</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="pomocne_dg" placeholder=""></textarea>
								</div>
							</div>
							<br>
						</div>
						<div class="form-row">
							<div class="name">TH</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="th" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">ISHRANA</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="ishrana" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">KONTROLA</div>
							<div class="value">
								<input class="input--style-6" type="text" name="kontrola">
							</div>
						</div>

					</div>
					<div class="card-footer">
						<button class="btn btn--radius-2 btn--blue-2" name="kreiraj_posetu_sablon">Kreiraj posetu</button>
						<a href="doktor.php" class="btn btn--radius-2 btn--blue-2">Nazad</a>
					</div>
				</form>
			</div>            
		</div>
	</div>

	<!-- Jquery JS-->
	<script src="vendor/jquery/jquery.min.js"></script>


	<!-- Main JS-->
	<script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
<script>
	var select_box_element = document.querySelector('#select_box');
	dselect(select_box_element, {
		search: true
	});
</script>