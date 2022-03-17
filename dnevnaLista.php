<?php 
include "db.php";
session_start();
if (isset($_POST['insert_dnevna'])) {
	// $dnevna_id=$_POST['dnevna_id'];
	$id_doktora=$_POST['id_doktora'];
	$id_pacijenta = $_SESSION['id_proba'];
	$datum = date("Y-m-d");
	$fdate = strtotime($datum);
	$fdate= date("Y-m-d", $fdate);	
	//proveravamo da li pacijent vec postoji u bazi podataka
	 $stmt = $mysqli->prepare("SELECT * FROM dnevna_lista where id_pacijenta = ? and id_doktora = ? and datum = ?");
	 $stmt->bind_param('iis',$id_pacijenta,$id_doktora,$fdate);
	if ($stmt->execute()) {
		$result=$stmt->get_result();
		if ($result->num_rows>0) {
			$_SESSION['status1']="Pacijent vec ubacen u dnevnu listu";	
			header("Location: pretragaPacijenataNew.php");
		}else{
			$stmt = $mysqli->prepare("INSERT INTO dnevna_lista (id_pacijenta, id_doktora,datum) VALUES (?,?,?)");
			$stmt->bind_param('iis', $id_pacijenta, $id_doktora, $fdate);
			if ($stmt->execute()) {
				$_SESSION['status']="Pacijent uspesno ubacen u dnevnu listu";
				// echo '<script>alert("Pacijent uspesno registrovan");</script>';
				header("Location: pretragaPacijenataNew.php");
			}else{				
				$_SESSION['status']="Pacijent nije ubacen u dnevnu listu";			
				header("Location: pretragaPacijenataNew.php");
			}
			
			
			$stmt->close();
			$mysqli->close();

		}
	}
}

?>
