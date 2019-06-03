<?php
session_start();
require '../clases_negocio/funciones_oa_profesor.php';

$id_objeto_aprendizaje = filter_input(INPUT_GET, 'id');
        //extract($_GET);
$objeto_de_aprendizaje = obtener_oa_como_arreglo($id_objeto_aprendizaje);

$nombre = $objeto_de_aprendizaje['nombre'];
echo "asdasdasdasdasdasd". $id_objeto_aprendizaje;
//publicarRA($nombre);

//echo '<script charset="UTF-8">alert("El recurso se ha publicado correctamente")</script> ';
//echo "<script>location.href='pro_buscar_privado.php'</script>";
?>