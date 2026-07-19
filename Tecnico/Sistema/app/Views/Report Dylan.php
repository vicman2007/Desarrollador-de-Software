<?php
require('fpdf/fpdf.php');
class PDF extends FPDF
{
function Header()
{
$this->Image("../ASSETS/img/logo.png",10,10,33);
$this->SetFont("Arial","B",12);
$this->cell(80);
$this->cell(60,25,utf8_decode("Reporte Reseña/Usuario"),0,0,"C");
$this->Ln(20);
$this->Ln(20);
$this->Cell(35,15,"Nombre",1,0,"C",0);
$this->Cell(30,15,"Documento",1,0,"C",0);
$this->Cell(30,15,"Calificacion",1,0,"C",0);
$this->Cell(90,15,"Observacion",1,1,"C",0); 
}
function Footer()
{
$this->SetY(-15);
$this->SetFont("Arial","I",11);
$this->cell(0,10,utf8_decode("Página").$this->PageNo()."/{nb}",0,0,"C");
}
}
require"../MODEL/bd.php";
$consulta  ="select
   usu.nombreUsuario,
   usu.Tipodocumento,
   re.CalificacionProducto,
   re.ObservacionProducto
from usuario usu
join reseña re on usu.idUsuario = re.idReseña;";
$resultado=$mysqli->query("$consulta");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","B",12);
while ($row=$resultado->fetch_assoc()) {
$pdf->Cell(35,10,$row["nombreUsuario"],1,0,"c",0);
$pdf->Cell(30,10,$row["Tipodocumento"],1,0,"c",0);
$pdf->Cell(30,10,$row["CalificacionProducto"],1,0,"c",0);
$pdf->Cell(90,10,$row["ObservacionProducto"],1,1,"c",0);
}
$pdf->Output();
?>