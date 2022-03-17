<?php 
include "db.php";
if (isset($_POST['kreiraj_posetu_dejan'])) {
	$id_doktora = $_POST['doktor_id'];
	$id_pacijenta_p=$_POST['pacijent_id'];
	$anamneza=$_POST['anamneza'];
	$objektivno=$_POST['objektivno'];
	$ekg=$_POST['ekg'];
	$eho=$_POST['eho'];
	$th=$_POST['th'];
	$select_box=$_POST['select_box'];
	$pomocne_dg=$_POST['pomocne_dg'];
	$napomena=$_POST['napomena'];
	$stmt = $mysqli->prepare("INSERT INTO `poseta_dejan`(`id_doktora`,`id_pacijenta`, `id_dijagnoze`,`pomocna_dg`, `anamneza`, `objektivno`, `ekg`, `eho`, `th`, `napomena`) VALUES (?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param('iiisssssss', $id_doktora, $id_pacijenta_p, $select_box,$pomocne_dg ,$anamneza, $objektivno, $ekg, $eho,$th,$napomena);
	if ($stmt->execute()) {
		echo '<script>alert("Uspesno kreirana poseta");</script>';
		header("Location: doktorK.php");
	}else{
		echo '<script>alert("Neuspeh");</script>';
	}
	
}

?>
