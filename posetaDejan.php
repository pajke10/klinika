<!-- kreiranje posete da kardiologiji -->
<?php 
include "db.php";
include "posetaDejanInsertovanje.php";
session_start();
if (isset($_GET['poseta'])) {
	$_SESSION['id_doce'];
	$id_pacijenta_poseta = $_GET['poseta'];
	$upit="SELECT * FROM pacijent WHERE id_p=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id_pacijenta_poseta);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();	
	$id_pacijenta_p=$row['id_p'];
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

	<!-- Title Page-->
	<title>Kreiranje posete</title>

	<!-- Font special for pages-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
					<h6 class="title" style="color:black; text-align:center; font-size:22px">Pacijent: <?php if (isset($ime_pacijenta) & isset($prezime_pacijenta) & isset($datum)) {
						echo $ime_pacijenta . " " . $prezime_pacijenta . ", datum rodjenja: " . $datum;
					} ?></h6>
				</div>
				<div class="card-body">
					<form method="POST" action="posetaDejan.php">
						<div class="form-row">
							<input type="hidden" name="doktor_id" value="<?php echo $_SESSION['id_doce']; ?>">
							<input type="hidden" name="pacijent_id" value="<?php echo $id_pacijenta_p; ?>">
							<div class="name">DG</div>
							<div class="value">
								<div class="col-md-6">
									<select name="select_box" class="form-select" id="select_box">
										<option value="">Izaberi dijagnozu</option>
										<?php 
										$query = "Select * from mkb";
										$result = $mysqli->query($query); 
										foreach($result as $row){
											echo '<option value="'.$row["id_dijagnoze"].'">'.$row["Dijagnoza"]." " . $row["LNaziv"].'</option>';
										}

										?>  
									</select>
								</div>
							</div>
						</div>
						<div class="form-row" style="border:1px solid black;">
							<div class="name">Pomocne dijagnoze</div>
								<div class="value">
									<div class="input-group">
										<textarea class="textarea--style-6" name="pomocne_dg" placeholder=""></textarea>
									</div>
								</div>
								<br>
							</div>
						</div> 
						<div class="form-row">
							<div class="name">Anamneza</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="anamneza" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">Objektivno</div>
							<div class="value">
								<input class="input--style-6" type="text" name="objektivno">
							</div>
						</div>
						<div class="form-row">
							<div class="name">EKG: </div>
							<div class="value">
								<input class="input--style-6" type="text" name="ekg">
							</div>
						</div>
						<div class="form-row">
							<div class="name">EHOKARDIOGRAFSKI PREGLED: </div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="eho" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">TERAPIJA</div>
							<div class="value">
								<div class="input-group">
									<textarea class="textarea--style-6" name="th" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="name">Napomena</div>
							<div class="value">
								<input class="input--style-6" type="text" name="napomena">
							</div>
						</div>

					</div>
					<div class="card-footer">
						<button class="btn btn-primary" type="submit" name="kreiraj_posetu_dejan">Kreiraj posetu</button>
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
<script>
	var select_box_element = document.querySelector('#select_box_1');
	dselect(select_box_element, {
		search: true
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$(".multiple-select").select2({
  // maximumSelectionLength: 2
});
</script>