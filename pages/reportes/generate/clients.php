<?php
    require('../fpdf.php');
    include('../../../conexion.php');  
    
    
$pdf = new FPDF();
$pdf->AliasNbPages();
$contPage = 1;
//CABECERA
$pdf->AddPage('L');
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0, 0, 255);
$pdf->Image('../../../assets/images/letras.png', 10, 8, 50);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(110, 8, '', 0);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Aliados del software', 0);
$pdf->Cell(50, 8, '', 0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(60,10,'Fecha: '.date('d-m-Y').'', 100);
$pdf->Cell(0,10,'No. Pag:  '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->Ln(20); //salto de línea


//REPORTE

//TITULO
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(120,10,'Reporte de clientes registrados', 0);
$pdf->Ln(15); //salto de línea

//COLUMNAS
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(80, 8, 'Cliente', 1, 0, 'C', true);
$pdf->Cell(95, 8, 'Domicilio', 1, 0, 'C', true);
$pdf->Cell(55, 8, 'Email', 1, 0, 'C', true);
$pdf->Cell(34, 8, 'Telefono', 1, 0, 'C', true);


$pdf->Ln(10);

//FILAS
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0, 0, 0);


$ban = false;
$cont = 0;

foreach ($conexion->query('SELECT * from `clients` ORDER BY username ASC') as $row){
    
    $pdf->Cell(18, 8, $row['id'], 0, 0, 'L', $ban);
    $pdf->Cell(80, 8, $row['username'], 0, 0, 'L', $ban);
    $pdf->Cell(95, 8, $row['address'], 0, 0, 'L', $ban);
    $pdf->Cell(55, 8, $row['email'], 0, 0, 'L', $ban);
    $pdf->Cell(34, 8, $row['phone'], 0, 0, 'R', $ban);
    $pdf->Ln(10);
    $ban = !$ban;
    $cont+=1;
    if($cont >= 13){
        $cont=0;
        $contPage++;
        //CABECERA
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','B',16);
        $pdf->SetTextColor(0, 0, 255);
        $pdf->Image('../../../assets/images/letras.png', 10, 8, 50);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(110, 8, '', 0);
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Aliados del software', 0);
        $pdf->Cell(50, 8, '', 0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(60,10,'Fecha: '.date('d-m-Y').'', 100);
        $pdf->Cell(0,10,'No. Pag:  '.$pdf->PageNo().'/{nb}',0,0,'C');

        $pdf->Ln(20); //salto de línea


        //REPORTE

        //TITULO
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(100, 8, '', 0);
        $pdf->Cell(120,10,'Reporte de clientes registrados', 0);
        $pdf->Ln(15); //salto de línea

        //COLUMNAS
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(100,100,100);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(80, 8, 'Cliente', 1, 0, 'C', true);
        $pdf->Cell(95, 8, 'Domicilio', 1, 0, 'C', true);
        $pdf->Cell(55, 8, 'Email', 1, 0, 'C', true);
        $pdf->Cell(34, 8, 'Telefono', 1, 0, 'C', true);


        $pdf->Ln(10);

        //FILAS
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(240,240,240);
        $pdf->SetTextColor(0, 0, 0);
    }
}

//REPORTES PAGOS ADMI

$pdf->Output();
?>