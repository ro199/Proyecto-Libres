<?php
session_start();
if($_SESSION['usuario']){
        session_unset();
	session_destroy();
	echo "<script>location.href='formularios_registro/Login.html'</script>";
}
else{
	echo "<script>location.href='formularios_registro/Login.html'</script>";
}
?>
