<?php 
include "db.php";
include "prepisana_poseta.php";
session_start();
if (isset($_GET['prepis_p'])) {
	$id=$_GET['prepis_p'];
	$upit="select po.id_posete_ped,po.starost,po.id_doktora,po.pt,po.sablon2,po.anamneza,po.k_status, po.pomocna_dg ,po.neuro_nal,po.otos_nal,po.echo_cns,po.echo_kukova,po.id_dijagnoze,po.th,po.napomena,po.ishrana,po.kontrola,po.datumPosete,p.id_p,p.ime,p.prezime,p.datumRodjenja from  poseta_ped po  join pacijent p on p.id_p = po.id_pacijenta where po.id_posete_ped=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	$ime = $row['ime'];
	$prezime = $row['prezime'];
	$pt=$row['pt'];
	$id_posete_ped=$row['id_posete_ped'];
	$anamneza=$row['anamneza'];
	$k_status=$row['k_status'];
	$neuro_nal=$row['neuro_nal'];
	$otos_nal=$row['otos_nal'];
	$echo_cns=$row['echo_cns'];
	$echo_kukova=$row['echo_kukova'];
	$th=$row['th'];
	$a=$row['id_p'];
	$pomocna_dg=$row['pomocna_dg'];
	$napomena=$row['napomena'];
	$sablon2=$row['sablon2'];
	$ishrana=$row['ishrana'];
	$kontrola=$row['kontrola'];
	$starost=$row['starost'];
	$datumRodjenja=$row['datumRodjenja'];
	$datum = date('d-m-Y',strtotime($datumRodjenja));
	$datumP = date('d-m-Y');
	$datumPosete=$row['datumPosete'];
	$datum_poseta = date('d-m-Y',strtotime($datumPosete));
}

if ($sablon2=='da') { ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<!-- Required meta tags-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Colorlib Templates">
		<meta name="author" content="Colorlib">
		<meta name="keywords" content="Colorlib Templates">

		<!-- Title Page-->
		<title>Kreiranje posete</title>
		<link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
		<script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
		<script src="library/dselect.js"></script>
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
						<h6 class="title" style="color:black; text-align:center; font-size:22px">Pacijent: <?php if (isset($ime) & isset($prezime) & isset($datum)) {
							echo $ime . " " . $prezime . ", datum rodjenja: " . $datum;
						} ?></h6>

					</div>
					<div class="form-row">
						<div class="name">Starost</div>
						<div class="value">
							<input class="input--style-6" type="text" name="starost" value="<?php 
							echo $starost;
						?>">
					</div>
				</div>
				<div class="card-body">
					<form method="POST" action="sablon2.php">
						<div class="form-row">
							<input type="hidden" name="doktor_id" value="<?php echo $_SESSION['id_doce']; ?>">
							<input type="hidden" name="pacijent_id" value="<?php echo $a; ?>">
							<div class="name">PT</div>
							<div class="value">
								<input class="input--style-6" readonly type="text" name="pt" value="<?php 
								echo $pt;
							?>">
						</div>
					</div>
					<div class="form-row">
						<div class="name">Klinicki status</div>
						<div class="value">
							<input class="input--style-6" readonly type="text" name="k_status" value="<?php 
							echo $k_status;
						?>">
					</div>
				</div>
									<div class="form-row">
						<div class="name">Anamneza</div>
						<div class="value">
							<input class="input--style-6" readonly type="text" name="anamneza" value="<?php
							echo $anamneza;
						?>">
					</div>
				</div>
				<div class="form-row">
					<div class="name">Neuroloski status</div>
					<div class="value">
						<input class="input--style-6" readonly type="text" name="neuro_nal" value="<?php 
						echo $neuro_nal;
					?>">
				</div>
			</div>
			<div class="form-row">
				<div class="name">Otoskopski status</div>
				<div class="value">
					<input class="input--style-6" type="text" readonly name="otos_nal" value="<?php 
					echo $otos_nal;
				?>">
			</div>
		</div>
		<div class="form-row">
			<div class="name">Napomena</div>
			<div class="value">
				<div class="input-group">
					<textarea class="textarea--style-6" readonly name="napomena" value="" placeholder=""><?php 
					echo $napomena;
				?></textarea>
			</div>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="name">Dijagnoza</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="pomocna_dg" placeholder=""><?php if (isset($pomocna_dg)) {
				echo $pomocna_dg;
			} ?></textarea>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="name">TH</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="th" value="" placeholder=""><?php 
			echo $th;
		?></textarea>
	</div>
</div>
</div>
<div class="form-row">
	<div class="name">Ishrana</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="ishrana" value="" placeholder=""><?php 
			echo $ishrana;
		?></textarea>
	</div>
</div>
</div>
<div class="form-row">
	<div class="name">Kontrola</div>
	<div class="value">
		<input class="input--style-6" type="text" readonly name="kontrola" value="<?php 
		echo $kontrola;
	?>">
</div>
</div>

</div>
<div class="card-footer">
	<a href="stampaa.php?stampa=<?php echo $id_posete_ped;?>" class="btn btn--radius-2 btn--blue-2">Stampaj posetu</a>
	<a href="prepis.php?prepis_p=<?php echo $id_posete_ped;?>" class="btn btn--radius-2 btn--blue-2">Prepisi posetu</a>
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
<?php 
}else{ ?>


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
						<h6 class="title" style="color:black; text-align:center; font-size:22px">Pacijent: <?php if (isset($ime) & isset($prezime) & isset($datum)) {
							echo $ime . " " . $prezime . ", datum rodjenja: " . $datum;
						} ?></h6>

					</div>
					<div class="card-body">						
						<form method="POST" action="novaPosetaSS.php">
							<div class="form-row">
								<div class="name">Starost</div>
								<div class="value">
									<input class="input--style-6" readonly type="text" name="starost" value="<?php 
									echo $starost;
								?>">
							</div>
						</div>
						<div class="form-row">
							<input type="hidden" name="doktor_id" value="<?php echo $_SESSION['id_doce']; ?>">
							<input type="hidden" name="pacijent_id" value="<?php echo $a; ?>">
							<div class="name">PT</div>
							<div class="value">
								<input class="input--style-6" readonly type="text" name="pt" value="<?php 
								echo $pt;
							?>">
						</div>
					</div>
					<div class="form-row">
						<div class="name">Anamneza</div>
						<div class="value">
							<input class="input--style-6" readonly type="text" name="anamneza" value="<?php
							echo $anamneza;
						?>">
					</div>
				</div>
				<div class="form-row">
					<div class="name">Klinicki status</div>
					<div class="value">
						<input class="input--style-6" readonly type="text" name="k_status" value="<?php 
						echo $k_status;
					?>">
				</div>
			</div>
			<div class="form-row">
				<div class="name">Neuroloski status</div>
				<div class="value">
					<input class="input--style-6" readonly type="text" name="neuro_nal" value="<?php 
					echo $neuro_nal;
				?>">
			</div>
		</div>
		<div class="form-row">
			<div class="name">Otoskopski status</div>
			<div class="value">
				<input class="input--style-6" type="text" readonly name="otos_nal" value="<?php 
				echo $otos_nal;
			?>">
		</div>
	</div>
	<div class="form-row">
		<div class="name">ECHO cns-a</div>
		<div class="value">
			<div class="input-group">
				<textarea class="textarea--style-6" readonly name="echo_cns" value="" placeholder=""><?php 
				echo $echo_cns;
			?></textarea>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="name">ECHO kukova</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="echo_kukova" value="" placeholder=""><?php 
			echo $echo_kukova;
		?></textarea>
	</div>
</div>
</div>
<div class="form-row">
	<div class="name">TH</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="th" value="" placeholder=""><?php 
			echo $th;
		?></textarea>
	</div>
</div>
</div>
<div class="form-row">
	<div class="name">Dijagnoza</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="anamneza" placeholder=""><?php if (isset($pomocna_dg)) {
				echo $pomocna_dg;
			} ?></textarea>
		</div>
	</div>
</div>
<div class="form-row">
	<div class="name">Napomena</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="napomena" value="" placeholder=""><?php 
			echo $napomena;
		?></textarea>
	</div>
</div>
</div>
<div class="form-row">
	<div class="name">Ishrana</div>
	<div class="value">
		<div class="input-group">
			<textarea class="textarea--style-6" readonly name="ishrana" value="" placeholder=""><?php 
			echo $ishrana;
		?></textarea>
	</div>
</div>
</div>
<div class="form-row">
	<div class="name">Kontrola</div>
	<div class="value">
		<input class="input--style-6" type="text" readonly name="kontrola" value="<?php 
		echo $kontrola;
	?>">
</div>
</div>

</div>
<div class="card-footer">
	<a href="stampaa.php?stampa=<?php echo $id_posete_ped;?>" class="btn btn--radius-2 btn--blue-2">Stampaj posetu</a>
	<a href="prepis.php?prepis_p=<?php echo $id_posete_ped;?>" class="btn btn--radius-2 btn--blue-2">Prepisi posetu</a>
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
<?php      }
?>
<script>
	var select_box_element = document.querySelector('#select_box');
	dselect(select_box_element, {
		search: true
	});
</script>