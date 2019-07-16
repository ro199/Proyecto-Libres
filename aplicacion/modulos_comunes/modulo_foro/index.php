<?php

session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>

    <meta charset="utf-8"></meta>
    <link rel="stylesheet" href="../../../plugins/bootstrap/css/bootstrap.min.css"></link>
    <script type="text/javascript" src="../../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../plugins/bootstrap/css/Profesor.css" />
    <link rel="stylesheet" href="../../../css/fontello.css">
    <title>Foro</title>
</head>

<body style="background-color:#00aae4;">

<?php 
    require '../../clases_negocio/clase_conexion.php';
    
if ($_SESSION['tipo_usuario'] == 'ADM' ){
   
   echo '<header>
           <div class="Menu-Vertical">
              <h1>Usuario:'.$_SESSION['usuario'].'</h1>
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
       </header>';
}else{

    echo '<header>
           <div class="Menu-Vertical">
              <h1>Usuario:'.$_SESSION['usuario'].'</h1>
              <input type="checkbox" id="menu-bar">
              <label class="icon-menu" for="menu-bar"></label>
              <nav class="menu">
                   <a href="../../modulos_profesor/Profesor_Cargar_Recur.php">Cargar un Recurso</a>
                   <a href="../../modulos_profesor/Profesor_Repositorio.php">Repositorio Privado</a>
                   <a href="../../modulos_profesor/Profesor_Repositorio_Pub.php">Repositorio Público</a>
                   <a href="../../modulos_comunes/modulo_foro/index.php">Foro</a>
                   <a href="../../desconectar_sesion.php">Salir</a>
               </nav>
           </div>
       </header>';
}
?>
<!-- Inicio formulario de búsqueda -->

<!-- presentacion de objetos de aprendizaje-->
<main>
    <section id="banner_pr">
        <div class="container-fluid text-center">
        <div class="row content">
        <div class="col-sm-12 text-center"> 
                <h2>FORO DE COMENTARIOS</h2>
                <form action="index.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">
                            </div>
                            <div class="col-md-3 text-left ">
                                <select class= "form-control" name="tipo_criterio" dir="ltr" required>
                                    <option value="">Filtrar por:</option>
                                    <option value="autor">Autor</option>
                                    <option value="titulo">Título</option>
                                </select><br>
                            </div>
                        <!--<input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>-->

                        <div class="col-md-3 text-center">
                                <input type="text" class="form-control" id="criterio_busqueda" placeholder="Buscar...." name="criterio_busqueda" required></br>
                            </div>
                            <div class="col-md-3 text-left">
                                <button id="registrar" type="submit" class="btn btn-success">Buscar</button>
                        <br><br>
                    </div>

                </form>

                <div class="container" >
                    <table class="table table-striped" border="1|1" class="table table-bordered" id="tabla">
                        <thead>
                            <tr class="warning">
                                <td>Usuario</td>
                                <td>Título</td>
                                <td>Fecha</td>
                                <td>Discusión</td>
                                <td>Revisar</td>
                            </tr>
                        </thead>
                </div>
    <?php
        require_once '../../clases_negocio/clase_conexion.php';
        require '../../clases_negocio/funciones_oa_profesor.php';
        require '../../clases_negocio/funciones_oa_estudiante.php';
        

        $idLogin = $_SESSION['id'];
        $nombre = $_SESSION['usuario'];

        $conexion = new Conexion();
        $statement = "SELECT * FROM foro JOIN usuario ON (foro.idUsuario=usuario.idUsuario) WHERE foro.identificador = 0";
        
        $criterio = filter_input(INPUT_POST, 'tipo_criterio');
        $valor_criterio = filter_input(INPUT_POST, 'criterio_busqueda');
        
        $clausula_where = " ";
            switch ($criterio) {
                case 'autor':
                    $clausula_where = ' and usuario like "%' . $valor_criterio . '%" order by usuario';
                    $statement = $statement . $clausula_where;
                    break;
                case 'titulo':
                    $clausula_where = ' and titulo like "%' . $valor_criterio . '%" order by titulo';
                    $statement = $statement . $clausula_where;
                    
                    break;
            }
        
        $consulta = $conexion->prepare($statement);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        
        while($row = $consulta->fetch()){
            $id = $row['idForo'];
            $usuario = $row['usuario'];
            $titulo = $row['titulo'];
            $fecha = $row['fecha'];
            $respuestas = $row['respuestas'];
            echo "<tr>";
                echo "<td>$usuario </td>";
                echo "<td>$titulo</td>";
                echo "<td>".date("d-m-y,$fecha")."</td>";
                echo "<td>$respuestas</td>";
                echo "<td><a href= foro.php?id=".$id.">Tema</a></td>";
            echo "</tr>";
        }
    ?>
    </table>
    <br>
    <br>
    <?php echo "<button onclick=\"location.href='formulario.php'\">INSERTAR NUEVO TEMA</td>"; ?>
    </section>
</main>


</body>
</html>

