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
$this->cell(60,25,utf8_decode("Reporte Usuario"),0,0,"C");
$this->Ln(20);
$this->Ln(20);
$this->Cell(10,15,"ID",1,0,"C",0);
$this->Cell(28,15,"Nombre",1,0,"C",0);
$this->Cell(10,15,"TD",1,0,"C",0);
$this->Cell(20,15,"Num Doc",1,0,"C",0);
$this->Cell(39,15,"correo",1,0,"C",0);
$this->Cell(21,15,utf8_decode("Dirección"),1,0,"C",0);
$this->Cell(22,15,"Telefono",1,0,"C",0);
$this->Cell(15,15,"Estado",1,0,"C",0);
$this->Cell(25,15,utf8_decode("Contraseña"),1,0,"C",0);
$this->Cell(9,15,"Rol",1,1,"C",0); 
}
function Footer()
{
$this->SetY(-15);
$this->SetFont("Arial","I",11);
$this->cell(0,10,utf8_decode("Página").$this->PageNo()."/{nb}",0,0,"C");
}
}
require"../MODEL/bd.php";
$consulta  ="select*from usuario";
$resultado=$mysqli->query("$consulta");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","B",9);
while ($row=$resultado->fetch_assoc()) {
$pdf->Cell(10,10,$row["idUsuario"],1,0,"c",0);    
$pdf->Cell(28,10,$row["nombreUsuario"],1,0,"c",0);
$pdf->Cell(10,10,$row["tipodocumento"],1,0,"c",0);
$pdf->Cell(20,10,$row["NoDoc"],1,0,"c",0);
$pdf->Cell(39,10,$row["correoUsuario"],1,0,"c",0);
$pdf->Cell(21,10,$row["direccionUsuario"],1,0,"c",0);
$pdf->Cell(22,10,$row["telefonoUsuario"],1,0,"c",0);
$pdf->Cell(15,10,$row["estadoUsuario"],1,0,"c",0);
$pdf->Cell(25,10,$row["contraseña"],1,0,"c",0);
$pdf->Cell(9,10,$row["idRolFK"],1,1,"c",0);
}
$pdf->Output();
?>