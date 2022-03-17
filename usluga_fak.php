		<?php 
		session_start();
		include "db.php";
		if (isset($_GET['ooo'])) {
			$id_doktora_=$_GET['ooo'];
			$datum = date("Y/m/d");
			$fdate = strtotime($datum);
			$fdate= date("Y-m-d", $fdate);
			$query = "SELECT o.id,o.name,b.id_dnevne_liste,b.id_doktora,b.id_pacijenta,b.datum,r.id_p,r.ime,r.prezime from doktori o join dnevna_lista b on o.id = b.id_doktora join pacijent r on b.id_pacijenta = r.id_p where b.datum = '$fdate' and o.id=$id_doktora_ ";						
			$data = mysqli_query($mysqli,$query) or die('error');							
			$row=mysqli_fetch_assoc($data);	
			$_SESSION['doktor_ime']=$row['name'];
			$_SESSION['doktor_id_fa']=$row['id'];
			$_SESSION['pacijent_id_fa']=$row['id_p'];
			$_SESSION['prezime_f']=$row['prezime'];
			$_SESSION['ime_f']=$row['ime'];
			$datum=$row['datum'];
			$fdate = strtotime($datum);
			$fdate= date("d-m-Y", $fdate);
			$_SESSION['datum_']=$fdate;
		}	
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
		<!-- ###############################Fakturisanje usluga############################  -->
		<body>	
			<div class="modal fade" id="studentaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Fakturisanje usluga</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="insert_f.php" method="POST">
							<div class="modal-body">	
								<div class="form-group">
									<input type="text" class="form-control"  name="pacijent_id_f" value="<?php echo $_SESSION['pacijent_id_fa'] ?>">
									<input type="text" class="form-control"  name="doktor_id_f" value="<?php echo $_SESSION['doktor_id_fa'] ?>">
								</div>			
								<div class="form-group">
									<label>Ime</label>
									<input type="text" class="form-control"  name="ime" value="<?php echo $_SESSION['ime_f']; ?>">
								</div>
								<div class="form-group">
									<label>Prezime</label>
									<input type="text" class="form-control"  name="prezime" value="<?php echo $_SESSION['prezime_f']; ?>">
								</div>
								<br>
								<div class="form-check">
									<input class="form-check-input" name="usluge[]" type="checkbox" value="Usluga_1"> Usluga 1 <br>		
									<input class="form-check-input" name="usluge[]" type="checkbox" value="Usluga_2"> Usluga 2 <br>						
									<input class="form-check-input" name="usluge[]" type="checkbox" value="Usluga_3"> Usluga 3 <br>
									<input class="form-check-input" name="usluge[]" type="checkbox" value="Usluga_4"> Usluga 4 <br>						
									<input class="form-check-input" name="usluge[]" type="checkbox" value="Usluga_5"> Usluga 5 <br>						
								</div>
								<div class="form-group">
									<label>Cena</label>
									<input type="text" class="form-control"  name="cena" placeholder="Uneiste cenu pregleda">
								</div>
								<div class="form-group">
									<label>Popust</label>
									<input type="text" class="form-control"  name="popust" placeholder="Uneiste cenu pregleda">
								</div>
								<br>
								<div class="form-group">
									<input type="checkbox" class="custom-control-input" id="ck1a" style="border: none; margin-left: 300px;">
									<label class="custom-control-label" for="ck1a" >
										<img src="simeun.png" alt="#" style="width:100px; height:100px;" class="img-fluid">
									</label>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
								<button type="submit" name="insertdata" class="btn btn-primary">Fakturisi</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ###############################Fakturisanje usluga############################ -->
			<div class="container">
				<div class="row" style="margin-left:1px;margin-top: 3px; margin-right: 1px;">	
					<h3>Fakturisanje usluga za doktora: <?php echo $_SESSION['doktor_ime'] . " na dan" . " " . $_SESSION['datum_']; ?> </h3>		
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align: center;">Broj</th>
								<th style="text-align: center;">Ime</th>
								<th style="text-align: center;">Prezime</th>
								<th style="text-align: center;">Datum</th>
								<th style="text-align: center;"></th>
								<th style="text-align: center;"></th>														
								<th style="text-align: center;">	<a href="usluge.php" id="print-btnn" class="btn btn-warning">Nazad</a></th>														
							</tr>
						</thead>				
						<tbody>
							<?php include 'db.php';
							$i=0;
							if (isset($_GET['ooo'])) {	
								$id_doktora_=$_GET['ooo'];
								$datum = date("Y/m/d");
								$fdate = strtotime($datum);
								$fdate= date("Y-m-d", $fdate);
								$query = "SELECT o.id,o.name,b.id_dnevne_liste,b.id_doktora,b.id_pacijenta,b.datum,r.id_p,r.ime,r.prezime from doktori o join dnevna_lista b on o.id = b.id_doktora join pacijent r on b.id_pacijenta = r.id_p where b.datum = '$fdate' and o.id=$id_doktora_ ";						
								$data = mysqli_query($mysqli,$query) or die('error');							
								if (mysqli_num_rows($data) > 0) {
									while ($row=mysqli_fetch_assoc($data)) {
										$date_new=$row['datum'];
										$ddate=strtotime($date_new);
										$ddate=date('d/m/Y', $ddate);							
										$ime = $row['ime'];
										$prezime = $row['prezime'];
										$doktor = $row['name'];
										$i++;						
										?>
										<tr>
											<td style="text-align: center;"><?php echo $i ?></td>
											<td style="text-align: center;"><?php echo $ime ?></td>
											<td style="text-align: center;"><?php echo $prezime ?></td>
											<td style="text-align: center;"><?php echo $ddate ?></td>
											<td style="text-align:center;"><button type="button" style="color: white; font-weight: bold;" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#studentaddmodal">
												Fakturisi 
											</button></td>
											<td style="text-align:center;"><button type="button" class="btn btn-warning dnevnabtn" name="unos">izmeni</button></td>
											<td style="text-align:center;"><button type="button" class="btn btn-danger dnevnabtn" name="unos">obrisi</button></td>
										</tr>
									<?php }
								}else{ ?>
									<tr>
										<td></td>
									</tr>
									<?php 
								}
							}
							?>
						</tbody>
					</table>
				</div>		
			</div>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>	
			<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		</body>
		</html>