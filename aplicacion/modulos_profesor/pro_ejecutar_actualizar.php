<?php
session_start();
require '../clases_negocio/funciones_oa_profesor.php';

$ruta = filter_input(INPUT_POST, 'o_aprendizaje')
$path = $_FILES['o_aprendizaje']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file =$almacenamiento . urlencode($nombre). '.' . $ext;

$idobjeto_aprendizaje = filter_input(INPUT_POST, 'id_objeto_aprendizaje');
$nombre = filter_input(INPUT_POST, 'nombre');
$descripcion = filter_input(INPUT_POST, 'descripcion');
$institucion = filter_input(INPUT_POST, 'institucion');
$palabras_clave = filter_input(INPUT_POST, 'palabras_claves');

//actualizar_oa($idobjeto_aprendizaje, $nombre, $descripcion, $institucion, $palabras_clave);
actualizar_oa_conruta($o_aprendizaje, $idobjeto_aprendizaje, $nombre, $descripcion, $institucion, $palabras_clave);

echo '<script charset="UTF-8">alert("El objeto se ha actualizado completamente")</script> ';
echo "<script>location.href='pro_buscar_privado.php'</script>";
?>