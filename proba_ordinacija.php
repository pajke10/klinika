<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lista popunjenosti ordinacija</title>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="p.css" media="print">
	<script>
		$( function() {
			$( "#from" ).datepicker();
		} );
	</script>
	<script>
		$( function() {
			$( "#to" ).datepicker();
		} );
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">	
			<h3 style="color:white;">Lista popunjenosti ordinacija</h3>
		</div>
	</nav>
	<div class="container">	
		<h3 style="text-align:center; font-weight:bold;">Lista popunjenosti ordinacija</h3>
		<div class="row">
			<form class="form-horizontal" action="print_ord.php" method="POST">
				<div class="form-group">
					<label class="col-lg-2 control-label">Ordinacija</label>
					<div class="col-lg-4">
						<select name="ordinacija" required class="form-control">
							<option value="">Izaberi ordinaciju</option>
							<?php include "db.php";
							$sql= "SELECT * FROM ordinacija order by name_o desc";				
							$result = mysqli_query($mysqli,$sql) or die('error');
							if (mysqli_num_rows($result)>0) {
								while ($row=mysqli_fetch_assoc($result)) { ?>									
									<option  value="<?php echo $row['id'] ?>"><?php echo $row['name_o'] ?></option>
								<?php }
							}	
							?>							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Izaberite datum</label>
					<div class="col-lg-4">
						<input type="text" name="from_date" id="from" class="form-control" required autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label"></label>
					<div class="col-lg-4">
						<input type="submit" name="submit" class="btn btn-primary" value="Odaberi">
						<a href="pretragaPacijenataNew.php" class="btn btn-danger">Nazad</a>
					</div>
				</div>
			</form>
		</div>

	</div>
</body>
</html>