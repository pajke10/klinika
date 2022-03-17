<!-- stranica za kreiranje posete za pedijatriju -->
<?php 
include "db.php";
if (isset($_POST['kreiraj_posetu_sablon'])) {
	$id_doktora = $_POST['doktor_id'];
	$pt=$_POST['pt'];
	$id_pacijenta_p=$_POST['pacijent_id'];
	if (isset($_POST['anamneza'])) {
		$anamneza=$_POST['anamneza'];
	}
	if (isset($_POST['echo_cns'])) {
		$echo_cns=$_POST['echo_cns'];
	}
	if (isset($_POST['echo_kukova'])) {
		$echo_kukova=$_POST['echo_kukova'];
	}
		if (isset($_POST['anamneza'])) {
		$anamneza=$_POST['anamneza'];
	}

	$k_status=$_POST['k_status'];
	$neuro_nal=$_POST['neuro_nal'];
	$otos_nal=$_POST['otos_nal'];
	$th=$_POST['th'];
	if (isset($select_box)) {
		$select_box=$_POST['select_box'];
	}
	$pomocna_dg=$_POST['pomocne_dg'];
	$napomena=$_POST['napomena'];
	$ishrana=$_POST['ishrana'];
	$kontrola=$_POST['kontrola'];
	$sablon=$_POST['sablon'];
	$starost=$_POST['starost'];
	if ($select_box==0) {
		$select_box=39;
		$stmt = $mysqli->prepare("INSERT INTO `poseta_ped`(`id_doktora`,`id_pacijenta`, `pt`, `anamneza`, `k_status`, `neuro_nal`, `otos_nal`, `echo_cns`, `echo_kukova`, `id_dijagnoze`,`pomocna_dg`, `th`, `napomena`, `ishrana`, `kontrola`,`sablon2`,`starost`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param('iisssssssisssssss', $id_doktora, $id_pacijenta_p, $pt, $anamneza, $k_status, $neuro_nal, $otos_nal,$echo_cns,$echo_kukova,$select_box,$pomocna_dg,$th,$napomena,$ishrana,$kontrola,$sablon,$starost);
		if ($stmt->execute()) {
			echo '<script>alert("Uspesno kreirana poseta");</script>';
			header("Location: doktor.php");
		}else{
			echo '<script>alert("Neuspesno ");</script>';
			header("Location: prepis.php");
		}
	}else{
		$stmt = $mysqli->prepare("INSERT INTO `poseta_ped`(`id_doktora`,`id_pacijenta`, `pt`, `anamneza`, `k_status`, `neuro_nal`, `otos_nal`, `echo_cns`, `echo_kukova`, `id_dijagnoze`,`pomocna_dg`, `th`, `napomena`, `ishrana`, `kontrola`,`sablon2`,`starost`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param('iisssssssisssssss', $id_doktora, $id_pacijenta_p, $pt, $anamneza, $k_status, $neuro_nal, $otos_nal,$echo_cns,$echo_kukova,$select_box,$pomocna_dg,$th,$napomena,$ishrana,$kontrola,$sablon,$starost);
		if ($stmt->execute()) {
			echo '<script>alert("Uspesno kreirana poseta");</script>';
			header("Location: doktor.php");
		}else{
			echo '<script>alert("Neuspesno ");</script>';
			header("Location: prepis.php");
		}
	}

	

	
	
	

}

?>
