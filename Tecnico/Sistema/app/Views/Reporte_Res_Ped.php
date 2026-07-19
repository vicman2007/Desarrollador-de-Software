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
$this->cell(60,25,utf8_decode("Reporte Reseña por Pedido"),0,0,"C");
$this->Ln(20);
$this->Ln(20);
$this->Cell(25,15,"Nombre",1,0,"C",0);
$this->Cell(60,15,"Producto",1,0,"C",0);
$this->Cell(25,15,"Estado",1,0,"C",0);
$this->Cell(65,15,"Observacion",1,1,"C",0); 
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
   pe.nombreUsuario,
   pe.productosAñadidos,
   pe.Estado,
   re.ObservacionProducto
from Pedidos pe
join reseña re on pe.idCarrito = re.idReseña;";
$resultado=$mysqli->query("$consulta");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont("Arial","B",9);
while ($row=$resultado->fetch_assoc()) {
$pdf->Cell(25,10,$row["nombreUsuario"],1,0,"c",0);
$pdf->Cell(60,10,$row["productosAñadidos"],1,0,"c",0);
$pdf->Cell(25,10,$row["Estado"],1,0,"c",0);
$pdf->Cell(65,10,$row["ObservacionProducto"],1,1,"c",0);
}
$pdf->Output();
?>