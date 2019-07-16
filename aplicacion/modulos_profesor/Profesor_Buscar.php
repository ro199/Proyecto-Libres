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
                <<div class="container-fluid text-center">    
            <div class="row content">
                <!-- --------------------------------------------- -->
                <div class="col-sm-12 text-center"> 
                    <h2> Administración de objetos de aprendizaje</h2>
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

                    <?php
                    require_once '../clases_negocio/clase_conexion.php';
                    require '../clases_negocio/funciones_oa_profesor.php';

                    //adquisicion de parametros de busqueda
                    $criterio = filter_input(INPUT_POST, 'tipo_criterio');
                    $valor_criterio = filter_input(INPUT_POST, 'criterio_busqueda');
                    $statement = 'select * from objeto_aprendizaje';
                    $clausula_where = '';
                    switch ($criterio) {
                        case 'nombre':
                            $clausula_where = ' where nombre like "%' . $valor_criterio . '%" order by nombre';
                            $statement = 'select * from objeto_aprendizaje' . $clausula_where;
                            break;
                        case 'descripcion':
                            $clausula_where = ' where descripcion like "%' . $valor_criterio . '%" order by descripcion';
                            $statement = 'select * from objeto_aprendizaje' . $clausula_where;
                            break;
                        case 'institucion':
                            $clausula_where = ' where institucion like "%' . $valor_criterio . '%" order by institucion';
                            $statement = 'select * from objeto_aprendizaje' . $clausula_where;
                            break;
                        case 'palabras_clave':
                            $clausula_where = ' where palabras_clave like "%' . $valor_criterio . '%" order by palabras_clave';
                            $statement = 'select * from objeto_aprendizaje' . $clausula_where;
                            break;
                        case 'autor':
                            $statement='select oa.* from objeto_aprendizaje as oa, usuario as u, profesor as p where oa.id_usuario=u.idUsuario and u.idUsuario=p.id_usuario and (p.nombres like "%'.$valor_criterio.'%" or p.apellidos like "%'.$valor_criterio.'%")';
                            break;
                        case 'cbx_materia':
                            $clausula_where = ' where materia like "%' . $valor_criterio . '%" order by materia';
                            $statement = 'select * from objeto_aprendizaje' . $clausula_where;
                            break;
                    }
                    //fin de adquisicion de parametros de busqueda
                    $conexion = new Conexion();
                    $consulta = $conexion->prepare($statement);
                    $consulta->setFetchMode(PDO::FETCH_ASSOC);
                    $consulta->execute();

                    $id_usuario = $_SESSION['id'];
                    $repo = filter_input(INPUT_POST, 'Privado');

                    if($repo == "PRI"){
                        echo '<table border ="1|1" class="table table-condensed";>';
                        echo '<tr class="warning">';
                        echo '<td>Nombre</td>';
                        echo '<td>Descripción</td>';
                        echo '<td>Institucion</td>';
                        echo '<td>FechaCreacion</td>';
                        echo '<td>Comentarios</td>';
                        echo "<td>Actualizar</td>";
                        echo "<td>Eliminar</td>";
                        echo "<td>Descargar</td>";
                        echo "</tr>";

                        if ($consulta->rowCount() != 0) {
                            while ($row = $consulta->fetch()) {
                                echo '<tr class="success">';
                                //echo '<td>' . $row['idobjeto_aprendizaje'] . '</td>';
                                echo '<td>' . $row['nombre'] . '</td>';
                                echo '<td>' . $row['descripcion'] . '</td>';
                                echo '<td>' . $row['institucion'] . '</td>';
                                echo '<td>' . $row['fechaCreacion'] . '</td>';
                                echo '<td><a href="pro_comentarios.php?id=' . $row['idobjeto_aprendizaje'] . '">' . obtener_nro_comentarios_oa($row['idobjeto_aprendizaje']) . '</a></td>';
                                if ($id_usuario == $row['id_usuario']) {
                                    echo '<td><a href="Profesor_actualizar_Recur.php?id=' . $row['idobjeto_aprendizaje'] . '"><span class="glyphicon glyphicon-refresh"></a></td>';

                                    echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el objeto de aprendizaje?');\" href='Profesor_Buscar.php?id=" . $row['idobjeto_aprendizaje'] . "&idborrar=2'><span class='glyphicon glyphicon-remove'></a></td>";
                                } else {
                                    echo '<td>----</td>';
                                    echo '<td>----</td>';
                                }
                                echo '<td><a href="' . urldecode($row['ruta']) . '"><span class="icon-download-cloud"></span></a></td>';
                                echo '</tr>';
                            }
                        }
                        echo '</table>';
                    }

                    if($repo == "PUB"){
                        echo '<table border ="1|1" class="table table-condensed";>';
                        echo '<tr class="warning">';
                        echo '<td>Autor</td>';
                        echo '<td>Nombre</td>';
                        echo '<td>Descripción</td>';
                        echo '<td>Institucion</td>';
                        echo '<td>FechaCreacion</td>';
                        echo '<td>Comentarios</td>';
                        echo "<td>Descargar</td>";
                        echo "</tr>";

                        if ($consulta->rowCount() != 0) {
                            while ($row = $consulta->fetch()) {
                                echo '<tr class="success">';
                                if (obtener_tipo_usuario_con_id($row['id_usuario']) == 'ADM') {
                                    echo '<td>ADMINISTRADOR</td>';
                                } else {
                                    $profesor = obtener_profesor_como_arreglo(obtener_id_profesor_con_id_usuario($row['id_usuario']));
                                    echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                                }
                                echo '<td>' . $row['nombre'] . '</td>';
                                echo '<td>' . $row['descripcion'] . '</td>';
                                echo '<td>' . $row['institucion'] . '</td>';
                                echo '<td>' . $row['fechaCreacion'] . '</td>';
                                echo '<td><a href="pro_comentarios.php?id=' . $row['idobjeto_aprendizaje'] . '">' . obtener_nro_comentarios_oa($row['idobjeto_aprendizaje']) . '</a></td>';
                                echo '<td><a href="' . urldecode($row['ruta']) . '"><span class="icon-download-cloud"></span></a></td>';
                                echo '</tr>';
                            }
                        }
                        echo '</table>';
                    }

                    extract($_GET);
                    if (@$idborrar == 2) {
                        eliminar_objeto_aprendizaje($id);
                        echo '<script>alert("REGISTRO ELIMINADO")</script> ';
                        //header('Location: proyectos.php');
                        echo "<script>location.href='pro_buscar.php'</script>";
                    }
                    $conexion = null;
                    ?>

                    <!-- --------------------------------------------- -->

                </div>
            </div>
        </div>
           </section>
       </main>
    </body>

</html>

