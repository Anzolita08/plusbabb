<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  

    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de usuarios ',0,0,'C');
    // Salto de línea
    $this->Ln(20);

$this->Cell(50, 10, 'Nombre',1,0, 'C',0);
$this->Cell(80, 10, 'Nombre De usuario',1,0, 'C',0);
$this->Cell(60, 10, 'Ultima conexion',1,1, 'C',0);
}
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


require 'conexion.php';
$consulta = "SELECT * FROM users";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while ($row = $resultado->fetch_assoc()) {
 $pdf->Cell(50, 10, $row['name'],1,0, 'C',0);
 $pdf->Cell(80, 10, $row['username'],1,0, 'C',0);
$pdf->Cell(60,10, $row['last_login'],1,1, 'C',0);
}


$pdf->Output();
?>
