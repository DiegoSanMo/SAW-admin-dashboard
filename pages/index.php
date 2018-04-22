<?php
  
  include('../conexion.php');

  session_start();
  if(@$_SESSION['username']){
  $nombre = $_SESSION['username'];
  $id = $_SESSION['userId'];

  $valores = "SELECT COUNT(*) from sales WHERE `status` = 0";
  $lector = mysqli_query($conexion, $valores);
  $shoppingCartRow = mysqli_fetch_array($lector);

  $valores = "SELECT COUNT(*) from delivery_order WHERE idDeliveryMan = $id";
  $lectore = mysqli_query($conexion, $valores);
  $saleRow = mysqli_fetch_array($lectore);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../assets/images/letras.png" alt="" style="width: 150px"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">                
                <!-- /.dropdown -->
                <li><?php echo $nombre; ?></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">                        
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i> salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                        
                        <li>
                            <a href="index.php"><i class="fa fa-home fa-fw"></i> Inicio</a>
                        </li>   
                        <li>
                            <a href="catalogos/categorias.php"><i class="fa fa-align-left fa-fw"></i> Categorias</a>
                        </li> 
                        <li>
                            <a href="catalogos/brands.php"><i class="fa fa-folder fa-fw"></i> Marcas</a>
                        </li> 
                        <li>
                            <a href="catalogos/administrators.php"><i class="fa fa-user-plus fa-fw"></i> Administradores</a>
                        </li>                      
                        <li>
                            <a href="catalogos/delivery_man.php"><i class="fa fa-truck fa-fw"></i> Repartidores</a>
                        </li> 
                        <li>
                            <a href="catalogos/products.php"><i class="fa fa-table fa-fw"></i> Productos</a>
                        </li>       
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="reportes/generate/productsReport.php">Productos</a>
                                </li>
                                <li>
                                    <a href="reportes/generate/selectDelivery.php">Entregas por repartidor</a>
                                </li>
                                <li>
                                    <a href="reportes/generate/clients.php">Clientes</a>
                                </li>
                                <li>
                                    <a href="reportes/generate/salesReport.php">Pedidos por entregar</a>
                                </li>
                                <li>
                                    <a href="reportes/generate/date.php">Pedidos por fecha</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

<?php } 
else {
  echo "<script>window.history.pushState('', '', '../login.php');</script>";  
  echo "<script>location.reload();</script>"; 
}?>
