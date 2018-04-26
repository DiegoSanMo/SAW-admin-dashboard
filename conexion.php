<?php
  $host_db="localhost";
  $usuario_db="root";
  //Contrasenia Karin
  //$pass_db="Bankai123";
  //Contrasenia Diego
  $pass_db="root";
  $db="saw";

  $conexion=new mysqli($host_db,$usuario_db, $pass_db);
  $conexion->set_charset("utf8");    

  mysqli_select_db($conexion, "saw");
?>