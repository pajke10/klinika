<!-- stranica za kreiranje nove posete -->
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
	$pomocna_dg=$_POST['pomocne_dg'];
	$napomena=$_POST['napomena'];
	$ishrana=$_POST['ishrana'];
	$kontrola=$_POST['kontrola'];
	$starost=$_POST['starost'];
	// $aktivna=0;
		 $stmt = $mysqli->prepare("INSERT INTO `poseta_ped`(`id_doktora`,`id_pacijenta`, `pt`, `anamneza`, `k_status`, `neuro_nal`, `otos_nal`, `echo_cns`, `echo_kukova`,`pomocna_dg`, `th`, `napomena`, `ishrana`, `kontrola`, `starost`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		 $stmt->bind_param('iisssssssssssss', $id_doktora, $id_pacijenta_p, $pt, $anamneza, $k_status, $neuro_nal, $otos_nal,$echo_cns,$echo_kukova,$pomocna_dg,$th,$napomena,$ishrana,$kontrola,$starost);
		$stmt->execute();
		echo '<script>alert("Uspesno kreirana poseta");</script>';
		header("Location: doktor.php");
	
}


?>
