<?php
    require('../fpdf.php');
    include('../../../conexion.php');  
    
    
$pdf = new FPDF();
$pdf->AliasNbPages();
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
$pdf->Cell(0,10,'No. Pag:  '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->Ln(20); //salto de línea


//REPORTE

//TITULO
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(120,10,'Reporte de pedidos por entregar', 0);
$pdf->Ln(15); //salto de línea

//COLUMNAS
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(18, 8, 'ID', 1, 0, 'L', true);
$pdf->Cell(60, 8, 'Cliente', 1, 0, 'L', true);
$pdf->Cell(55, 8, 'Domicilio', 1, 0, 'L', true);
$pdf->Cell(25, 8, 'Telefono', 1, 0, 'L', true);
$pdf->Cell(18, 8, 'Fecha', 1, 0, 'L', true);
$pdf->Cell(18, 8, 'Total', 1, 0, 'R', true);


$pdf->Ln(8);

//FILAS
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0, 0, 0);


$ban = false;
$cont = 0;

foreach ($conexion->query('SELECT * from `sales` where `status` = 0') as $row){
    $consulta = mysqli_query($conexion, "SELECT `idClient` FROM shopping_cart where id = ".$row['idShoppingCart']."");
    $idClient = mysqli_fetch_array($consulta);
    $consulta = mysqli_query($conexion, "SELECT `username`, `address`, `phone` FROM clients where id = ".$idClient['idClient']."");
    $clientRow = mysqli_fetch_array($consulta);
    
    $pdf->Cell(18, 8, $row['id'], 0, 0, 'L', $ban);
    $pdf->Cell(60, 8, $clientRow['username'], 0, 0, 'L', $ban);
    $pdf->Cell(55, 8, $clientRow['address'], 0, 0, 'L', $ban);
    $pdf->Cell(25, 8, $clientRow['phone'], 0, 0, 'L', $ban);
    $pdf->Cell(18, 8, $row['date'], 0, 0, 'L', $ban);
    $pdf->Cell(18, 8, $row['total'], 0, 0, 'R', $ban);
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
        $pdf->Cell(60, 8, 'Cliente', 1, 0, 'C', true);
        $pdf->Cell(55, 8, 'Domicilio', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'Fecha', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'Total', 1, 0, 'C', true);
        $pdf->Ln(8);

        //FILAS
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(240,240,240);
        $pdf->SetTextColor(0, 0, 0);
    }
}

//REPORTES PAGOS ADMI

$pdf->Output();

?>