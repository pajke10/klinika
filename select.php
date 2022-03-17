<?php 

if (isset($_POST['employee_id'])) {
	$output = '';
	$datum = date("Y-m-d");
	$fdate = strtotime($datum);
	$fdate= date("Y-m-d", $fdate);
	
	$ordinacija = $_POST['employee_id'];
	$connect = mysqli_connect("localhost","root","","proba_ssss");	
	// $query ="SELECT o.id,o.name_o,b.name_p,b.date,b.email,b.timeslot,r.id,r.name from ordinacija o join bookings b on o.id = b.id_ord join resources r on b.resource_id = r.id  where  b.date = $datum and o.id = $ordinacija";
	$query= "SELECT o.id,o.name_o,b.name_p,b.date,b.email,b.timeslot,r.id,r.name from ordinacija o join zakazivanje b on o.id = b.id_ord join doktori r on b.resource_id = r.id  where o.id = $ordinacija and  b.date = '$fdate'";
	$result = mysqli_query($connect,$query);
	$output .= '  
	<div class="table-responsive">  
	<table class="table table-bordered">';  
	while($row = mysqli_fetch_array($result))  
	{  
		$output .= '  
		<tr>  
		<td width="30%"><label>Ordinacija</label></td>  
		<td width="70%">'.$row["name_o"].'</td>  
		</tr>  
		<tr>  
		<td width="30%"><label>Datum</label></td>  
		<td width="70%">'.$row["date"].'</td>  
		</tr>  
		<tr>  
		<td width="30%"><label>Vreme</label></td>  
		<td width="70%">'.$row["timeslot"].'</td>  
		</tr>  
		<tr>  
		<td width="30%"><label>Doktor</label></td>  
		<td width="70%">'.$row["name"].'</td>  
		</tr>   
		';  
	}  
	$output .= "</table></div>";  
	echo $output;  
}

?>
