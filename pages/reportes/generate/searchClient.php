<?php

if (@$_POST['opc']) {
    $user = $_POST['opc'];
    $consultaSQL='SELECT * FROM clients WHERE username = ".$user.";';
    $resultados=mysqli_query($conexion,$consultaSQL);
    $clientRow = mysqli_fetch_array($resultados);
    
    echo $clientRow['id'];
    
}
else{
    echo "<script> 
        alert('No estoy entrando');
    </script>";
}
require('../fpdf.php');
include('../../../conexion.php');

$pdf = new FPDF();
$pdf->AliasNbPages();
//CABECERA
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0, 0, 255);
$pdf->Image('../../../assets/images/letras.png', 10, 8, 50);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(65, 8, '', 0);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65,10,'Aliados del software', 0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(55,10,'Fecha: '.date('d-m-Y').'', 100);
$pdf->Cell(0,10,'No. Pag:  '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->Ln(15); //salto de línea


//REPORTE

//TITULO
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(120,10,'Historial de compra de '.$user.'', 0);
$pdf->Ln(15); //salto de línea

//COLUMNAS
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(100, 8, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Total', 1, 0, 'C', true);


$pdf->Ln(8);

//FILAS
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0, 0, 0);


$ban = false;
$total = 0;
$cont = 0;
foreach ($conexion->query('SELECT 
                                sales.`id`,
                                clients.username, 
                                sales.`date`, 
                                sales.`total`
                            FROM `sales` 
                            INNER JOIN shopping_cart ON shopping_cart.id = sales.idShoppingCart 
                            INNER JOIN clients on clients.id = shopping_cart.idClient 
                            WHERE STATUS = 1 AND clients.username = "'.$user.'";
') as $row){
//   $consulta = mysqli_query($conexion, "SELECT `name` FROM brands where id = ".$row['idBrand']."");
//   $brandRow = mysqli_fetch_array($consulta);
//   $consulta = mysqli_query($conexion, "SELECT `nombre` FROM categorias where id = ".$row['idCategory']."");
//   $categoryRow = mysqli_fetch_array($consulta);

  $pdf->Cell(18, 8, $row['id'], 0, 0, 'L', $ban);
  $pdf->Cell(100, 8, $row['username'], 0, 0, 'L', $ban);
  $pdf->Cell(35, 8, $row['date'], 0, 0, 'L', $ban);
  $pdf->Cell(35, 8, '$ ' . $row['total'], 0, 0, 'R', $ban);
  $total = $total + $row['total'];
  $ban = !$ban;
  $pdf->Ln(8);

  $cont+=1;
    if($cont >= 15){
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
                
        //TITULO
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(100, 8, '', 0);
        $pdf->Cell(120,10,'Reporte de pedidos por entregar', 0);
        $pdf->Ln(15); //salto de línea
        
        //COLUMNAS
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(100,100,100);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(100, 8, 'Nombre', 1, 0, 'C', true);
        $pdf->Cell(35, 8, 'Fecha', 1, 0, 'C', true);
        $pdf->Cell(35, 8, 'Total', 1, 0, 'C', true);
        $pdf->Ln(8);

        //FILAS
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(240,240,240);
        $pdf->SetTextColor(0, 0, 0);
    } 
  
}
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(153, 8, 'TOTAL:   $', 0, 0, 'R', $ban);
$pdf->Cell(35, 8, $total, 0, 0, 'R', $ban);


//REPORTES PAGOS ADMI

$pdf->Output();
?>