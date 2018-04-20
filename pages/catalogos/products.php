<?php
  include('../../conexion.php');    

  if (@$_POST['nombre'] && $_POST['file'] && $_POST['precio'] && $_POST['existencia'] && $_POST['categoria'] && $_POST['brand']) {
    
    $nombre = $_POST['nombre'];
    $file = $_POST['file'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];
    $categoria = $_POST['categoria'];
    $brand = $_POST['brand'];
    
    $consultaSQL="INSERT INTO `products`(`name`, `idBrand`, `idCategory`, `image`, `cost`, `stock`) VALUES('$nombre', $brand, $categoria, '$file', $precio, $existencia);";
    $resultados=mysqli_query($conexion,$consultaSQL);
    if ($resultados)
      echo "<script>alert('Insertado exitosamente');</script>";    
    else
      echo "<script>alert('Error');</script>";
  }
  $valores = "SELECT COUNT(*) from products";
  $lector = mysqli_query($conexion, $valores);
  $row = mysqli_fetch_array($lector);
  $id = $row[0]+1;
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
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a class="navbar-brand" href="index.php"><img src="../../assets/images/letras.png" alt="" style="width: 150px"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">                
                <!-- /.dropdown -->
                <li><?php //echo $nombre; ?></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
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
                                <a href="../index.php"><i class="fa fa-home fa-fw"></i> Inicio</a>
                            </li>   
                            <li>
                                <a href="../catalogos/categorias.php"><i class="fa fa-align-left fa-fw"></i> Categorias</a>
                            </li> 
                            <li>
                                <a href="../catalogos/brands.php"><i class="fa fa-folder fa-fw"></i> Marcas</a>
                            </li> 
                            <li>
                                <a href="../catalogos/administrators.php"><i class="fa fa-user-plus fa-fw"></i> Administradores</a>
                            </li>                      
                            <li>
                                <a href="../catalogos/delivery_man.php"><i class="fa fa-truck fa-fw"></i> Repartidores</a>
                            </li> 
                            <li>
                                <a href="../catalogos/products.php"><i class="fa fa-table fa-fw"></i> Productos</a>
                            </li>     
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="../reportes/generate/productsReport.php">Productos</a>
                                    </li>
                                    <li>
                                        <a href="../reportes/generate/selectDelivery.php">Entregas por repartidor</a>
                                    </li>
                                    <li>
                                        <a href="../reportes/generate/clients.php">Clientes</a>
                                    </li>
                                </ul>
                            </li>  
                        </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-header">Registro de productos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nuevo registro
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-9">
                                <form action="products.php" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">        
                                                <label for="id">ID</label><br>
                                                <?php
                                                    echo "<input type='text' class='form-control' placeholder='$id' readonly=''>";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" placeholder="Nombre del producto..." name="nombre">
                                            </div>
                                        </div>
                                    </div>                  

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <input type="text" class="form-control" id="precio" placeholder="Precio del producto..." name="precio">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="existencia">Existencia</label>
                                                <input type="number" class="form-control" id="existencia" placeholder="Existencia del producto..." name="existencia">
                                            </div>
                                        </div>      
                                    </div>    

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="categoria">Categoria</label>
                                                <select class= "form-control" name="categoria">
                                                    <?php 
                                                        foreach ($conexion->query('SELECT * from `categorias`') as $row){
                                                            echo "<option value= '".$row['id']."'>";
                                                            echo $row['nombre'];
                                                            echo "</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="brand">Marca</label>
                                            <select class= "form-control" name="brand">
                                            <?php 
                                                foreach ($conexion->query('SELECT * from `brands`') as $row){
                                                echo "<option value= '".$row['id']."'>";
                                                echo $row['name'];
                                                echo "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="btn-grabar">
                                    <input type="file" name="file" id="file" class="inputfile" />                    
                                </div> 
                            </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning">Registrar</button>
                                </div>
                            </form>
                                </div>
                            </div>
                            
                        </div>

                        <br>
                        <br>
                        <br>

                        <div class="panel-heading">
                            Productos registrados
                        </div>
                        <div class="container">
                        <!-- /.panel-heading -->
                        <div class="panel-body col-md-11">
                            <table width="95%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Categoria</th>
                                        <th>Costo</th>
                                        <th>Existencia</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                  foreach ($conexion->query('SELECT * FROM products') as $row) {	
                                        $valores = "SELECT * from brands WHERE id = ".$row['idBrand'].";";
                                        $lectore = mysqli_query($conexion, $valores);
                                        $brandRow = mysqli_fetch_array($lectore);

                                        $valores = "SELECT * from categorias WHERE id = ".$row['idBrand'].";";
                                        $lectore = mysqli_query($conexion, $valores);
                                        $categoriaRow = mysqli_fetch_array($lectore);
                                  ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $brandRow['name']; ?></td>
                                        <td><?php echo $categoriaRow['nombre']; ?></td>
                                        <td><?php echo $row['cost']; ?></td>
                                        <td><?php echo $row['stock']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>

