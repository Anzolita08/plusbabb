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
    $this->Cell(70,10,'Categorias mas solicitadas ',0,0,'C');
    // Salto de línea
    $this->Ln(20);

$this->Cell(80, 10, 'Nombre',1,0, 'C',0);
$this->Cell(80, 10, 'Cantidad',1,1, 'C',0);
$this->Image('Imagenes/plus.JPG', 170, 5, 20, 20, 'JPG');}
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
$consulta = "SELECT c.name, count(s.product_id) as 'cant.productos' from sales as s 
join products as p on s.product_id=p.id
join categories as c on p.categorie_id=c.id group by s.product_id limit 3; ";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while ($row = $resultado->fetch_assoc()) {
 $pdf->Cell(80, 10, $row['name'],1,0, 'C',0);
 $pdf->Cell(80, 10, $row['cant.productos'],1,1, 'C',0);
}


$pdf->Output();
?>

?>