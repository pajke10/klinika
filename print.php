		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Lista zakazanih</title>
			<link rel="stylesheet" href="css/jquery-ui.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" href="css/p.css" media="print">
		</head>
		<body>
			
			<div class="container">
				<div class="row" style="margin-left:1px;margin-top: 10px; margin-right: 1px;">			
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align: center;">Broj</th>
								<th style="text-align: center;">Pacijent</th>
								<th style="text-align: center;">Datum</th>
								<th style="text-align: center;">Vreme</th>
								<th style="text-align: center;">Napomena</th>
								<th style="text-align: center;">Doktor</th>
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
									$query = "SELECT b.name_p,b.resource_id,b.email,b.phone,b.date,b.timeslot, r.id,r.name from zakazivanje b inner join doktori r on b.resource_id = r.id where  r.id = $doktor and b.date = '$fdate' ";						
									$data = mysqli_query($mysqli,$query) or die('error');							
									if (mysqli_num_rows($data) > 0) {
										while ($row=mysqli_fetch_assoc($data)) {
											$date_new=$row['date'];
											$ddate=strtotime($date_new);
											$ddate=date('d/m/Y', $ddate);							
											$name = $row['name_p'];
											$napomena = $row['email'];
											$doktor = $row['name'];
											$phone = $row['phone'];											
											$time = $row['timeslot'];
											$i++;						
											?>
											<tr>
												<td style="text-align: center;"><?php echo $i ?></td>
												<td style="text-align: center;"><?php echo $name ?></td>
												<td style="text-align: center;"><?php echo $ddate ?></td>
												<td style="text-align: center;"><?php echo $time ?></td>
												<td style="text-align: center;"><?php echo $napomena ?></td>
												<td style="text-align: center;"><?php echo $doktor ?></td>
												<td style="text-align: center;"><?php echo $phone ?></td>

											</tr>
										<?php }
									}else{ ?>
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
							<a href="proba.php" id="print-btnn" class="btn btn-warning">Nazad</a>
						</div>
					</div>
				</div>		
			</div>
		</body>
		</html>