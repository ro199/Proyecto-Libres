<?php
require '../../aplicacion/clases_negocio/funciones_Registro.php';

$cedula = filter_input(INPUT_POST, 'cedula');
$nombres = filter_input(INPUT_POST, 'nombres');
$apellidos = filter_input(INPUT_POST, 'apellidos');
$email = filter_input(INPUT_POST, 'email');
$TipoUsuario = filter_input(INPUT_POST, 'tipo_usuario');
print($TipoUsuario);

$usuario= generar_usuario_profesor($nombres, $apellidos);
$contrasenia= generar_cadena_aleatoria();

insertar_usuario($usuario, $contrasenia,'PRO', 'F');
$id_usuario= recuperar_id_usuario_por_nombre($usuario);
if(insertar_profesor($cedula, $nombres, $apellidos, $departamento, $facultad, $email, $id_usuario)){
     enviar_mail3($email,$usuario,$contrasenia);
	 echo '<script>alert("Usuario registrado correctamente! Revise su mail para obtener las credenciales")</script> ';
	
     echo "<script>location.href='../../aplicacion/formularios_registro/Login.html'</script>";
}else{
    echo '<script>alert("No se ha podido registrar el usuario. Contacte a un administrador")</script> ';
    echo "<script>location.href='../../aplicacion/formularios_registro/Login.html'</script>";
}

?>