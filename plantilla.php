<?php
require('fpdf186/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    /*// Logo
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);*/
}

// Pie de página
function Footer()
{
    /*// Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');*/
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
$pdf->Image('img/logo.jpg',10,30,10);
$pdf->setXY(10,0);
$pdf->Cell(190,8,utf8_decode('"2023: Año de Francisco Villa, El Revolucionario del Pueblo y del Bicentenario del Heroico Colegio Militar".'),0,0,'C',0);
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->SetX(10);
$pdf->Cell(190,8,utf8_decode('Dir. Gral. Educ. Mil. y Rec. U.D.E.F.A.'),0,0,'C',0);
$pdf->Ln(8);
$pdf->Cell(15,8,utf8_decode('Colegio del Aire.'),0,0,'C',0);
$pdf->Ln(5);
$pdf->Cell(28.5,8,utf8_decode('Esc. Mil. de Manto. y Ab.'),0,0,'C',0);
$pdf->Cell(310,8,utf8_decode('Zapopan, Jal.'),0,0,'C',0);
$pdf->Ln(5);
$pdf->Cell(20,8,utf8_decode('Sección Académica'),0,0,'C',0);
$pdf->Cell(318,8,utf8_decode('11 noviembre 2023'),0,0,'C',0);
$pdf->Ln(5);
$pdf->Cell(190,8,utf8_decode('Distribución de tiempo para la semana del 04 al 09 sept. 2023.'),0,0,'C',0);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,8,utf8_decode('Sargentos 1/os. F.A.E.M.A. C.I. (1/er. Semestre)'),0,0,'C',0);
$pdf->Ln(8);
$pdf->SetX(2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,6,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('Lunes'),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('Martes'),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('Miercoles'),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('Jueves'),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('Viernes'),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('Sabado'),1,0,'C',0);
$pdf->Ln(6);
$pdf->SetX(2);
$pdf->Cell(25,6,utf8_decode('05:00-5:30'),1,0,'C',0);
$pdf->Cell(180,6,utf8_decode('Levante'),1,0,'C',0);
$pdf->Ln(6);
$pdf->SetX(2);
$pdf->Cell(25,6,utf8_decode('05:30-6:00'),1,0,'C',0);
$pdf->Cell(180,6,utf8_decode('Lista de Diana'),1,0,'C',0);
$pdf->Ln(6);
$pdf->SetX(2);
$pdf->Cell(25,6,utf8_decode('06:00-6:50'),1,0,'C',0);
$pdf->Cell(150,6,utf8_decode('Instrucción de Orden Cerrado.'),1,0,'C',0);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,6,utf8_decode('Actividades del Gpo. Ar. E.M.M.A.'),1,0,'C',0);
$pdf->Ln(6);
$pdf->SetX(2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,6,utf8_decode('07:00-7:50'),1,0,'C',0);
$pdf->Cell(180,6,utf8_decode('Comedor'),1,0,'C',0);
$pdf->Ln(6);
$pdf->SetX(2);
$pdf->Cell(25,18,utf8_decode('08:00-8:50'),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->SetFont('Arial','',6);
$pdf->MultiCell(30,6,utf8_decode('Actividades de limpieza de Armamento Individual (Manto. 1er. Escalon)'),1,'C',0);
$pdf->Ln(6);
$pdf->SetXY(2,80);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,9,utf8_decode(''),'B',0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->SetXY(2,89);
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,18,utf8_decode('09:00-9:50'),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode('Educación Fisica'),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->SetFont('Arial','',5);
$pdf->Cell(30,9,utf8_decode('Actividades del Gpo. Ar. E.M.M.A.'),1,0,'C',0);
$pdf->Ln(6);
$pdf->SetXY(2,98);
$pdf->Cell(25,9,utf8_decode(''),'B',0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);
$pdf->Cell(30,9,utf8_decode(''),1,0,'C',0);






/*for($i=1;$i<=4;$i++){
    $pdf->setX(30);
    $pdf->Cell(0,10,utf8_decode('Imprimiendo línea número '),1,1);
}*/
$pdf->Output();
?>