<?php 
include "db.php";
session_start();
if (isset($_POST['updatedata'])) {
	$id = $_POST['update_id'];
	$ime=$_POST['ime'];
	$prezime=$_POST['prezime'];
	$adresa=$_POST['adresa'];
	$telefon=$_POST['telefon'];
	$ime_roditelja=$_POST['ime_roditelja'];
	$datum=$_POST['datum'];
	$datum = date('Y-m-d',strtotime($datum));
	$stmt = $mysqli->prepare("Update pacijent  set ime=?,prezime=?,datumRodjenja=?,brojTelefona=?,adresa=?,ime_roditelja=? where id_p = ? ");
	$stmt->bind_param('ssssssi',$ime,$prezime,$datum,$telefon,$adresa,$ime_roditelja,$id);	
	if ($stmt->execute()) {
		$_SESSION['status']="Uspesno promenjeni podaci";
		header("Location: pretragaPacijenataNew.php");
	}else{
		$_SESSION['status1']="Niste promenili podatke";
		header("Location: pretragaPacijenataNew.php");
	}
	$stmt->close();
	$mysqli->close();
}

?>