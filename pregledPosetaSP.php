<?php 
include "db.php";
session_start();
if (isset($_GET['sestra'])) {
	 $id=$_GET['sestra'];
	 $upit="select po.id_posete_ped,po.id_doktora,po.pt,po.anamneza,po.k_status, po.neuro_nal,po.otos_nal,po.echo_cns,po.echo_kukova,po.id_dijagnoze,po.th,po.napomena,po.ishrana,po.kontrola,po.datumPosete,p.id_p,p.ime,p.prezime,p.datumRodjenja from poseta_ped po join pacijent p  on p.id_p = po.id_pacijenta where po.id_pacijenta= ? order by po.datumPosete desc, po.id_posete_ped desc";	
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Pregled poseta</title>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- 	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
	body{
		height: 100%;
		background:url('logo2.jpg') no-repeat center center fixed;
		-webkit-background-size:cover;
		-moz-background-size:cover;
		background-size: color;

	}
</style>
<body>
	<!-- POP UP brisanje -->


	<!-- Modal -->

	<div class="container">
		<?php if (isset($_SESSION['status_poseta'])) { ?>
			<div class="alert alert-success" style="text-align:center;" role="alert">

				<?php echo $_SESSION['status_poseta'];
				unset($_SESSION['status_poseta']); ?>
			</div>
		<?php } ?>
		<h1 style="text-align: center;">Istorija poseta</h1>
		<div class="row justify-content-center">
			<!-- 			<form method="post" action="code.php"> -->
				<table class="table" id="table_field">
					<thead>
						<tr>																											
							<th>Pacijent ID</th>
							<th>Ime</th>
							<th>Prezime</th>							
							<th>Datum posete</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<?php 
					while ($row=$result->fetch_assoc()) { ?>
						<tr> 		
						 <?php $datum=$row['datumPosete']; 
						 	$datum = date('d-m-Y',strtotime($datum));
						 ?>											
							<td><?php echo $row['id_p']; ?></td>
							<td><?php echo $row['ime']; ?></td>
							<td><?php echo $row['prezime']; ?></td>							
							<td><?php echo $datum; ?></td>							
							<!-- 							<td><a href="stampaa.php?stampa=<?php echo $row['id_posete_ped'];?>" class="btn btn-warning">Pogledaj posetu</a></td> -->
							<td><a href="stampa2.php?prepis_p=<?php echo $row['id_posete_ped'];?>" class="btn btn-warning">Pregled posete</a></td>
							<td><a href="prepis.php?prepis_p=<?php echo $row['id_posete_ped'];?>" class="btn btn-secondary">Prepisi posetu</a></td>
							<td><a href="stampaa.php?stampa=<?php echo $row['id_posete_ped'];?>" class="fa fa-file-pdf-o" style="font-size:34px;color:red"></a></td>
						<?php }
						?>
						<td><a href="pretragaPacijenataNew.php" class="btn btn-secondary">Nazad</a></td>
					</tr>

				</table>
				<!-- 	</form> -->
			</div>	
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.deletebtn').on('click',function(){
				$('#deletemodel').modal('show');
			});

		});
	</script>