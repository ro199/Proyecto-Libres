<?php
session_start();
if (@!$_SESSION['usuario']) {
    header("Location:../../index2.php");
}

if (isset($_GET['mensaje'])) {
    echo '<script type="text/javascript">alert("DEBE CARGAR UN OA PARA SER COLABORADOR");</script>';
}

    require_once 'High/examples/pie-basic/conexion.php';
    $sql = "select * from facultad";
    $result = mysqli_query($conexion, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profesor</title>
    <link rel="stylesheet" href="../../plugins/bootstrap/css/Profesor.css">

    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href="../../plugins/bootstrap/css/landing-page.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/fontello.css">

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../../plugins/bootstrap/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
        <script languaje = "javascript">
            $(document).ready(function(){
                $("#cbx_carreras").change(function(){
                    $("#cbx_carreras option:selected").each(function(){
                            idfacultad = $(this).val();

                            $.post("getCarreras.php", {idfacultad: idfacultad}, function(data){
                                $("#cbx_materia").html(data);
                            });
                    });
                })
            });
        </script>

        <link href="../../intro.js/introjs.css" rel="stylesheet">

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
               <a href="#">Foros</a>
               <a href="../desconectar_sesion.php">Salir</a>
           </nav>
       </div>
   </header>
  <main>
    <section id="banner_pr">
      <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-6 col-sm-offset-3">
                <h2>Recurso de aprendizaje</h2>
                <form id="envio" method="post" enctype="multipart/form-data">
                    <p id="oas_existentes" style="display:none;" ><?php
                        require '../clases_negocio/funciones_oa_profesor.php';
                        require '../clases_negocio/funciones_administrador.php';
                        echo obtener_lista_de_oas();
                        ?></p>
                    <div class="form-group" data-step="1" data-intro="¡Bienvenido! Ingresa el Recurso de Aprendizaje (.zip) en este campo">
                        <label for="file">Archivo que contiene el recurso de aprendizaje:</label>
                        <p id="error2" style="display:none; color:#FF0000;">
                            El límite máximo de tamaño de archivo es 10MB.
                        </p>
                        <input type="file" class="form-control" id="o_aprendizaje" name="o_aprendizaje" required>
                    </div>

                    <div class="camposOA" data-step="2" data-intro="Ingresa los datos del Recurso de Aprendizaje en estos campos">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <p id="oas_duplicados" style="display:none; color:#FF0000;">
                                El nombre del recurso ya ha sido utilizado!
                            </p>
                            <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>

                        <div class="form-group">
                            <label for="institucion">Institución:</label>
                            <input type="text"  class="form-control" id="institucion" name="institucion" required>
                        </div>

                        <div class="form-group">
                            <label for="palabras_claves">Palabras claves:</label>
                            <input type="text"  class="form-control" id="palabras_claves" name="palabras_claves" required>
                        </div>

                        <label >Carreras:</label>
                        <select class= "form-control" id="cbx_carreras"  name="carreras" dir="ltr" required>
                            <option value="0">Selecione una Carrera</option>
                            <?php
                              while($row = mysqli_fetch_array($result)){
                            ?>
                                <option value = "<?php echo $row['idfacultad'];?>"> <?php echo $row['facultad'];?></option>
                            <?php
                              }
                            ?>
                        </select>
                        <label >Materias:</label>
                        <select class= "form-control" id="cbx_materia" name="cbx_materia" dir="ltr" required>
                        </select>

                        <label>Repositorio: </label><br/>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="repo" id="repo" value="PRI" checked>
                          <label class="form-check-label" for="repo">
                            Privado
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="repo" id="repo" value="PUB">
                          <label class="form-check-label" for="repo">
                            Público
                          </label>
                        </div>

                        <br/>
                    <input class="btn-group-sm" type="submit" value="Subir Recurso de Aprendizaje" onclick=" location.href='Profesor_Repositorio.php' " />
                </form>
            </div>
        </div>
      </div></br></br></br>
    </section>
  </main>

  <script>
    $(function(){
      $("#envio").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("envio"));
        $.ajax({
            url: "Profesor_insertar_oa.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(html){
                if(html==1){
                    alert("Datos guardados satisfactoriamente");}
                else{
                $("#nombre").val('');
                $("#descripcion").val('');
                $("#institucion").val('');
                $("#palabras_claves").val('');
                $('#envio').val('');
                $('#o_aprendizaje').val('');}
            }
        })
      });
    });

    var a = 0;
    $('#o_aprendizaje').bind('change', function () {
      if (document.getElementById("registrar").disabled == false) {
          document.getElementById("registrar").disabled = true;
      }
      var ext = $('#o_aprendizaje').val().split('.').pop().toLowerCase();
      if ($.inArray(ext, ['zip']) == -1) {
          $('#error1').slideDown("slow");
          $('#error2').slideUp("slow");
          a = 0;
      } else {
          var picsize = (this.files[0].size);
          if (picsize > 10000000) {
              $('#error2').slideDown("slow");
              a = 0;
          } else {
              a = 1;
              $('#error2').slideUp("slow");
          }
          $('#error1').slideUp("slow");
      }
    });
    //funcion validacion Recursos
    function comprobar_existencia(arreglo, valor) {
        var flag = false;
        for (i = 0; i < arreglo.length; i++)
        {
            if (arreglo[i].trim().localeCompare(valor.trim()) === 0)
                flag = true;
        }
        return flag;
    }
    $(document).ready(function () {
        var isvalue = document.getElementById("oas_existentes").innerHTML;
        isvalue = isvalue.split(',');
        $('#nombre').keyup(function () {
            let useramount = $(this).val();
            if (comprobar_existencia(isvalue, useramount)) {
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
        if (document.getElementById('nombre').value.match(caracteres) && document.getElementById('nombre').value.length<=15)
        {
            return true;
        } else
        {
            if(!document.getElementById('nombre').value.match(caracteres)){
                 alert('El nombre solo puede contener letras(no caracteres especiales) y numeros!');
            }
            if(document.getElementById('nombre').value.length>15){
                alert('El nombre solo puede contener 15 caracteres como máximo!');
            }
            return false;
        }
    }
</script>

</body>
</html>