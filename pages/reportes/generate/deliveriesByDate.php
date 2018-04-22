<?php
    require('../fpdf.php');
    include('../../../conexion.php');  
    
    if (@$_POST['date1']) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
    }
    else{
        echo "<script> 
            alert('No estoy entrando');
        </script>";
    }


    
$pdf = new FPDF('L','mm','A4');
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

$pdf->Ln(15); //salto de línea

//REPORTE

//TITULO
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(90, 8, '', 0);
$pdf->Cell(120,10,'Pedidos realizados del '.$date1. ' hasta '.$date2.'');
$pdf->Ln(15); //salto de línea

//COLUMNAS
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(18, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(75, 8, 'Cliente', 1, 0, 'C', true);
$pdf->Cell(65, 8, 'Domicilio', 1, 0, 'C', true);
$pdf->Cell(65, 8, 'repartidor', 1, 0, 'C', true);
$pdf->Cell(25, 8, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(25, 8, 'Total', 1, 0, 'C', true);


$pdf->Ln(8);

//FILAS
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(0, 0, 0);


$ban = false;
foreach ($conexion->query(' SELECT 
                                delivery_order.id, 
                                clients.username,
                                clients.address,
                                delivery_man.name, 
                                delivery_order.date, 
                                sales.total
                            FROM 
                                `delivery_order` 
                            INNER JOIN delivery_man ON delivery_order.id = delivery_man.id 
                            INNER JOIN sales ON delivery_order.idSale = sales.id
                            INNER JOIN shopping_cart ON sales.idShoppingCart = shopping_cart.id
                            INNER JOIN clients ON shopping_cart.idClient = clients.id 

                            WHERE delivery_order.date BETWEEN '.$date1.' AND '.$date2.'') as $row){

    $pdf->Cell(18, 8, $row['id'], 0, 0, 'C', $ban);
    $pdf->Cell(75, 8, $row['username'], 0, 0, 'C', $ban);
    $pdf->Cell(65, 8, $row['address'], 0, 0, 'C', $ban);
    $pdf->Cell(65, 8, $row['name'], 0, 0, 'C', $ban);
    $pdf->Cell(25, 8, $row['date'], 0, 0, 'C', $ban);
    $pdf->Cell(25, 8, '$ ' . $row['total'], 0, 0, 'C', $ban);
    $pdf->Ln(14);
    $ban = !$ban;
}

//REPORTES PAGOS ADMI

$pdf->Output();
?>