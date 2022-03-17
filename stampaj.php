<?php 

include "db.php";
if (isset($_GET['stampa'])) {

	$id=$_GET['stampa'];
	$upit="select po.id_doktora,po.pt,po.anamneza,po.k_status, po.neuro_nal,po.otos_nal,po.echo_cns,po.echo_kukova,po.dg,po.th,po.napomena,po.ishrana,po.kontrola,po.datumPosete,p.id_p,p.ime,p.prezime,p.datumRodjenja from poseta_ped po join pacijent p  on p.id_p = po.id_pacijenta where po.id_pacijenta=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	 $ime = $row['ime'];
	$prezime = $row['prezime'];
	$pt=$row['pt'];
	$anamneza=$row['anamneza'];
	$k_status=$row['k_status'];
	$neuro_nal=$row['neuro_nal'];
	$otos_nal=$row['otos_nal'];
	$echo_cns=$row['echo_cns'];
	$echo_kukova=$row['echo_kukova'];
	$th=$row['th'];
	$dg=$row['dg'];
	$napomena=$row['napomena'];
	$ishrana=$row['ishrana'];
	$kontrola=$row['kontrola'];
	$datumRodjenja=$row['datumRodjenja'];

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style>
		.value {
			display: table-cell;			
			text-align: right;
			padding-left: 800px;
		}
		label {
			display: table-cell;
		}
		p{
			font-size: large;
		}
		#d{

			padding-left: 430px;
			
			
		}
	</style>
</head>
<body>
	<div class="container">
		<span style='font-size:100px;' id='d'>&#128522;</span>
		<h4 style="text-align:center;"><b><?php echo $ime . " " . $prezime . ", " . $datumRodjenja; ?></b></h4>
		<div class="row">
			<div class="col-3">
				<p><b>PT :</b><?php if (isset($pt)) {
					echo $pt;
				} ?>
			</p>
		</div>
		<div class="col-3">
			<p><b>Anamneza :</b>  <?php if (isset($anamneza)) {
					echo $anamneza;
			} ?>
		</p>
	</div>
	<div class="col-3">
		<p><b>Klinicki status :</b>  <?php if (isset($k_status)) {
					echo $k_status;
		} ?>
	</p>
</div>
<div class="col-3">
	<p><b>Neuroloski nalaz :</b>  <?php if (isset($neuro_nal)) {
					echo $neuro_nal;
	} ?> 
</p>
</div>
<div class="col-3">
	<p><b>Otoskopski nalaz :</b>  <?php if (isset($otos_nal)) {
					echo $otos_nal;
	} ?>
</p>
</div>
<div class="col-3">
	<p><b>ECHO CNS-a :</b>  <?php if (isset($echo_cns)) {
					echo $echo_cns;
	} ?>
</p>
</div>
<div class="col-3">
	<p><b>ECHO Kukova :</b>  <?php if (isset($echo_kukova)) {
					echo $echo_kukova;
	} ?>
</p>
</div>
<div class="col-3">
	<p><b>DG :</b>  <?php if (isset($dg)) {
					echo $dg;
	} ?>

</p>
</div>
<div class="col-3">
	<p><b>TH :</b>  <?php if (isset($th)) {
					echo $th;
	} ?>
</p>
</div>
<div class="col-3">
	<p><b>Ishrana :</b>  <?php if (isset($ishrana)) {
					echo $ishrana;
	} ?>
</p>
</div>
<div class="col-3">
	<p><b>Kontrola :</b> <?php if (isset($kontrola)) {
					echo $kontrola;
	} ?></p>
</div>
</div>
<br>
<div>
	<p for='value3' style="font-size:medium;"><b><?php echo date('d-m-Y'); ?></b></p>
	<div id="value3" class='value' style="font-size:medium;"><b>Prim. dr D.Brankovic<b></div>
	</div>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>