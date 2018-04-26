<?php
    require('../fpdf.php');
    include('../../../conexion.php');  
    
    
$pdf = new FPDF();
$contPage = 1;
//CABECERA
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0, 0, 255);
$pdf->Image('../../../assets/images/letras.png', 10, 8, 50);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(70, 8, '', 0);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(30,10,'Aliados del software', 0);
$pdf->Cell(50, 8, '', 0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(40,10,'Fecha: '.date('d-m-Y').'', 100);
$pdf->Ln(8);
$pdf->Cell(160, 8, '', 0);
$pdf->Cell(30,10,'No. pag ' .$contPage, 0);

$pdf->Ln(20); //salto de línea


//REPORTE

//TITULO
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(120,10,'Reporte de categorias registradas', 0);
$pdf->Ln(15); //salto de línea

//COLUMNAS
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(170, 8, 'Nombre', 1, 0, 'C', true);


$pdf->Ln(8);

//FILAS
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0, 0, 0);


$ban = false;
$cont = 0;

foreach ($conexion->query('SELECT * from `categorias`') as $row){
    
    $pdf->Cell(18, 8, $row['id'], 0, 0, 'C', $ban);
    $pdf->Cell(170, 8, $row['nombre'], 0, 0, 'C', $ban);
    $pdf->Ln(14);
    $ban = !$ban;
    $cont+=1;
    if($cont >= 15){
        $cont=0;
        $contPage++;
        //CABECERA
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->SetTextColor(0, 0, 255);
        $pdf->Image('../../../assets/images/letras.png', 10, 8, 50);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(70, 8, '', 0);
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(30,10,'Aliados del software', 0);
        $pdf->Cell(50, 8, '', 0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(40,10,'Fecha: '.date('d-m-Y').'', 100);
        $pdf->Ln(8);
        $pdf->Cell(160, 8, '', 0);
        $pdf->Cell(30,10,'No. pag ' .$contPage, 0);

        $pdf->Ln(20); //salto de línea

        //TITULO
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(60, 8, '', 0);
        $pdf->Cell(120,10,'Reporte de clientes registrados', 0);
        $pdf->Ln(15); //salto de línea
        
        //COLUMNAS
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(100,100,100);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(170, 8, 'Nombre', 1, 0, 'C', true);

        //FILAS
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(240,240,240);
        $pdf->SetTextColor(0, 0, 0);
    }
}

//REPORTES PAGOS ADMI

$pdf->Output();
?>