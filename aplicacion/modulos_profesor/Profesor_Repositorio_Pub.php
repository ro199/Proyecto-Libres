<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Profesor</title>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/Profesor.css">
        <link rel="stylesheet" href="../../css/fontello.css">

        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    </head>

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

       <main>
           <section id="banner_pr">
                <div class="container-fluid text-center">
                    <div class="row content">
                        <!-- --------------------------------------------- -->
                        <div class="col-sm-12 text-center">
                            <h2> Administración de recursos de aprendizaje</h2>
                            <form action="../modulos_profesor/Profesor_Buscar.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-3 text-left ">
                                        <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                                            <option value="">Filtrar por:</option>
                                            <option value="autor">autor</option>
                                            <option value="nombre">nombre</option>
                                            <option value="descripcion">descripcion</option>
                                            <option value="institucion">institucion</option>
                                            <option value="palabras_clave">palabra clave</option>
                                            <option value="cbx_materia">materia</option>
                                        </select></br>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="Privado" dir="ltr">
                                            <option value="PUB"></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <button id="registrar" type="submit" class="btn btn-success">Buscar</button>
                                        </br></br>
                                    </div>
                                    <div class="col-md-3 text-left">
                                        <a class="btn btn-success" href="Profesor_Cargar_Recur.php" role="button">Cargar Recurso</a></br></br>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="container" >
                            <table class="table table-striped"border ="1|1" class="table table-bordered" id="tabla">
                                <thead>
                                <tr class="warning">
                                	<td>Autor</td>
                                    <td>Nombre</td>
                                    <td>Descripción</td>
                                    <td>Institución</td>
                                    <td>Fecha Creación</td>
                                    <td>Comentarios</td>
                                    <td>Comentar</td>
                                    <td>Descargar</td>
                                </tr>
                                </thead>
                        </div>

                            <?php
                            require_once '../clases_negocio/clase_conexion.php';
                            require '../clases_negocio/funciones_oa_profesor.php';
                            require '../clases_negocio/funciones_oa_estudiante.php';
                            //$id_usuario = $_SESSION["id_usuario"];
                            $id_usuario = $_SESSION['id'];
                            $statement = 'select idobjeto_aprendizaje, usuario, nombre, descripcion, institucion, fechaCreacion, oa.id_usuario as id_usuario, ruta from objeto_aprendizaje oa join usuario u on oa.id_usuario=u.idUsuario where tipo_repo=1 and Publico="SI"';
                            $conexion = new Conexion();
                            $consulta = $conexion->prepare($statement);
                            $consulta->setFetchMode(PDO::FETCH_ASSOC);
                            $consulta->execute();

                            $id_usuario = $_SESSION['id'];

                            if ($consulta->rowCount() != 0) {
                                while ($row = $consulta->fetch()) {
                                    echo '<tr class="success">';
                                    echo '<td>' . $row['usuario'].'</td>';
                                    echo '<td>' . $row['nombre']. '</td>';
                                    echo '<td>' . $row['descripcion']. '</td>';
                                    echo '<td>' . $row['institucion']. '</td>';
                                    echo '<td>' . $row['fechaCreacion']. '</td>';
                                    echo '<td>'. obtener_nro_comentarios_oa($row['idobjeto_aprendizaje']) .'</td>';
                                    echo "<td><a href='pro_comentarios.php?id=" . $row['idobjeto_aprendizaje'] . "'><span class='icon-ok-squared'></span></a></td>";
                                    echo "<td>
                                            <a href=" . $row['ruta'] . "  onclick= \"myFunction('" . $row['idobjeto_aprendizaje'] . "');\" >
                                            <span class='icon-download-cloud'></span></a>
                                            </td>";
                                }

                            }

                            echo '</table>';
                            $conexion = null;
                            ?>
                            <script type = "text/javascript">
                                (function(){
                                    location.reload();
                                    //$("#tabla").ajax().reload();
                                }, 10000);

                                function myFunction($id_objeto)
                                {
                                    $.ajax({
                                        url: 'pro_ejecutar_actualizar_descarga.php',
                                        type: 'POST',
                                        data: 'objeto_id='+$id_objeto,
                                        async : false,
                                    });

                                }
                            </script>
                            <script>
                                function hacer_hover($x)
                                {
                                    myPopup = window.open('../modulos_administrador/previsualizar.php?vs='+$x,'popupWindow','width=640,height=480');
                                    myPopup.opener = self;
                                }
                            </script>

                        </div>

                        <div class="estadistica">
                        <div class="column">
                            <embed src= "../modulos_profesor/High/examples/pie-basic/index.php" height="500" width="600"></embed>
                            </div>

                            <div class="column">
                            <embed src= "../modulos_profesor/High/examples/pie-basic/estadisticaDescargas.php" height="500" width="600"></embed>
                            </div>


                        </div>

                    </div>
                </div></br></br></br>
           </section>
       </main>
    </body>

</html>