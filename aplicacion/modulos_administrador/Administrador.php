<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/Profesor.css">

    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href="../../plugins/bootstrap/css/landing-page.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/fontello.css">
    
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    
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
        <section id="banner">
           <div class="banner-id">
              <img src="../../ImagenesProyecto/Fondo_Admin.jpg">
                <div class="Menu-Vertical">
                    <h1>Bienvenido</h1>
                </div> 
           </div>
        </section>
    </main>
</body>
</html>