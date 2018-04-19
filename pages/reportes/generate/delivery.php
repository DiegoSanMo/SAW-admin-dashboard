<?php
    require('../fpdf.php');
    include('../../../conexion.php');  
    
    if (@$_POST['opc']) {
        $id = $_POST['opc'];

        $consultaSQL="SELECT * FROM `delivery_man` WHERE id = ".$id.";";
        $resultados=mysqli_query($conexion,$consultaSQL);
        $deliveryRow = mysqli_fetch_array($resultados);
        
    }
    else{
        echo "<script> 
            alert('No estoy entrando');
        </script>";
    }


    
$pdf = new FPDF();
//CABECERA
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0, 0, 255);
$pdf->Image('../../../assets/images/letras.png', 150, 8, 50);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(40,10,'Fecha: '.date('d-m-Y').'', 100);
$pdf->Ln(15); //salto de línea

//REPORTE

//TITULO
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(60, 8, '', 0);
$pdf->Cell(120,10,'Pedidos entregados por '.$deliveryRow['name'], 0);
$pdf->Ln(15); //salto de línea

//COLUMNAS
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(55, 8, 'Cliente', 1, 0, 'C', true);
$pdf->Cell(45, 8, 'Domicilio', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Total', 1, 0, 'C', true);


$pdf->Ln(8);

//FILAS
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0, 0, 0);


$ban = false;
foreach ($conexion->query('SELECT * from `delivery_order` WHERE idDeliveryMan = '.$deliveryRow['id'].'') as $row){
    $valores = "SELECT * FROM `sales` INNER JOIN shopping_cart ON shopping_cart.id = sales.idShoppingCart INNER JOIN clients ON shopping_cart.idClient = clients.id WHERE sales.id = ".$row['idSale'].";";
    $lector = mysqli_query($conexion, $valores);
    $salesRow = mysqli_fetch_array($lector);
  

    $pdf->Cell(18, 8, $row['id'], 0, 0, 'C', $ban);
    $pdf->Cell(55, 8, $salesRow['username'], 0, 0, 'C', $ban);
    $pdf->Cell(45, 8, $salesRow['address'], 0, 0, 'C', $ban);
    $pdf->Cell(35, 8, $salesRow['date'], 0, 0, 'C', $ban);
    $pdf->Cell(35, 8, '$ ' . $salesRow['total'], 0, 0, 'C', $ban);
    $pdf->Ln(14);
    $ban = !$ban;
}

//REPORTES PAGOS ADMI

$pdf->Output();
?>