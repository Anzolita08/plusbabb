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
    $this->SetTextColor(0,80, 180);
    // Título
    $this->Cell(70,10,'USUARIOS REGISTRADOS ',0,0,'C');
    // Salto de línea
    $this->Ln(20);

$this->SetTextColor(50,70, 70);
$this->Cell(70,10,'fecha- reporte: '.date('d-m-Y').'', 0,0, 'C');
$this->Ln(20);
$this->SetDrawColor(0, 80, 180);
$this->SetTextColor(220,50, 50);
$this->Cell(80, 10, 'Nombre',1,0, 'C',0);
$this->Cell(80, 10, 'tipo de usuario',1,1, 'C',0);
$this->Image('Imagenes/plus.JPG', 170, 5, 20, 20, 'JPG');
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
$consulta = "SELECT name, username from users";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->SetDrawColor(0, 80, 180);

while ($row = $resultado->fetch_assoc()) {
 $pdf->Cell(80, 10, $row['name'],1,0, 'C',0);
 $pdf->Cell(80, 10, $row['username'],1,1, 'C',0);
}


$pdf->Output();
?>
