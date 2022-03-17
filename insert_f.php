<!-- stranica za insertovanje fakture -->
<?php 
include "db.php";
session_start();
if (isset($_POST['insertdata'])) {
	$ime=$_POST['ime'];
	$prezime=$_POST['prezime'];
	$pacijent_id_f=$_POST['pacijent_id_f'];
	$doktor_id_f=$_POST['doktor_id_f'];
	$cena = $_POST['cena'];
	$popust = $_POST['popust'];
	$prikaz = "da";
	if (isset($popust)) {
		$zbir = $cena - ($cena * $popust) / 100;
	}else{
		$zbir+=$cena;
	}
	 $bla = $_POST['usluge'];
	 $tip_usluge= "";
	foreach ($bla as $item ) {
		$tip_usluge.=$item. " , ";
		}
		 $stmt = $mysqli->prepare("INSERT INTO fakturisanje (`id_doktora`, `id_pacijenta`, `tip_usluge`, `cena`, `popust`, `zbir`, `prikaz`) VALUES (?,?,?,?,?,?,?)");
		 $stmt->bind_param('iisssss', $doktor_id_f, $pacijent_id_f, $tip_usluge, $cena,$popust,$zbir,$prikaz);
		if ($stmt->execute()) {
			$_SESSION['status']="Pacijent uspesno registrovan";
				// echo '<script>alert("Pacijent uspesno registrovan");</script>';
			header("Location: usluge.php");
		}else{
			echo("Statement failed: ". $stmt->error . "<br>");;
		}

		$stmt->close();
		$mysqli->close();
	


}


?>