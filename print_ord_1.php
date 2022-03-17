		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Provera popunjesti ordinacija</title>
			<link rel="stylesheet" href="css/jquery-ui.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
			<script type="text/javascript" src="js/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" href="css/p.css" media="print">
		</head>
		<body>
			
			<div class="container">
				<div class="row" style="margin-left:1px;margin-top: 3px; margin-right: 1px;">			
					<table class="table table-bordered">
						<thead>
							<tr>
								<th style="text-align: center;">Broj</th>
								<th style="text-align: center;">Pacijent</th>
								<th style="text-align: center;">Datum</th>
								<th style="text-align: center;">Vreme</th>
								<th style="text-align: center;">Doktor</th>
								<th style="text-align: center;">Ordinacija</th>														
							</tr>
						</thead>				
						<tbody>
							<?php include 'db.php';
							$i=0;
							if (isset($_GET['ooo'])) {	
								$ordinacija=$_GET['ooo'];
								$datum = date("Y/m/d");
								$fdate = strtotime($datum);
								$fdate= date("Y-m-d", $fdate);
								$query = "SELECT o.id,o.name_o,b.name_p,b.date,b.email,b.timeslot,r.id,r.name from ordinacija o join zakazivanje b on o.id = b.id_ord join doktori r on b.resource_id = r.id  where  o.id = $ordinacija and b.date = '$fdate' ";						
								$data = mysqli_query($mysqli,$query) or die('error');							
								if (mysqli_num_rows($data) > 0) {
									while ($row=mysqli_fetch_assoc($data)) {
										$date_new=$row['date'];
										$ddate=strtotime($date_new);
										$ddate=date('d/m/Y', $ddate);							
										$name = $row['name_p'];
										$napomena = $row['email'];
										$doktor = $row['name'];
										$ordinacija = $row['name_o'];
										$time = $row['timeslot'];
										$i++;						
										?>
										<tr>
											<td style="text-align: center;"><?php echo $i ?></td>
											<td style="text-align: center;"><?php echo $name ?></td>
											<td style="text-align: center;"><?php echo $ddate ?></td>
											<td style="text-align: center;"><?php echo $time ?></td>
											<td style="text-align: center;"><?php echo $doktor ?></td>
											<td style="text-align: center;"><?php echo $ordinacija ?></td>

										</tr>
									<?php }
								}else{ ?>
									<tr>
										<td>Za izabranu ordinaciju nema zakazanih pacijenata!!!</td>
									</tr>
									<?php 
								}
							}
							?>
						</tbody>
					</table>
					<div class="form-group">
						<label class="col-lg-2 control-label"></label>
						<div class="col-lg-4">
							<button onclick="window.print();" class="btn btn-primary" id="print-btna">Stampaj</button>
							<a href="fakturisanje.php" id="print-btnn" class="btn btn-warning">Nazad</a>
						</div>
					</div>
				</div>		
			</div>
		</body>
		</html>