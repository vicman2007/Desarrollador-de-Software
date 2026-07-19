<?php
require('fpdf/fpdf.php');
class PDF extends FPDF
{
function Header()
{
$this->Image("../ASSETS/img/logo.png",10,10,33);
$this->SetFont('Arial','B',12);
        $this->SetXY(40,10);
        $this->Cell(100,5,'Reposteria Misves',0,1);

$this->SetFont('Arial','',10);
$this->SetX(40);
$this->Cell(100,5, utf8_decode('Dirección: Calle 123 #45-67, Bogotá'), 0, 1);
$this->SetX(40);
$this->Cell(100,5, utf8_decode('Teléfono: +57 300 123 4567'), 0, 1);

$this->Ln(10);
$this->cell(80);
$this->cell(60,25,utf8_decode("Reporte Productos"),0,0,"C");
$this->Ln(20);
$this->Ln(20);
$this->Cell(12,15,"COD",1,0,"C",0);
$this->Cell(38,15,"Nombre",1,0,"C",0);
$this->Cell(70,15,utf8_decode("Descripción"),1,0,"C",0);
$this->Cell(15,15,"Precio",1,0,"C",0);
$this->Cell(10,15,"Img",1,0,"C",0);
$this->Cell(20,15,"cantidad",1,0,"C",0);
$this->Cell(20,15,"Estado",1,0,"C",0);
$this->Cell(10,15,"ID",1,1,"C",0); 
}
function Footer()
{
$this->SetY(-15);
$this->SetFont("Arial","I",11);
$this->cell(0,10,utf8_decode("Página").$this->PageNo()."/{nb}",0,0,"C");
}
}
require"../MODEL/bd.php";
$consulta  ="select*from producto ;";
$resultado=$mysqli->query("$consulta");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","B",9);
while ($row=$resultado->fetch_assoc()) {
$pdf->Cell(12,10,$row["CodProducto"],1,0,"c",0);    
$pdf->Cell(38,10,$row["NombreProducto"],1,0,"c",0);
$pdf->Cell(70,10,$row["DescripcionProducto"],1,0,"c",0);
$pdf->Cell(15,10,$row["Precio"],1,0,"c",0);
$pdf->Cell(10,10,$row["ImagenProducto"],1,0,"c",0);
$pdf->Cell(20,10,$row["stock"],1,0,"c",0);
$pdf->Cell(20,10,$row["EstadoProducto"],1,0,"c",0);
$pdf->Cell(10,10,$row["idReseñaFK"],1,1,"c",0);
}
$pdf->Output();
?>