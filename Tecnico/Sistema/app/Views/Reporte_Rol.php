<?php
require('fpdf/fpdf.php');
class PDF extends FPDF
{
function Header()
{
$this->Image("../ASSETS/img/logo.png",10,10,33);
$this->SetFont("Arial","B",12);
$this->cell(80);
$this->cell(60,25,("Reporte Rol"),0,0,"C");
$this->Ln(20);
$this->Ln(20);
$this->Cell(25,15,"ID",1,0,"C",0);
$this->Cell(60,15,"Descripcion",1,1,"C",0); 
}
function Footer()
{
$this->SetY(-15);
$this->SetFont("Arial","I",11);
$this->cell(0,10,utf8_decode("Página").$this->PageNo()."/{nb}",0,0,"C");
}
}
require"../MODEL/bd.php";
$consulta  ="select*from rol";
$resultado=$mysqli->query("$consulta");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","B",9);
while ($row=$resultado->fetch_assoc()) {
$pdf->Cell(25,10,$row["idRol"],1,0,"c",0);
$pdf->Cell(60,10,$row["DescripcionRol"],1,1,"c",0);
}
$pdf->Output();
?>