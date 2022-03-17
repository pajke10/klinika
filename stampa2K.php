<?php 

// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Database Connection 
include "db.php";
session_start();
//Check for connection error
// Select data from MySQL database
if (isset($_GET['prepis_kardio'])) {
	$id=$_GET['prepis_kardio'];
	$upit="select po.id_posete_dejan,po.id_doktora,po.id_dijagnoze,po.pomocna_dg,po.anamneza,po.objektivno, po.ekg,po.eho,po.th,po.napomena,po.datumPosete,m.id_dijagnoze,m.Dijagnoza,m.LNaziv,p.id_p,p.ime,p.prezime,p.datumRodjenja from mkb m join poseta_dejan po on m.id_dijagnoze = po.id_dijagnoze join pacijent p  on p.id_p = po.id_pacijenta where po.id_posete_dejan=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	$ime = $row['ime'];
	$id_pacijenta_p=$row['id_p'];
	$id_posete_dejan=$row['id_posete_dejan'];
	$prezime = $row['prezime'];
	$select_box=$row['id_dijagnoze'];
	$pomocna_dg=$row['pomocna_dg'];
	$Dijagnoza=$row['Dijagnoza'];
	$LNaziv=$row['LNaziv'];
	$anamneza=$row['anamneza'];
	$objektivno=$row['objektivno'];
	$ekg=$row['ekg'];
	$eho=$row['eho'];
	$th=$row['th'];
	$napomena=$row['napomena'];
	$datumRodjenja=$row['datumRodjenja'];
	$datum = date('d-m-Y',strtotime($datumRodjenja));
	$datumPosete=$row['datumPosete'];
	$datum_poseta = date('d-m-Y',strtotime($datumPosete));
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

	<!-- Title Page-->
	<title>Kreiranje posete kardiologija</title>

	<!-- Font special for pages-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
	<script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
	<script src="library/dselect.js"></script>

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
					<form method="POST" action="posetaDejan.php">
						<div class="form-row">
							<input type="hidden" name="doktor_id" value="<?php echo $_SESSION['id_doce']; ?>">
							<input type="hidden" name="pacijent_id" value="<?php echo $id_pacijenta_p; ?>">
							<div class="name">DG</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" readonly name="anamneza" placeholder=""><?php if (isset($Dijagnoza) || isset($LNaziv)) {
										echo $Dijagnoza . " " . $LNaziv;
									} ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">Pomocna dijagnoza</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" readonly name="pomocna_dg" placeholder=""><?php if (isset($pomocna_dg)) {
										echo $pomocna_dg;
									} ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">Anamneza</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" readonly name="anamneza" placeholder=""><?php if (isset($anamneza)) {
										echo $anamneza;
									} ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">Objektivno</div>
							<div class="value">
								<input class="input--style-6" type="text" readonly name="objektivno" value="<?php if (isset($objektivno)) {
									echo $objektivno;
								} ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="name">EKG: </div>
							<div class="value">
								<input class="input--style-6" type="text" readonly name="ekg" value="<?php if (isset($ekg)) {
									echo $ekg;
								} ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="name">EHOKARDIOGRAFSKI PREGLED: </div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="eho" readonly placeholder=""><?php if (isset($eho)) {
										echo $eho;
									} ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">TERAPIJA</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="th" readonly placeholder=""><?php if (isset($th)) {
										echo $th;
									} ?></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">Napomena</div>
							<div class="value">
								<input class="input--style-6" type="text" readonly name="napomena" value="<?php if (isset($napomena)) {
									echo $napomena;
								} ?>">
							</div>
						</div>

					</div>
					<div class="card-footer">
						<a href="stampaaK.php?stampa=<?php echo $id_posete_dejan;?>" class="btn btn--radius-2 btn--blue-2">Stampaj posetu</a>
						<a href="prepisK.php?prepis_k=<?php echo $id_posete_dejan;?>" class="btn btn--radius-2 btn--blue-2">Prepisi posetu</a>
						<a href="doktorK.php" class="btn btn--radius-2 btn--blue-2">Nazad</a>
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
