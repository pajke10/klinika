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
	$dg=$_POST['dg'];
	$napomena=$_POST['napomena'];
	$select_box=$_POST['select_box'];
	$pomocna_dg=$_POST['pomocna_dg'];
	// if (empty($pt) || empty($anamneza) || empty($k_status) || empty($neuro_nal) || empty($otos_nal) || empty($echo_cns) || empty($echo_kukova) || empty($th) || empty($napomena) || empty($ishrana) ||empty($kontrola)) {
	// 	echo '<script>alert("Morate popuni sva polja");</script>';
	// }
	$stmt = $mysqli->prepare("INSERT INTO `poseta_dejan`(`id_doktora`,`id_pacijenta`, `id_dijagnoze`,`pomocna_dg`,`anamneza`, `objektivno`, `ekg`, `eho`, `th`, `napomena`) VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param('iiissssss', $id_doktora, $id_pacijenta_p, $select_box,$pomocna_dg,$anamneza, $objektivno, $ekg, $eho,$th,$napomena);
	if ($stmt->execute()) {
		echo '<script>alert("Uspesno kreirana poseta");</script>';
		header("Location: doktorK.php");
	}else{
		echo '<script>alert("Neuspeh");</script>';
	}
	
}

?>
