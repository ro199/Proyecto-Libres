<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    //header("Location:index2.php");
    //echo "eres estudiante";
} elseif ($_SESSION['tipo_usuario'] == 'ADM') {
    //echo "eres estudiante";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                   <a href="#">Foros</a>
                   <a href="../desconectar_sesion.php">Salir</a>
               </nav>
           </div>
       </header>
        <!--Inicio de formulario -->
        <?php
        require '../clases_negocio/funciones_oa_profesor.php';
        $id_objeto_aprendizaje = filter_input(INPUT_GET, 'id');
        //extract($_GET);
        $objeto_de_aprendizaje = obtener_oa_como_arreglo($id_objeto_aprendizaje);
        ?>

        <main>
            <section id="banner_pr">
                <div class="container-fluid text-center">    
                    <div class="row content">
                        <div class="col-sm-6 col-sm-offset-3"> 
                            <h2>Actualizacion de objeto de aprendizaje</h2>
                            <form onsubmit="return validar_formulario()" action="../modulos_profesor/Profesor_ejecucion_actualizar_Recu.php" method="post" enctype="multipart/form-data" >
                                <p id="oas_existentes" style="display:none;" ><?php
                                    echo obtener_lista_de_oas();
                                    ?></p>

                                <input type="text" style="display:none;" name="id_objeto_aprendizaje" value='<?php echo $id_objeto_aprendizaje ?>' ></input>

                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <p id="oas_duplicados" style="display:none; color:#FF0000;">
                                        El nombre de objeto ya ha sido utilizado!
                                    </p>
                                    <input type="text" class="form-control" id="nombre" value='<?php echo $objeto_de_aprendizaje['nombre'] ?>' name="nombre" required autocomplete="off">
                                </div>


                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" value='<?php echo $objeto_de_aprendizaje['descripcion'] ?>' name="descripcion" required>
                                </div>

                                <div class="form-group">
                                    <label for="institucion">Institución:</label>
                                    <input type="text"  class="form-control" id="institucion" value='<?php echo $objeto_de_aprendizaje['institucion'] ?>'  name="institucion" required>
                                </div>

                                <div class="form-group">
                                    <label for="palabras_claves">Palabras claves:</label>
                                    <input type="text"  class="form-control" id="palabras_claves" value='<?php echo $objeto_de_aprendizaje['palabras_clave'] ?>' name="palabras_claves" required>
                                </div>

                                <button id="registrar" type="submit" class="btn btn-default">Actualizar</button></br>
                            </form>

                        </div>
                    </div>
                </div></br></br></br>
            </section>
        </main>

        <script>
            //funcion validacion objetos
            $(document).ready(function () {
                var isvalue = document.getElementById("oas_existentes").innerHTML;
                var nombreActual = document.getElementById("nombre").value;
                isvalue = isvalue.split(',');
                isvalue.splice(isvalue.indexOf(nombreActual), 1);
                $('#nombre').keyup(function () {
                    let useramount = $(this).val();
                    //$(this).removeClass('correct wrong');
                    //alert($.inArray(useramount+'.zip', isvalue));
                    if ($.inArray(useramount, isvalue) != -1) {
                        $('#oas_duplicados').slideDown("slow");
                        document.getElementById("registrar").disabled = true;
                    } else {
                        $('#oas_duplicados').slideUp("slow");
                        document.getElementById("registrar").disabled = false;
                    }
                });
            });

            function validar_formulario() {
                var caracteres = /^[0-9a-zA-Z]+$/;
                if (document.getElementById('nombre').value.match(caracteres) && document.getElementById('nombre').value.length <= 15)
                {
                    return true;
                } else
                {
                    if (!document.getElementById('nombre').value.match(caracteres)) {
                        alert('El nombre solo puede contener letras(no caracteres especiales) y numeros!');
                    }
                    if (document.getElementById('nombre').value.length > 15) {
                        alert('El nombre solo puede contener 15 caracteres como máximo!');
                    }
                    return false;
                }
            }
        </script>
    </body>

</html>
