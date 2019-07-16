<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    //header("Location:index2.php");
    echo "eres estudiante";
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
    echo "eres estudiante";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <script type="text/javascript">
           function verificar($x)
                    {           
                         idObjeto = $x;
                         $.ajax({
                            type: "POST",
                            url: "validarValoracion.php",
                            data: {idObjeto:idObjeto},
                            success: function (html) {
                            if(html==1){
                            ocultar("botons1");
                            }else{
               }

                           }
                         
                });
        } 

            function ocultar(id) {
                var e = document.getElementById(id);
                e.style.display = 'none';
                }
         
    </script>
    <meta charset="utf-8"></meta>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
    <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/Profesor.css">
    <link rel="stylesheet" href="../../css/fontello.css">
    <title>FORO</title>
</head>

<style>

    input[type = "radio"]{ display:none;}
    label{ color:grey;}

    .clasificacion{
        direction: rtl;
        unicode-bidi: bidi-override;
    }

    label:hover,
    label:hover ~ label{color:orange;}
    input[type = "radio"]:checked ~ label{color:orange;}

</style>


<body style="background-color:#00aae4;">
    <header>
           <div class="Menu-Vertical">
              <h1>Usuario: <?php echo $_SESSION['usuario'] ?></h1>
              <input type="checkbox" id="menu-bar">
              <label class="icon-menu" for="menu-bar"></label>
              <nav class="menu">
                   <a href="../modulos_profesor/Profesor_Cargar_Recur.php">Cargar un Recurso</a>
                   <a href="../modulos_profesor/Profesor_Repositorio.php">Repositorio Privado</a>
                   <a href="../modulos_profesor/Profesor_Repositorio_Pub.php">Repositorio Público</a>
                   <a href="../modulos_comunes/modulo_foro/index.php">Foro</a>
                   <a href="../desconectar_sesion.php">Salir</a>
               </nav>
           </div>
       </header>
<!--Inicio de formulario -->
<?php
require_once '../clases_negocio/clase_conexion.php';
require '../clases_negocio/funciones_oa_profesor.php';
require '../clases_negocio/funciones_oa_estudiante.php';
$id_objeto_aprendizaje = filter_input(INPUT_GET, 'id');
function verificarValoracion($x){
    echo '<script type="text/javascript"> verificar('.$x.') </script>';
}
verificarValoracion($id_objeto_aprendizaje);

$objeto_de_aprendizaje = obtener_oa_como_arreglo($id_objeto_aprendizaje);
?>

<main>
    <section id="banner_pr">
        <div class="container">
            <div class="well text-center">
                <h2><?php echo "Título: ".$objeto_de_aprendizaje['nombre'] ?></h2>
                <p><?php echo "Descripción: ".$objeto_de_aprendizaje['descripcion'] ?></p>
                <div style="text-align:right">
                     <p><?php echo "Fecha de Creación: ".$objeto_de_aprendizaje['fechaCreacion'] ?></p>
                     <form action="agregar_valoracion.php" method="post" id='valorarObjeto'>
                     <input class="form-control" style="display: none;" value='<?php echo $id_objeto_aprendizaje ?>'name='id_objeto_aprendizaje'></input>
                     <p>Valoración</p>
                     <div class="form-group">
                        <p class="clasificacion">
                        <input id="radio1" type="radio" name="estrellas" value="1">
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="2">
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3">
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="4">
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="5">
                        <label for="radio5">★</label>
                     </div>
                     <input id="botons1" type="submit" name="submitted" value="Valorar"/>
                    </form>
                </div>

            </div>

            <div class="table-responsive-sm">
                <table class="table thead-light">
                    <div class="col-sm-6 col-sm-offset-3">
                        <thead class="th">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Comentario</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <div id="myModal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>

                        <?php
                        $statement = "select * from comentario where id_objeto_aprendizaje=?";
                        $conexion = new Conexion();
                        $consulta = $conexion->prepare($statement);
                        $consulta->setFetchMode(PDO::FETCH_ASSOC);
                        $consulta->execute([$id_objeto_aprendizaje]);
                        $timezone = date('m/d/Y h:i:s');


                        if ($consulta->rowCount() != 0) {
                            while ($comentario = $consulta->fetch()) {
                                echo '<tr class="">';
                                echo '<th scope="row text-center">' . $comentario['idcomentario'] . '</th>';
                                echo '<td>' . $comentario['contenido'] . '</td>';
                                if (obtener_tipo_usuario_con_id($comentario['idusuario']) == 'ADM') {
                                        echo '<td>ADMINISTRADOR</td>';
                                } elseif(obtener_tipo_usuario_con_id($comentario['idusuario']) == 'PRO') {
                                    $profesor = obtener_profesor_como_arreglo(obtener_id_profesor_con_id_usuario($comentario['idusuario']));
                                        echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                                }else{
                                        $estudiante = obtener_estudiante_como_arreglo(obtener_id_estudiante_con_id_usuario($comentario['idusuario']));
                                        echo '<td>' . $estudiante['nombres'] . ' ' . $estudiante['apellidos'] . '</td>';
                                    }
                                echo '<td>' . $comentario['fechacomentario'] . '</td>';
                                if(($comentario['rutaimagen'])=="../../imagenes/")
                                {
                                    echo '<td></td>';

                                }else{
                                    echo "<td><a onclick=\"previewImagen('".$comentario['rutaimagen']."');\"><img id='imgId' src='". $comentario['rutaimagen'] . "' width='300' height='150'></a></td>";
                                    
                                }
                                $nombreUsuario = consultarNombreUsuario($comentario['idusuario']);
                                if( $_SESSION['usuario'] == $nombreUsuario['usuario']){
                                    echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el objeto de aprendizaje?');\" href='pro_comentarios.php?id=".$comentario['id_objeto_aprendizaje']."&idcom=".$comentario['idcomentario']."&idborrar=2'><span class='glyphicon glyphicon-trash'></a></td>";
                                }else{
                                    echo '</tr>';

                                }
                                
                            }
                        }
                        extract($_GET);
                        if (@$idborrar == 2) {
                            eliminarComentario($idcom);
                            echo '<script>location.href="pro_comentarios.php?id='.$id.'"</script>';
                        }
                        $conexion = null;
                        ?>


                        <script>
                            var modal = document.getElementById('myModal');
                            function previewImagen($x){
                                var img =document.getElementById('imgId');
                                var modalImg = document.getElementById('img01');
                                modal.style.display = "block";
                                modalImg.src = $x;

                            }


                            var span = document.getElementsByClassName("close")[0];
                            span.onclick = function() {
                                modal.style.display = "none";
                            }
                        </script>
                        </tbody>
                    </div>

                </table>
            </div>
            <form action="../modulos_profesor/pro_ejecutar_comentar.php" method="post" enctype="multipart/form-data">
                <input class="form-control" style="display: none;" value='<?php echo $id_objeto_aprendizaje ?>'
                       name="id_objeto_aprendizaje"> </input>

                <div class="form-group">
                    <label for="contenido">Comentario:</label>
                    <textarea type="tex" class="form-control" id="contenido" name="contenido" required></textarea>
                    <input type="hidden" name="MAX_FILE_SIZE" value="524288">
                    <fieldset>

                        <legend>Seleccione una imagen</legend>
                        <p><b>Archivo:</b>
                            <div>
                                <input type="file" name="file" id= "file"/></p>
                            </div>
                    </fieldset>
                </div>
                <div id = "vista-previa">

                </div>
                <input type="submit" name="submitted" value="Comentar"/>
                </br>
            </form>
        </div>
        </div>
    </section>
</main>

</body>

</html>


