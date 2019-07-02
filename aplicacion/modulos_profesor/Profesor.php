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
    <title>Proyecto</title>
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
               <a href="../modulos_profesor/Profesor_Cargar_Recur.php">Cargar un Recurso</a>
               <a href="../modulos_profesor/Profesor_Repositorio.php">Repositorio Privado</a>
               <a href="../modulos_profesor/Profesor_Repositorio_Pub.php">Repositorio Público</a>
               <a href="../modulos_comunes/modulo_foro/index.php">Foro</a>
               <a href="../desconectar_sesion.php">Salir</a>
           </nav>
       </div>
   </header>
    
    <main>
        <section id="banner">
           <div class="banner-id">
              <img src="../../ImagenesProyecto/FondoPro.jpg">
                <div class="Menu-Vertical">
                    <h2>Gracias por preferirnos</h2>
                    <p>Bienvenido</p>
                </div> 
           </div>
        </section>
    </main>
</body>
</html>