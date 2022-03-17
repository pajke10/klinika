<?php 

// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Database Connection 
include "db.php";
//Check for connection error
// Select data from MySQL database
if (isset($_GET['stampa'])) {
	$id=$_GET['stampa'];
	$upit="select po.id_posete_dejan,po.id_doktora,po.id_dijagnoze,po.pomocna_dg,po.anamneza,po.objektivno, po.ekg,po.eho,po.th,po.napomena,po.datumPosete,m.id_dijagnoze,m.Dijagnoza,m.LNaziv,p.id_p,p.ime,p.prezime,p.datumRodjenja from mkb m join poseta_dejan po on m.id_dijagnoze = po.id_dijagnoze join pacijent p  on p.id_p = po.id_pacijenta where po.id_posete_dejan=?";
	$stmt=$mysqli->prepare($upit);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();
	$ime = $row['ime'];
	$prezime = $row['prezime'];
	$brojKartona=$row['id_p'];
	$select_box=$row['id_dijagnoze'];
	$Dijagnoza=$row['Dijagnoza'];
	$LNaziv=$row['LNaziv'];;
	$anamneza=$row['anamneza'];
	$pomocna_dg=$row['pomocna_dg'];
	$objektivno=$row['objektivno'];
	$ekg=$row['ekg'];
	$eho=$row['eho'];
	$th=$row['th'];
	$napomena=$row['napomena'];
	$datumRodjenja=$row['datumRodjenja'];
	$datum = date('Y',strtotime($datumRodjenja));
	$datumPosete=$row['datumPosete'];
	$datum_poseta = date('d-m-Y',strtotime($datumPosete));
	$space = "&nbsp";
}

// Take PDF contents in a variable
$pdfcontent = '';
$pdfcontent .='<br><br><br><h4 style="text-align:center">'. strtoupper($row['ime']) . " " . strtoupper($prezime) . ", " . $datum . " god. " . '</h4><br/>';
$pdfcontent .= '<strong>DIJAGNOZA:</strong>'  . " " . $LNaziv . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>POMOĆNE DIJAGNOZE:</strong>'  . " " . $pomocna_dg . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>ANAMNEZA:</strong>'  . " " . $anamneza . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>OBJEKTIVNO</strong>'  . " " . $objektivno . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>EKG</strong>'  . " " . $ekg . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>EHOKARDIOGRAFSKI PREGLED: </strong>'  . " " . $eho . " ". ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>TERAPIJA</strong>'  . " " . $th . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<strong>NAPOMENA</strong>'  . " " . $napomena . ' <br>';
$pdfcontent .= '<br>';
$pdfcontent .= '<table autosize>';
$pdfcontent .= '<tr>
<td colspan="1"><strong>'.  $datum_poseta.'</strong></td>
<td style="padding-left:180px"><strong>Doc Dr Dejan Simeunović Spec int med - Kardiolog</strong></td>
</tr>
</table>';
$mpdf->WriteHTML($pdfcontent);

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 

//call watermark content and image
$mpdf->SetWatermarkText('Profmedika');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

//output in browser
$mpdf->Output();		
?>