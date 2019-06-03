<?php
require '../../aplicacion/clases_negocio/clase_conexion.php';

$usuario = filter_input(INPUT_POST, 'user');
$contrasenia = filter_input(INPUT_POST, 'pass');

$conexion = new Conexion();
$statement = 'UPDATE usuario SET contrasenia=\''.$contrasenia.'\' WHERE usuario=\''.$usuario.'\'';

$consulta = $conexion->prepare($statement);
$consulta->execute();


//$conexion = new Conexion();

     echo '<script>alert("Usuario modificado correctamente!")</script> ';
     echo "<script>location.href='../../aplicacion/formularios_registro/Login.php'</script>";


?>