		<!-- stranica za pregleda dnevnih pregleda po doktoru -->
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Pregled odradjenih pregleda</title>
			<link rel="stylesheet" href="css/jquery-ui.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" href="css/pr.css" media="print">
		</head>
		<body>
			
			<div class="container">
				<div class="row" style="margin-left:1px;margin-top: 18px; margin-right: 1px;">			
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align: center;">Broj</th>
								<th style="text-align: center;">Doktor</th>
								<th style="text-align: center;">Ime</th>
								<th style="text-align: center;">Prezime</th>
								<th style="text-align: center;">Datum</th>								
								<th style="text-align: center;">Telefon</th>																
																			
							</tr>
						</thead>				
						<tbody>
							<?php include 'db.php';
							$i=0;
							if (isset($_POST['submit'])) {	
								$doktor=$_POST['doktor'];
								 $from_date=$_POST['from_date'];
							
								$fdate = strtotime($from_date);
								 $fdate= date("Y/m/d", $fdate);
								if ( $doktor != "" || $fdate != "") {
									 $query = "SELECT pp.id_doktora,pp.id_pacijenta,pp.datumPosete,r.id,r.name,p.id_p,p.ime,p.prezime,p.brojTelefona from poseta_ped pp join doktori r on pp.id_doktora = r.id join pacijent p on p.id_p=pp.id_pacijenta where pp.datumPosete = '$fdate' and pp.id_doktora = '$doktor' ";						
									$data = mysqli_query($mysqli,$query) or die('error');							
									if (mysqli_num_rows($data) > 0) {
										while ($row=mysqli_fetch_assoc($data)) {
											$date_new=$row['datumPosete'];
											$ddate=strtotime($date_new);
											$ddate=date('Y/m/d', $ddate);							
											$name = $row['name'];									
											$ime = $row['ime'];
											$prezime = $row['prezime'];											
											$telefon = $row['brojTelefona'];
											$i++;						
											?>
											<tr>
												<td style="text-align: center;"><?php echo $i ?></td>
												<td style="text-align: center;"><?php echo $name ?></td>											
												<td style="text-align: center;"><?php echo $ime ?></td>
												<td style="text-align: center;"><?php echo $prezime ?></td>
												<td style="text-align: center;"><?php echo $ddate ?></td>
												<td style="text-align: center;"><?php echo $telefon ?></td>											
											</tr>
										<?php }?>
											<td style="text-align: center;">Ukupan broj pregleda <?php echo $i ?></td>
									<?php }else{ ?>

										<tr>
											<td>Za izabranog doktora i termin, nema zakazanih pacijenata!!!</td>
										</tr>
									<?php }
								}else{
									echo '<script>alert("Morate popuni oba polja");</script>';
								}
							}
							?>
						</tbody>
					</table>
					<div class="form-group">
						<label class="col-lg-2 control-label"></label>
						<div class="col-lg-4">
							<button onclick="window.print();" class="btn btn-primary" id="print-btna">Stampaj</button>
							<a href="marina.php" id="print-btnn" class="btn btn-warning">Nazad</a>
						</div>
					</div>
				</div>		
			</div>
		</body>
		</html>