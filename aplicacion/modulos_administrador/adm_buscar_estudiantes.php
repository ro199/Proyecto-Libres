
<?php
session_start();
if (@!$_SESSION['usuario']) {
    echo "<script>location.href='../../aplicacion/formularios_registro/Login.php'</script>";
} elseif ($_SESSION['tipo_usuario'] == 'PRO') {
//header("Location:index2.php");
    echo "ERES PROFESOR";
} elseif ($_SESSION['tipo_usuario'] == 'EST') {
    echo "ERES ESTUDIANTE";
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
               <a href="../modulos_administrador/adm_buscar_estudiantes.php">Gestionar Estudiantes</a>
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
                    <h2> Administración de estudiantes</h2>
                    <form onsubmit="return validar_busqueda_cedula()" action="../modulos_administrador/adm_ejecutar_buscar_estudiantes.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3 text-left ">
                            <select class= "form-control" name="tipo_criterio" dir="ltr" required id="select_criterio">
                                <option value="">Filtrar por:</option>
                                <option value="nombre">nombre</option>
                                <option value="usuario">usuario</option>
                                <option value="cedula">cédula</option>
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
                    require '../clases_negocio/funciones_administrador.php';
                    
                    $statement = ("select u.*,e.nombres, e.apellidos, e.ci, e.mail from usuario as u, estudiante as e where u.idUsuario=e.id_usuario order by activo");
                    $conexion = new Conexion();
                    $consulta = $conexion->prepare($statement);
                    $consulta->setFetchMode(PDO::FETCH_ASSOC);
                    $consulta->execute();

                    $id_usuario = $_SESSION['id'];


                    echo '<table border ="1|1" class="table table-condensed";>';
                    echo '<tr class="warning">';
                    echo '<td>Id usuario</td>';
                    echo '<td>Usuario</td>';
                    echo '<td>E-mail</td>';
                    echo '<td>Activo?</td>';
                    echo '<td>Nombre completo</td>';
                    echo '<td>Cedula</td>';
                    echo "</tr>";

                    if ($consulta->rowCount() != 0) {
                        while ($row = $consulta->fetch()) {
                            echo '<tr class="success">';
                            echo '<td>' . $row['idUsuario'] . '</td>';
                            echo '<td>' . $row['usuario'] . '</td>';
                            echo '<td>' . $row['mail'] . '</td>';
                            echo '<td>' . $row['activo'] . '</td>';
                            echo '<td>' . $row['apellidos'] . '  ' . $row['nombres'] . '</td>';
                            echo '<td>' . $row['ci'].'</td>';
                            if ($row['activo'] == 'V') {
                                echo '<td><a href="adm_buscar_estudiantes.php?id=' . $row['idUsuario'] . '&id_gestion=1">Desactivar usuario</a></td>';
                            } else {
                                echo '<td><a href="adm_buscar_estudiantes.php?id=' . $row['idUsuario'] . '&id_gestion=2">Activar usuario</a></td>';
                            }
                            echo "<td><a onClick=\"javascript: return confirm('Realmente desea eliminar el estudiante seleccionado?');\" href='adm_buscar_estudiantes.php?id=" . $row['idUsuario'] . "&id_gestion=3'><span class='glyphicon glyphicon-remove'></a></td>";

                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                    $id_gestion = filter_input(INPUT_GET, 'id_gestion');
                    $id = filter_input(INPUT_GET, 'id');
                    if ($id_gestion == 1) {
                        act_des_usuario($id, "F");
                        echo '<script>alert("Usuario desactivado correctamente")</script> ';
                        echo "<script>location.href='adm_buscar_estudiantes.php'</script>";
                    }
                    if ($id_gestion == 2) {
                       act_des_usuario($id, "V");
                       echo '<script>alert("Usuario activado correctamente")</script> ';
                       echo "<script>location.href='adm_buscar_estudiantes.php'</script>";
                    }
                    if ($id_gestion == 3) {
                        if(eliminar_usuario($id)){
                            echo '<script>alert("Usuario eliminado correctamente")</script> ';
                        }else{
                            echo '<script>alert("El usuario no se ha podido eliminar")</script> ';
                        }
                        
                        echo "<script>location.href='adm_buscar_estudiantes.php'</script>";
                    }
                    
                    
                    $conexion = null;
                    ?>

                    <!-- --------------------------------------------- -->

                </div>
            </div>
        </div></br></br></br>
        <script>
            function validar_busqueda_cedula() {
                var e = document.getElementById("select_criterio");
                var strCriterio = e.options[e.selectedIndex].value;
                flag = false;
                if (strCriterio === "cedula") {
                    cedula = document.getElementById("criterio_busqueda").value;
                    if (validar_cedula(cedula) === true) {
                        flag = true;
                    } else {
                        alert("La cédula ingresada no es válida.");
                        flag = false;
                    }
                }else{
                    flag=true;
                }
                return flag;
            }

            function isDigit(str) {
                return str && !/[^\d]/.test(str);
            }
            
            function validar_cedula(cedula) {
                flag = false;
                if (isDigit(cedula)) {
                    //Preguntamos si la cedula consta de 10 digitos
                    if (cedula.length === 10) {

                        //Obtenemos el digito de la region que sonlos dos primeros digitos
                        var digito_region = cedula.substring(0, 2);

                        //Pregunto si la region existe ecuador se divide en 24 regiones
                        if (digito_region >= 1 && digito_region <= 24) {

                            // Extraigo el ultimo digito
                            var ultimo_digito = cedula.substring(9, 10);

                            //Agrupo todos los pares y los sumo
                            var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));

                            //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
                            var numero1 = cedula.substring(0, 1);
                            var numero1 = (numero1 * 2);
                            if (numero1 > 9) {
                                var numero1 = (numero1 - 9);
                            }

                            var numero3 = cedula.substring(2, 3);
                            var numero3 = (numero3 * 2);
                            if (numero3 > 9) {
                                var numero3 = (numero3 - 9);
                            }

                            var numero5 = cedula.substring(4, 5);
                            var numero5 = (numero5 * 2);
                            if (numero5 > 9) {
                                var numero5 = (numero5 - 9);
                            }

                            var numero7 = cedula.substring(6, 7);
                            var numero7 = (numero7 * 2);
                            if (numero7 > 9) {
                                var numero7 = (numero7 - 9);
                            }

                            var numero9 = cedula.substring(8, 9);
                            var numero9 = (numero9 * 2);
                            if (numero9 > 9) {
                                var numero9 = (numero9 - 9);
                            }

                            var impares = numero1 + numero3 + numero5 + numero7 + numero9;

                            //Suma total
                            var suma_total = (pares + impares);

                            //extraemos el primero digito
                            var primer_digito_suma = String(suma_total).substring(0, 1);

                            //Obtenemos la decena inmediata
                            var decena = (parseInt(primer_digito_suma) + 1) * 10;

                            //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
                            var digito_validador = decena - suma_total;

                            //Si el digito validador es = a 10 toma el valor de 0
                            if (digito_validador == 10)
                                var digito_validador = 0;

                            //Validamos que el digito validador sea igual al de la cedula
                            if (digito_validador == ultimo_digito) {
                                //console.log('la cedula:' + cedula + ' es correcta');
                                flag = true;
                            } else {
                                //console.log('la cedula:' + cedula + ' es incorrecta');
                                flag = false;
                            }

                        } else {
                            // imprimimos en consola si la region no pertenece
                            //console.log('Esta cedula no pertenece a ninguna region');
                            flag = false;
                        }
                    } else {
                        //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
                        //console.log('Esta cedula tiene menos de 10 Digitos');
                        flag = false;
                    }
                } else
                {
                    flag = false;
                }
                return flag;
            }

        </script>
    </section>
</div>
</main>
    </body>

</html>



