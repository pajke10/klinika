<!-- stranica za kreiranje novog pacijenta -->
<?php 
include "db.php";
session_start();
if (isset($_POST['insertdata'])) {
	$ime=$_POST['ime'];
	$prezime=$_POST['prezime'];
	$adresa=$_POST['adresa'];
	$telefon=$_POST['telefon'];
	$ime_roditelja=$_POST['ime_roditelja'];
	$datum=$_POST['datum'];
	$datum = date('Y-m-d',strtotime($datum));
	//proveravamo da li pacijent vec postoji u bazi podataka
	$stmt = $mysqli->prepare("SELECT * from pacijent where ime = ? and prezime = ? and datumRodjenja = ?");
	$stmt->bind_param('sss',$ime,$prezime,$datum);
	if ($stmt->execute()) {
		$result=$stmt->get_result();
		if ($result->num_rows>0) {
			$_SESSION['status1']="Pacijent vec postoji u bazi podataka";	
			header("Location: pretragaPacijenataNew.php");
		}else{
			$stmt = $mysqli->prepare("INSERT INTO pacijent (ime, prezime, datumRodjenja, brojTelefona, adresa,ime_roditelja) VALUES (?,?,?,?,?,?)");
			$stmt->bind_param('ssssss', $ime, $prezime, $datum, $telefon, $adresa,$ime_roditelja);
			if ($stmt->execute()) {
				$_SESSION['status']="Pacijent uspesno registrovan";
				// echo '<script>alert("Pacijent uspesno registrovan");</script>';
				header("Location: pretragaPacijenataNew.php");
			}else{
				$_SESSION['status']="Pacijent neuspesno registrovan";			
				header("Location: pretragaPacijenataNew.php");
			}
			
			
			$stmt->close();
			$mysqli->close();

		}
	}
}

?>