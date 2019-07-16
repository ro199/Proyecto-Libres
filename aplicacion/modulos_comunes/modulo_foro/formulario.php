<?php

session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
//header("Location:index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
}

if(isset($_GET["respuestas"]))
$respuestas = $_GET['respuestas'];
else
$respuestas = 0;
if(isset($_GET["identificador"]))
$identificador = $_GET['identificador'];
else
$identificador = 0;
    $idLogin = $_SESSION['id'];
    $nombre = $_SESSION['usuario'];
    
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
    <title>Formulario Foro</title>
</head>

<body style="background-color:#00aae4;">
<?php if ($_SESSION['tipo_usuario'] == 'ADM' ){
   
   echo '<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="#">Bienvenid@: <strong>'.$_SESSION['usuario'].'</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Objetos de aprendizaje
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../../modulos_administrador/adm_objetos_aprendizaje.php">Importar y catalogar objetos de aprendizaje</a></li>
                        <li><a href="../../modulos_administrador/adm_buscar.php">Buscar y administrar objetos de aprendizaje</a></li>
                    </ul>
                </li>
                <li><a href="../../modulos_administrador/adm_buscar_profesores.php">Gestionar Profesores</a></li>
                <li ><a href="../../modulos_administrador/adm_buscar_estudiantes.php">Gestionar Estudiantes</a></li>
                <li ><a href="../../modulos_administrador/adm_comentarios_todos.php">Gestionar comentarios</a></li>
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gestión de colaboradores
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="../modulos_comunes/modulo_colaboradores/buscar_colaborador.php">Buscar</a></li>
                    <li><a href="../modulos_comunes/modulo_colaboradores/eliminar_colaborador.php">Eliminar</a></li>
                </ul>
            </li>
                <li><a href="../../modulos_administrador/adm_herramientas.php">Herramientas</a></li>
                <li class="active"><a href="index.php">Foro</a></li>">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../../aplicacion/desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>';
   
  
   
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
<main>
    <section id="banner_pr">
        
    </section>
</main>
    <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-md-3 text-center">
    </div>
    <div class="col-md-3 text-left">
        <br><br>
    </div>
        <div class="container">
            <table class="table table-striped table-dark" border ="1|1" class="table table-bordered" id="tabla">
                <thead>
                    <form name="form" action="agregar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="identificador" value="<?php echo $identificador;?>">
                    	<input type="hidden" name="respuestas" value="<?php echo $respuestas;?>">
                        <tr class="success">
                    		<th>Autor </th>
                    		<td><?php echo $nombre?></td>
                        </tr>
                        <tr class="success">
                          <th>Titulo</th>
                          <td><input type="text" name="titulo" cols="50" rows="5" required="required"></td>
                        </tr>
                        <tr class="success">
                          <th>Mensaje</th>
                          <td><textarea name="mensaje" cols="50" rows="5" required="required"></textarea></td>
                        </tr>
                        <tr class="success">
                        <th>Foto</th>
                        <td>
                        <input type="file" name="archivo" id="archivo">
                             </td>
                        </tr>
                        <tr class="success">
                        <th>Video</th>
                        <td>
                        <input type="file" name="video" id="video">
                         </td>
                         </tr>
                        <tr class="warning">
                          <td></td><td><input type="submit" id="submit" name="submit" value="Enviar Mensaje"></td>
                        </tr>
                    </form>
                </thead>
            </table>
        </div>
      </div>
      <td><button type="button" class="btn btn-dark" onclick="location.href='index.php'">REGRESAR</td>
</body>
</html>