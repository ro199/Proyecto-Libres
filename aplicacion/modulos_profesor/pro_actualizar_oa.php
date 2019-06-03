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

        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <title>Proyecto SGOA</title>
    </head>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */ 
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 390px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        html{
            min-height: 100%;
            position: relative;
        }
        body{
            margin:0;
            margin-bottom: 40px;
        }
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;} 
        }
    </style>


    <body>
        <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bienvenid@: <strong><?php echo $_SESSION['usuario'] ?></strong></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Repositorios
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../modulos_profesor/pro_buscar.php">Repositorio público</a></li>
                        <li><a href="../modulos_profesor/pro_buscar_privado.php">Repositorio privado</a></li>
                    </ul>
                </li>
                        <li><a href="../modulos_comunes/modulo_foro/index.php">Foro</a></li>
                          </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../desconectar_sesion.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
            </ul>
        </div>
    </div>
</nav>
        <!--Inicio de formulario -->
        <?php
        require '../clases_negocio/funciones_oa_profesor.php';
        $id_objeto_aprendizaje = filter_input(INPUT_GET, 'id');
        //extract($_GET);
        $objeto_de_aprendizaje = obtener_oa_como_arreglo($id_objeto_aprendizaje);
        ?>

        <div class="container-fluid text-center">    
            <div class="row content">
                <div class="col-sm-6 col-sm-offset-3"> 
                    <h2>Actualizacion de objeto de aprendizaje</h2>
                    <form onsubmit="return validar_formulario()" action="../modulos_profesor/pro_ejecutar_actualizar.php" method="post" enctype="multipart/form-data" >
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
