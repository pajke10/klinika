<!-- stranica za stampanje poseta -->
<?php 

// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
  $mpdf->SetMargins(1, 1, 1, 1);
// Database Connection 
include "db.php";
//Check for connection error
// Select data from MySQL database
if (isset($_GET['stampa'])) {
	$id=$_GET['stampa'];
	echo $upit="select po.id_posete_ped,po.starost,po.id_doktora,po.pt,po.sablon2,po.anamneza,po.k_status, po.pomocna_dg ,po.neuro_nal,po.otos_nal,po.echo_cns,po.echo_kukova,po.id_dijagnoze,po.th,po.napomena,po.ishrana,po.kontrola,po.datumPosete,p.id_p,p.ime,p.prezime,p.datumRodjenja from  poseta_ped po  join pacijent p on p.id_p = po.id_pacijenta where po.id_posete_ped=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	$brojKartona=$row['id_p'];
	$ime = $row['ime'];
	$prezime = $row['prezime'];
	$pt=$row['pt'];
	$brojKartona=$row['id_p'];
	$anamneza=$row['anamneza'];
	$k_status=$row['k_status'];
	$neuro_nal=$row['neuro_nal'];
	$otos_nal=$row['otos_nal'];
	$echo_cns=$row['echo_cns'];
	$echo_kukova=$row['echo_kukova'];
	$th=$row['th'];
	$pomocna_dg=$row['pomocna_dg'];
	$napomena=$row['napomena'];
	$ishrana=$row['ishrana'];
	$kontrola=$row['kontrola'];
	$sablon2=$row['sablon2'];
	$starost=$row['starost'];
	$datumRodjenja=$row['datumRodjenja'];
	$datum = date('d-m-Y',strtotime($datumRodjenja));
	$datumP = date('d-m-Y');
	$datumPosete=$row['datumPosete'];
	$datum_poseta = date('d.m.Y',strtotime($datumPosete));
	$s = $row['pomocna_dg'];
	$arr = explode(",", $s);
	$str = "";
	foreach (array_chunk($arr,1) as $sub) {
		$str .=trim(implode(",", $sub)) . "<br>\n";
	}
	$sa = $row['th'];
	$arra = explode(",", $sa);
	$stra = "";
	foreach (array_chunk($arra,1) as $suba) {
		$stra .=trim(implode(",", $suba)) . "<br>\n";
	}
 
}
if ($sablon2=='da') {
 	// Take PDF contents in a variable
	$pdfcontent = '<br><br><br><br>';
$pdfcontent .='<br><br><br><br><br><h3 style="text-align:center;margin-bottom:55px;">'. strtoupper($row['ime']) . " " . strtoupper($prezime) . ", " . $starost . '</h3>';
$pdfcontent .= '<strong></strong>'  . " " . $pt . ' <br>';
$pdfcontent .= '<br>';
if (!empty($anamneza)) {
	$pdfcontent .= '<strong>ANAMNEZA</strong>'  . " " . $anamneza . ' <br>';
$pdfcontent .= '<br>';
}else{

}
$pdfcontent .= '<strong>KLINČKI STATUS</strong>'  . " " . $k_status . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>NEUROLOŠKI STATUS:</strong>'  . " " . $neuro_nal . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>OTOSKOPSKI STATUS</strong>'  . " " . $otos_nal . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>DIJAGNOZA</strong>'  . "<br> " . $str . '';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>TERAPIJA</strong>'  . "<br> " . $stra . " ". '';
if (!empty($napomena)) {
$pdfcontent .= '<strong>NAPOMENA</strong>'  . " " . $napomena . ' <br>';
$pdfcontent .= '<br>';
}else{
}
if(!empty($ishrana)){
$pdfcontent .= '<strong>ISHRANA</strong>'  . " " . $ishrana . ' <br>';
$pdfcontent .= '<br>';	
}
$pdfcontent .= '<strong>KONTROLA</strong>'  . " " . $kontrola . ' <br>';
$pdfcontent .= '<br><br><br><br>';
$pdfcontent .= '<table autosize>';
$pdfcontent .= '<tr>
<td colspan="1" style="font-size: 17px;"><strong>'.  $datum_poseta.'</strong></td>
<td style="padding-left:370px;font-size: 17px;"><strong>Prim dr D.BRANKOVIĆ</strong></td>
</tr>
</table>';
	$mpdf->WriteHTML($pdfcontent);

	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0; 


//output in browser
	$mpdf->Output();
}else{
// Take PDF contents in a variable
		$pdfcontent = '';
		$pdfcontent = '<br><br><br><br>';
$pdfcontent .='<br><br><br><br><br><h3 style="text-align:center">'. strtoupper($row['ime']) . " " . strtoupper($prezime) . ", " . $starost . '</h3><br/>';
$pdfcontent .= '<strong></strong>'  . " " . $pt . ' <br>';
$pdfcontent .= '<br>';
if (!empty($anamneza)) {
	$pdfcontent .= '<strong>ANAMNEZA</strong>'  . " " . $anamneza . ' <br>';
$pdfcontent .= '<br>';
}else{

}
$pdfcontent .= '<strong>KLINČKI STATUS</strong>'  . " " . $k_status . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>NEUROLOŠKI STATUS:</strong>'  . " " . $neuro_nal . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>OTOSKOPSKI STATUS</strong>'  . " " . $otos_nal . ' <br>';
$pdfcontent .= '<br>';
if (!empty($echo_cns)) {
$pdfcontent .= '<strong>ECHO CNS-a</strong>'  . " " . $echo_cns . ' <br>';
$pdfcontent .= '<br>';
}else{
$pdfcontent .= '';
}
if (!empty($echo_kukova)) {
$pdfcontent .= '<strong>ECHO KUKOVA</strong>'  . " " . $echo_kukova . ' <br>';
$pdfcontent .= '<br>';
}else{
$pdfcontent .= '';
}
$pdfcontent .= '<strong>DIJAGNOZA</strong>'  . "<br> " . $str . '';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>TERAPIJA</strong>'  . "<br> " . $stra . " ". '';
$pdfcontent .= '<br>';
if (!empty($napomena)) {
$pdfcontent .= '<strong>NAPOMENA</strong>'  . " " . $napomena . ' <br>';
$pdfcontent .= '<br>';
}else{
}
$pdfcontent .= '<strong>ISHRANA</strong>'  . " " . $ishrana . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>KONTROLA</strong>'  . " " . $kontrola . ' <br>';
$pdfcontent .= '<br><br><br>';
$pdfcontent .= '<table autosize>';
$pdfcontent .= '<tr>
<td colspan="1" style="font-size: 17px;"><strong>'.  $datum_poseta.'</strong></td>
<td style="padding-left:370px;font-size: 17px;"><strong>Prim dr D.BRANKOVIĆ</strong></td>
</tr>
</table>';
	$mpdf->WriteHTML($pdfcontent);

	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0; 


//output in browser
	$mpdf->Output();
}		
?>