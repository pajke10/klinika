<?php 
include "db.php";
if (isset($_POST['kreiraj_posetu'])) {
	$id_doktora = $_POST['doktor_id'];
	$pt=$_POST['pt'];
	$id_pacijenta_p=$_POST['pacijent_id'];
	$anamneza=$_POST['anamneza'];
	$k_status=$_POST['k_status'];
	$neuro_nal=$_POST['neuro_nal'];
	$otos_nal=$_POST['otos_nal'];
	$echo_cns=$_POST['echo_cns'];
	$echo_kukova=$_POST['echo_kukova'];
	$th=$_POST['th'];
	$select_box=$_POST['select_box'];
	$pomocna_dg=$_POST['pomocna_dg'];
	$napomena=$_POST['napomena'];
	$ishrana=$_POST['ishrana'];
	$kontrola=$_POST['kontrola'];
	// if (empty($pt) || empty($anamneza) || empty($k_status) || empty($neuro_nal) || empty($otos_nal) || empty($echo_cns) || empty($echo_kukova) || empty($th) || empty($napomena) || empty($ishrana) ||empty($kontrola)) {
	// 	echo '<script>alert("Morate popuni sva polja");</script>';
	// }
	$stmt = $mysqli->prepare("INSERT INTO `poseta_ped`(`id_doktora`,`id_pacijenta`, `pt`, `anamneza`, `k_status`, `neuro_nal`, `otos_nal`, `echo_cns`, `echo_kukova`, `id_dijagnoze`,`pomocna_dg`, `th`, `napomena`, `ishrana`, `kontrola`, `starost`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param('iisssssssissssss', $id_doktora, $id_pacijenta_p, $pt, $anamneza, $k_status, $neuro_nal, $otos_nal,$echo_cns,$echo_kukova,$select_box,$pomocna_dg,$th,$napomena,$ishrana,$kontrola,$starost);
	if ($stmt->execute()) {
		echo '<script>alert("Uspesno kreirana poseta");</script>';
		header("Location: doktor.php");
	}else{
		echo '<script>alert("Neuspesno ");</script>';
		header("Location: prepis.php");
	}
	
}

?>
