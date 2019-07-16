<?php
session_start();
if (@!$_SESSION['usuario']) {
    echo "<script>location.href='../../aplicacion/formularios_registro/Login.php'</script>";
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
    echo "eres estudiante";
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
    echo "eres PROFESOR";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/Profesor.css">
        <link rel="stylesheet" href="../../css/fontello.css">

        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    </head>

<body style="background-color:#00aae4;">

<header>
       <div class="Menu-Vertical">
          <h1>Usuario: <strong><?php echo $_SESSION['usuario'] ?></strong></h1>
          <input type="checkbox" id="menu-bar">
          <label class="icon-menu" for="menu-bar"></label>
          <nav class="menu">
               <a href="../modulos_administrador/adm_buscar.php">Gestionar Recursos</a>
               <a href="../modulos_administrador/adm_buscar_profesores.php">Gestionar Profesores</a>
               <a href="../modulos_administrador/adm_buscar_estudiantes.php">Gestionar Estudiantes
               </a>
               <a href="../modulos_administrador/adm_comentarios_todos.php">Gestionar Comentarios</a>
               <a href="../modulos_comunes/modulo_foro/index.php">Foro</a>
               <a href="../desconectar_sesion.php">Salir</a>
           </nav>
       </div>
   </header>
<main>

<div class="container-fluid text-center">
    <section id="banner_pr">
    <<div class="container-fluid text-center">
        <div class="col-sm-12 text-center"> 
                    <h2> Administración de objetos de aprendizaje</h2>
                    <form action="../modulos_administrador/adm_ejecutar_buscar.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">
                            <a href="../modulos_administrador/adm_buscar.php">Volver</a>
                        </div>
                        <div class="col-md-3 text-left ">
                        <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                                <option value="">Filtrar por:</option>
                                <option value="autor">autor</option>
                                <option value="nombre">nombre</option>
                                <option value="descripcion">descripcion</option>
                                <option value="institucion">institucion</option>
                                <option value="palabras_clave">palabra clave</option>
                            </select></br>
                        </div>
                        <div class="col-md-3 text-center">
                            <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>
                        </div>
                        <div class="col-md-3 text-left">
                            <button id="registrar" type="submit" class="btn btn-success">Buscar</button>
                            </br></br>
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
                    }

                    //fin de adquisicion de parametros de busqueda
                    
                    $conexion = new Conexion();
                    $consulta = $conexion->prepare($statement);
                    $consulta->setFetchMode(PDO::FETCH_ASSOC);
                    $consulta->execute();

                    $id_usuario = $_SESSION['id'];


                    echo '<table border ="1|1" class="table table-condensed";>';
                    echo '<tr class="warning">';
                    echo '<td>Nombre</td>';
                    echo '<td>Descripción</td>';
                    echo '<td>Institucion</td>';
                    echo '<td>FechaCreacion</td>';
                    echo '<td>palabras clave</td>';
                    echo '<td>Tamaño</td>';
                    echo '<td>Autor</td>';
                    echo '<td>Comentarios</td>';
                    //echo "<td>ruta</td>";
                    echo "</tr>";

                    if ($consulta->rowCount() != 0) {
                        while ($row = $consulta->fetch()) {
                            echo '<tr class="success">';
                            echo '<td>' . $row['nombre'] . '</td>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                            echo '<td>' . $row['institucion'] . '</td>';
                            echo '<td>' . $row['fechaCreacion'] . '</td>';
                            echo '<td>' . $row['palabras_clave'] . '</td>';
                            echo '<td>' . number_format($row['tamanio'] / 1e6, 2, '.', '') . ' MB' . '</td>';
                            if (obtener_tipo_usuario_con_id($row['id_usuario']) == 'ADM') {
                                echo '<td>ADMINISTRADOR</td>';
                            } else {
                                $profesor = obtener_profesor_como_arreglo(obtener_id_profesor_con_id_usuario($row['id_usuario']));
                                echo '<td>' . $profesor['nombres'] . ' ' . $profesor['apellidos'] . '</td>';
                            }
                            echo '<td><a href="adm_comentarios.php?id=' . $row['idobjeto_aprendizaje'] . '">' . obtener_nro_comentarios_oa($row['idobjeto_aprendizaje']) . '</a></td>';
                            echo '<td><a href="adm_actualizar_oa.php?id=' . $row['idobjeto_aprendizaje'] . '"><span class="glyphicon glyphicon-refresh"></a></td>';
                            echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el objeto de aprendizaje?');\" href='adm_buscar.php?id=" . $row['idobjeto_aprendizaje'] . "&idborrar=2'><span class='glyphicon glyphicon-remove'></a></td>";
                            echo '<td><a href="' . $row['ruta'] . '">Descargar</a></td>';
                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                    extract($_GET);
                    if (@$idborrar == 2) {
                        eliminar_objeto_aprendizaje($id);
                        echo '<script>alert("REGISTRO ELIMINADO")</script> ';
                        //header('Location: proyectos.php');
                        echo "<script>location.href='adm_buscar.php'</script>";
                    }
                    $conexion = null;
                    ?>

                    <!-- --------------------------------------------- -->

                </div>
            </div>
        </div>
       </section>
   </div>
</main>
    </body>

</html>

