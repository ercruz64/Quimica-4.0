<?php  
//session_start();

if (!$_SESSION['validar']) {
	header('location:ingresar');

	exit();
}
?>

<h1 class="h3 mb-3 font-weight-normal">ACTUALIZAR DATOS DEL USUARIO</h1>

<form method="post" class="form-signin" class="formulario">
	<?php 
	$editar = new UsuarioControlador();
	$editar->consultarUsuarioIdControlador();
	$editar->actualizarUsuarioControlador();
	?>
	
</form>

<?php

$editar = new UsuarioControlador();
	//$editar->consultarUsuarioIdControlador();

?>
