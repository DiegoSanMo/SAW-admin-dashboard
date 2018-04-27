<?php
    include('../../../conexion.php');  
    require('../fpdf.php');
    date_default_timezone_set('America/Monterrey');
    if (@$_POST['date1'] ) {
        $date = new DateTime($_POST['date1']);
        $date2 = new DateTime($_POST['date2']);
        $new_date = $date->format('Y-m-d');
        $new_date2 = $date2->format('Y-m-d');

        // echo $new_date;
        // $FI = $_POST['date1'];
        // $FF = $_POST['date2'];

        // //NUEVO formato de fechas
        // $date = date_create($FI);
        // $date2 = date_create($FF);

        // $nueva = date_format($date, 'Y-m-d');
        // $nueva2 = date_format($date2, 'Y-m-d');

         $time = strtotime($_POST['date1']);
         $time2 = strtotime($_POST['date2']);
        if ($time) {
            $new_date = date('y-m-d', $time);
            $new_date2 = date('y-m-d', $time2);
          
        } else {
            echo 'Invalid Date: ' . $_POST['date1'];
        // fix it.
        }
        
       
    }
    else{
        echo "<script> 
            alert('No se ha ingresado fecha');
        </script>";
    }
    
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
$pdf->Cell(90, 8, '', 0);
$pdf->Cell(120,10,"Pedidos realizados del ".$new_date. " hasta ".$new_date2."");
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
$cont = 0;
$total = 0;

foreach ($conexion->query(' SELECT 
                                delivery_order.id, 
                                clients.username,
                                clients.address,
                                delivery_man.name, 
                                delivery_order.date, 
                                sales.total
                            FROM 
                                delivery_order 
                            INNER JOIN delivery_man ON delivery_order.id = delivery_man.id 
                            INNER JOIN sales ON delivery_order.idSale = sales.id
                            INNER JOIN shopping_cart ON sales.idShoppingCart = shopping_cart.id
                            INNER JOIN clients ON shopping_cart.idClient = clients.id 
                            WHERE delivery_order.date BETWEEN "'.$new_date.'" AND "'.$new_date2.'";') as $row){
                                
    $pdf->Cell(18, 8, $row['id'], 0, 0, 'C', $ban);
    $pdf->Cell(75, 8, $row['username'], 0, 0, 'C', $ban);
    $pdf->Cell(65, 8, $row['address'], 0, 0, 'C', $ban);
    $pdf->Cell(65, 8, $row['name'], 0, 0, 'C', $ban);
    $pdf->Cell(25, 8, $row['date'], 0, 0, 'C', $ban);
    $pdf->Cell(25, 8, '$ ' . $row['total'], 0, 0, 'C', $ban);
    $pdf->Ln(14);
    $ban = !$ban;
    $total = $total + $row['total'];
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
        $pdf->Cell(90, 8, '', 0);
        $pdf->Cell(120,10,'Pedidos realizados del '.$nueva. ' hasta '.$nueva2.'');
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

        //FILAS
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(240,240,240);
        $pdf->SetTextColor(0, 0, 0);
    }    
}
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(235, 8, 'TOTAL:   $', 0, 0, 'R', $ban);
$pdf->Cell(38, 8, $total, 0, 0, 'R', $ban);

//REPORTES PAGOS ADMI

$pdf->Output();
?>