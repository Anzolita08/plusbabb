 <?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  

    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de proveedores con sus productos',0,0,'C');
    // Salto de línea
    $this->Ln(20);


$this->Cell(60, 10, 'id',1,1, 'C',0);
$this->Cell(60, 10, 'NIT',1,1, 'C',0);
$this->Cell(60, 10, 'Nombre',1,1, 'C',0);
$this->Cell(60, 10, 'NombreArchivo',1,1, 'C',0);
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
$consulta = "SELECT provider.Name, media.NombreArchivo FROM products JOIN media ON provider.media_id = media.id JOIN provider ON provider.provider_NIT = provider.NIT";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while ($row = $resultado->fetch_assoc()) {
$pdf->Cell(60,10, $row['id'],1,1, 'C',0);
$pdf->Cell(60,10, $row['NIT'],1,1, 'C',0);
$pdf->Cell(60,10, $row['name'],1,1, 'C',0);
$pdf->Cell(60,10, $row['file_name'],1,1, 'C',0);
}


$pdf->Output();
?>
