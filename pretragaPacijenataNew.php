<?php include "db.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<title>Simeunovic</title>
</head>
<style>
	label{
		font-weight: bold;
		font-size: 20px;
	}
	h3,h1{
		text-align: center;
		color: black;
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
	<!-- ################################################## ADD ############################################################ -->
	<div class="modal fade" id="studentaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registruj novog pacijenta</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="insert.php" method="POST">
					<div class="modal-body">				
						<div class="form-group">
							<label>Ime</label>
							<input type="text" class="form-control"  name="ime" placeholder="Unesite ime" required>
						</div>
						<div class="form-group">
							<label>Prezime</label>
							<input type="text" class="form-control"  name="prezime" placeholder="Unesite prezime" required>
						</div>
						<div class="form-group">
							<label>Datum rodjenja</label>
							<input type="date" class="form-control"  name="datum" placeholder="" required>
						</div>
						<div class="form-group">
							<label>Telefon</label>
							<input type="number" maxlength="13" class="form-control"  name="telefon" placeholder="Unesite telefon pacijenta" required>
						</div>
						<div class="form-group">
							<label>Adresa</label>
							<input type="text" class="form-control"  name="adresa" placeholder="Nije obavezno polje!!!">
						</div>
						<div class="form-group">
							<label>Ime jednog roditelja</label>
							<input type="text" class="form-control"  name="ime_roditelja" placeholder="Nije obavezno polje!!!">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
						<button type="submit" name="insertdata" class="btn btn-primary">Dodaj</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ################################################## ADD ############################################################ -->

	<!-- 	####################################### EDIT ################################################## -->

	<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Izmene podataka pacijenta</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="updatecode.php" method="POST">
					<input type="hidden" name="update_id" id="update_id" >
					<div class="modal-body">

						<div class="form-group">
							<label>Ime</label>
							<input type="text" class="form-control"  name="ime" id="ime" placeholder="">
						</div>
						<div class="form-group">
							<label>Prezime</label>
							<input type="text" class="form-control"  name="prezime" id="prezime" placeholder="">
						</div>
						<div class="form-group">
							<label>Datum rodjenja</label>
							<input type="date" class="form-control"  name="datum" id="datum" placeholder="">
						</div>
						<div class="form-group">
							<label>Telefon</label>
							<input type="number" class="form-control"  name="telefon" id="telefon" placeholder="">
						</div>
						<div class="form-group">
							<label>Adresa</label>
							<input type="text" class="form-control"  name="adresa" id="adresa" placeholder="">
						</div>
						<div class="form-group">
							<label>Ime roditelja</label>
							<input type="text" class="form-control"  name="ime_roditelja" id="ime_roditelja" placeholder="">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
						<button type="submit" name="updatedata" class="btn btn-primary">Izmeni</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	<!-- ####################################### EDIT ################################################## -->

	<!-- 	####################################### Dnevna ################################################## -->

	<div class="modal fade" id="dnevnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Dodaj pacijenta u dnevnu listu</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="dnevnaLista.php" method="POST">
					<input type="hidden" name="dnevna_id" id="dnevna_id">
					<div class="modal-body">
						<div class="form-group">
							<select name="id_doktora" required class="form-control">
								<option value="">Izaberi doktora</option>
								<?php include "db.php";
								$sql= "SELECT * FROM doktori order by name asc";				
								$result = mysqli_query($mysqli,$sql) or die('error');
								if (mysqli_num_rows($result)>0) {
									$_SESSION['doktor']= $row['id'];
									while ($row=mysqli_fetch_assoc($result)) { ?>									
										<option  value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
									<?php }
								}	
								?>							
							</select>
						</div>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
						<button type="submit" name="insert_dnevna" class="btn btn-primary">Dodaj</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	<!-- ####################################### Dnevna ################################################## -->

	<!-- ####################################### NAV START ################################################## -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="calendar.php">Profmedika</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="proba.php">Zakazani pregledi <span class="sr-only"></span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="proba_ordinacija.php">Pregled ordinacija</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="pretragaPacijenataN.php">Registracija pacijenta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="marina.php">ZA MARINU</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="#"><b>sestra: <?php                  
					echo $_SESSION['users'];
				?></b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="logout.php"><b>Odjavi se</b></a>
			</li>
		</ul>
	</div>
</nav>
<!-- ####################################### NAV END ################################################## -->

<div class="container">
	<div class="row">
		<div class="">
			<form class="proba" method="post" action="pretragaPacijenataNew.php">
				<table class="table">
					<thead>				
						<th scope="col">ID</th>
						<th scope="col">Ime</th>
						<th scope="col">Prezime</th>
						<th scope="col">Datum rodjenja</th>
						<th scope="col">Telefon</th>
						<th scope="col">Adresa</th>
						<th scope="col">Ime roditelja</th>
						<th scope="col"></th>										
						<th scope="col"></th>										
						<th scope="col"></th>										
						<th scope="col"></th>										
					</thead>
					<?php 
//provera pocetak

					if (isset($_POST['proveri'])){
						$imeP=$_POST['imeP'];
						$prezimeP=$_POST['prezimeP'];
						$datumRodjenjaP=$_POST['datumRodjenjaP'];
						if (empty($imeP) || empty($prezimeP) || empty($datumRodjenjaP)) {
							echo '<script>alert("Morate popuniti sva tri parametra");</script>';	
						}else{
							$stmt = $mysqli->prepare("SELECT * from pacijent where ime = ? and prezime = ? and datumRodjenja = ?");
							$stmt->bind_param('sss',$imeP,$prezimeP,$datumRodjenjaP);

							if ($stmt->execute()) {
								$result=$stmt->get_result();
								if ($result->num_rows>0) {
									while ($row=$result->fetch_assoc()) { ?>
										<?php $ime=$row['ime']; ?>
										<?php $prezime=$row['prezime']; ?>								
										<?php $datum=$row['datumRodjenja']; ?>
										<?php $brojTelefona=$row['brojTelefona']; ?>
										<?php $adresa=$row['adresa']; ?>
										<?php $ime_roditelja=$row['ime_roditelja']; ?>
										<?php $_SESSION['id_proba']=$row['id_p']; 									
// $datum= strtotime($datum);
// $datum= date('d-m-Y', $datum);
										global $datum;							
										global $id_p;

										?>

										<tr>
											<td><?php echo $row['id_p']; ?></td>
											<td><?php echo $row['ime']; ?></td>
											<td><?php echo $row['prezime']; ?></td>	
											<td><?php echo $row['datumRodjenja']; ?></td>
											<td><?php echo $row['brojTelefona']; ?></td>
											<td><?php echo $adresa; ?></td>
											<td><?php echo $ime_roditelja; ?></td>
											<td><button type="button" class="form-control btn btn-success editbtn">Izmeni</button></td>
											<td><button type="button" class="btn btn-warning dnevnabtn" name="unos">Dnevna lista</button></td>
											<td><a href="pregledPosetaS.php?sestra=<?php echo $row['id_p'];?>" class="btn btn-danger">Posete Opsta</a></td>
											<td><a href="pregledPosetaSP.php?sestra=<?php echo $row['id_p'];?>" class="btn btn-danger">Posete Pedijatrija</a></td>
										</tr>

									<?php 	} 
								}else{
									echo '<script>alert("Nepostoji pacijent sa tim parametrima");</script>';
								}
							}	 ?>

							<?php
						}
					}
//provera pocetak
					?>
					<div class="col-lg-4 mx-auto">	
						<?php if (isset($_SESSION['status'])) { ?>
							<div class="alert alert-success" style="text-align:center;" role="alert">

								<?php echo $_SESSION['status'];
								unset($_SESSION['status']); ?>
							</div>
						<?php } ?>

						<?php if (isset($_SESSION['status1'])) { ?>
							<div class="alert alert-danger" style="text-align:center;" role="alert">

								<?php echo $_SESSION['status1'];
								unset($_SESSION['status1']); ?>
							</div>
						<?php } ?>				
						<h1>Pretraga pacijenta</h1>
						<input type="hidden" name="id" id="id_po"  value="<?php echo $id; ?>">
						<div class="form-group">
							<label>Izaberi pacijenta</label>
							<select required name="" class="form-control" id="patient_select">
								<option value=""></option>
								<?php 
								$stmt = $mysqli->prepare("select * from pacijent");
								$stmt->execute();
								$result = $stmt->get_result();
								while($row = $result->fetch_assoc()){
									$prikazDatuma=$row['datumRodjenja'];
									$prikazDatuma= date('d-m-Y',strtotime($prikazDatuma))
									?>
									<option data-test="<?php echo $row['datumRodjenja']; ?>" data-test1="<?php echo $row['ime']; ?>" data-test2="<?php echo $row['prezime']?>" value="<?php echo $row['id_p']; ?>"><?php echo $row['ime'].' '.$row['prezime'].' '. $prikazDatuma; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Ime</label>
							<input type="text"  name="imeP" id="test1" class="form-control" placeholder=" " value="<?php if(isset($imeP)){
								echo $imeP;	
							}  ?>">
						</div>
						<div class="form-group">
							<label>Prezime</label>
							<input type="text" name="prezimeP" id="test2" class="form-control" value="<?php if(isset($prezimeP)){
								echo $prezimeP;	
							}  ?>" placeholder=" ">
						</div>
						<div class="form-group">
							<label>Datum rodjenja</label>
							<input type="date" name="datumRodjenjaP" id="test" class="form-control" value="<?php if(isset($datumRodjenjaP)){
								echo $datumRodjenjaP;	
							}  ?>" placeholder="">
						</div>							
						<div class="form-group" style="margin-top:15px;">
							<button type="submit" class="btn btn-danger" name="proveri">Pretraga</button>
							<button type="button" style="color: white; font-weight: bold;" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#studentaddmodal">
								Nova registracija
							</button>
							<input type="button" class="btn btn-light" value="Osvezi" onClick="refresh(this)">
						</div>
					</div>
				</table>									
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<!-- edit -->	
	<script>
		$(document).ready(function() {
			$('.editbtn').on('click', function(){
				$('#editmodal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);
				update_id
				$('#update_id').val(data[0]);
				$('#ime').val(data[1]);
				$('#prezime').val(data[2]);
				$('#datum').val(data[3]);
				$('#telefon').val(data[4]);
				$('#adresa').val(data[5]);
				$('#ime_roditelja').val(data[6]);

			});
		});
	</script>
	<!-- edit end -->	

	<!-- dnevna start -->
	<script>
		$(document).ready(function() {
			$('.dnevnabtn').on('click', function(){
				$('#dnevnaModal').modal('show');
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);

				$('#id_doktora').val(data[0]);


			});
		});
	</script>
	<!-- dnevna end -->


	<script>
		$(document).ready(function() {        
			$('#patient_select').select2({
				placeholder:'Select',
				width:'100%'
			});
		});

		$("#patient_select").change(function(){
			var test2 = $(this).find(':selected').data('test2');
			var test1 = $(this).find(':selected').data('test1');
			var test = $(this).find(':selected').data('test');

			$("#test2").val(test2);
			$("#test1").val(test1);
			$("#test").val(test);

		})


	</script>




	<script>
		function refresh(){
			window.location.reload("Refresh")
		}
	</script>
</body>
</html>