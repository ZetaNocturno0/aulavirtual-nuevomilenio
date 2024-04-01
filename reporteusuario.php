<?php
require('fpdf/fpdf.php');
include "clases/Usuario.class.php"; $objusu = new Usuario();
$idcliente = $_GET['variable'];

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(50);
    // Título
    $this->Cell(90,10,'Informacion de Usuario',1,10,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$lista = $objusu->LlamarUsuario($idcliente);
for($i=0;$i<count($lista); $i++){
	$pdf->Cell(50,10,Nombre,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["nombre"]." ".$lista[$i]["apellido"],1,1,'C',0);
	$pdf->Cell(50,10,Usuario,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["usuario"],1,1,'C',0);
	$pdf->Cell(50,10,Clave,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["clave"],1,1,'C',0);
	$pdf->Cell(50,10,DNI,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["dni"],1,1,'C',0);
	$pdf->Cell(50,10,Email,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["correo"],1,1,'C',0);
	$pdf->Cell(50,10,Telefono,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["telefono"],1,1,'C',0);
	$pdf->Cell(50,10,Direccion,0,0,'C',0);
	$pdf->Cell(120,10,$lista[$i]["direccion"],1,1,'C',0);
}

$pdf->Output();
?>