<?php
class UsuarioControlador
{
	//METODO PARA REGISTRAR LOS USURARIOS:
	public function registrarUsuariosControlador()
	{
		if (isset($_POST['nombreRegistro'])) {
			$datos = array(
				'nombre' => $_POST['nombreRegistro'],
				'email' => $_POST['emailRegistro'],
				'clave' => $_POST['claveRegistro'],
				't_d' => $_POST['t_dRegistro'],
				'n_d' => $_POST['n_dRegistro'],
				'fn' => $_POST['fnRegistro'],
				'numero' => $_POST['numeroRegistro']
			);

			$respuesta = UsuariosModel::registarUsuariosModelo($datos, 'personas');
			//print $respuesta;
			if ($respuesta == 'success') {
				header('location:ingresar');
			} else {
				print "Usuario no Registrado";
			}
		}
	}

	public function registrarPersonasRolesControlador(){
		if (isset($_POST['personas'])) {
			$datos = array('persona' => $_POST['personas'],
				'rol' => $_POST['rol']);
			$respuesta = UsuariosModel::registrarPersonasRolesModelo($datos, 'personasrol');
			//print $respuesta;
			//print_r($datos);
			if ($respuesta == 'success') {
				header('location:rolokss');
			}else{
				print '<p class="alert alert-success" role="alert">Rol no Registrado <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></p>';
			}
		}
	}


	public function ingresarUsuarioControlador(){
 
		if (isset($_POST['enviarAcceso'])) {

			$datos = array(
				'email' => $_POST['emailIngreso'],
				'clave' => $_POST['claveIngreso']
			);


			$respuesta = UsuariosModel::ingresarUsuariosModelo($datos, 'personasrol');

			var_dump($respuesta);

			if ($respuesta['email'] == $_POST['emailIngreso'] &&
				$respuesta['password'] == $_POST['claveIngreso']) {


				session_start();
				$_SESSION['idPersonas'] = $respuesta['idPersonas'];
				$_SESSION['validar'] = true;
				$_SESSION['email'] = $respuesta['email'];
				$_SESSION['Roles'] = $respuesta['Roles'];

				if ($_SESSION['Roles'] == "Administrador") {
					header('location:usuario');
				} else {
					header('location:usuario');
				}
			} else {
				header('location:falla');
			}
		}
	}

	public function listarUsuarioControlador()
	{
		$respuesta = UsuariosModel::listarUsuariosModel('personas');
		//var_dump($respuesta);
		foreach ($respuesta as $row => $valor) {
			print "
			<tr>
			<td>{$valor['nombre']}</td>
			<td>{$valor['apellido']}</td>
			<td>{$valor['documentoIdentidad']}</td>
			<td>{$valor['numeroDocumento']}</td>
			<td>{$valor['email']}</td>
			<td>{$valor['password']}</td>
			<td>{$valor['fechaNacimiento']}</td>
			<td><a href='index.php?action=editar&id={$valor['idPersonas']}'><button class='btn btn-primary mb-2'><img src='https://image.flaticon.com/icons/png/128/1160/1160758.png' width='20'></button>
			</a>
			</td>
			<td><a href='index.php?action=usuario&del={$valor['idPersonas']}'><button class='btn btn-primary mb-2'><img src='https://image.flaticon.com/icons/png/128/3496/3496416.png' width='20'></button>
			</a>
			</td>
			</tr>"
			;
		}
	}

	public function listarRolesControlador(){
		$respuesta = UsuariosModel::listarRolesModel('rol');
		//print_r ($respuesta);
		return $respuesta;
	}
	public function listarPersonasControlador(){
		$respuesta = UsuariosModel::listarUsuariosModel('personas');
		return $respuesta;
		//print_r($respuesta);
	}
	//Administrador
	public function consultarUsuarioIdControlador()
	{
		$id = $_GET['id'];
		$respuesta = UsuariosModel::consultarUsuariosIdModel($id, 'personas');
		print
		'	
		<input type="hidden" name="id" value="' . $respuesta['idPersonas'] . '">
		<div class="row">
		<div class="col">
		<h6>Nombre </h6>
		<input type="text" class="form-control" name="nombreEditar" value="'.$respuesta['nombre'].'" placeholder="Nombre " required="">
		</div>

		</div>

		<div class="row">
		<div class="col">
		<h6>Apellido</h6>
		<input type="text" class="form-control" name="apellidoEditar" value="'.$respuesta['apellido'].'" placeholder="Apellido" required="">
		</div>

		<div class="col">
		<h6>Tipo Documento</h6>
		<input type="text" class="form-control" name="t_dEditar" value="'.$respuesta['documentoIdentidad'].'" placeholder="T.I" required="">
		</div>
		</div>

		<div class="row">
		<div class="col">
		<h6>Numero Documento</h6>
		<input type="text" class="form-control" name="n_dEditar" value="'.$respuesta['numeroDocumento'].'" placeholder="Numero" required="">
		</div>

		<div class="col">
		<h6>Fecha Nacimiento</h6>
		<input type="date" class="form-control" name="fNEditar" value="'.$respuesta['fechaNacimiento'].'" placeholder="fechaNacimiento" required="">
		</div>
		</div>

		<div class="row">
		<div class="col">
		<h6>Email</h6>
		<input type="email" class="form-control" name="emailEditar" value="'.$respuesta['email'].'" placeholder="Email" required="">
		</div>

		<div class="col">
		<h6>Contraseña</h6>
		<input type="password" class="form-control" name="claveEditar" value="'.$respuesta['password'].'" placeholder="Contraseña" maxlength="8" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
		</div>
		</div>
		<!--<label>Rol</label>
		<select name="rolEditar" required> 
		<option>selecione rol</option>
		<option value = "1" ';
		if ($respuesta['rol'] == 1)
			print 'selected';
		print '>Estudiante</option>
		<option value = "2" ';
		if ($respuesta['rol'] == 2)
			print 'selected';
		print '>Docente</option>
		<option value = "3" ';
		if ($respuesta['rol'] == 3)
			print 'selected';
		print '>Administrador</option>
		</select>-->
		<br>
		<button type="submit" class="btn btn-primary mb-2">Actualizar</button>';
	}
	//Usuarios


	public function actualizarUsuarioControlador()
	{
		if (isset($_POST['nombreEditar'])) {
			$datos = array(
				'id' => $_POST['id'],
				'nombre' => $_POST['nombreEditar'],
				'apellido' => $_POST['apellidoEditar'],
				'clave' => $_POST['claveEditar'],
				'email' => $_POST['emailEditar'],
				't_d' => $_POST['t_dEditar'],
				'n_d' => $_POST['n_dEditar'],
				'fN' => $_POST['fNEditar']
			);

			$respuesta = UsuariosModel::actualizarUsuarioModel($datos, 'personas');

			if ($respuesta == "success") {
				//header('location:change');
				print '<p class="alert alert-success" role="alert">Usuario Actualizado Correctamente <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></p>';
			} else {
				print "Error";
			}
		}
	}



	public function eliminarUsuarioControlador()
	{
		if (isset($_GET['del'])) {
			$dato = $_GET['del'];
			$respuesta = UsuariosModel::eliminarUsuarioModel($dato, 'personas');

			if ($respuesta == "success") {
				print '<p class="alert alert-success" role="alert">Usuario Eliminado <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></p>';
				//header('location:usuario');
			}
		}
	}

	public function BuscarUsuarios(){
		if(isset($_POST['buscar'])){
			switch($_POST['camBuscar']){
				case 'nombre':
				$campo = "nombre";
				break;
				case 'email':
				$campo = "email";
				break;
				case 'tipoDocumento':
				$campo = "tipoDocumento";
				break;
				case 'numeroDocumento':
				$campo = "numeroDocumento";
				break;
				case 'numero':
				$campo = "numero";
				break;
				case 'fechaNacimiento':
				$campo = "fechaNacimeinto";
				break;
				default:
				$campo = "";
				break;
			}
			if(isset($_POST['campbuscar'])){
				$dato = $_POST['campbuscar'];
			}else{
				$dato = "";
			}
			$usuario = UsuariosModel::buscarDatos($campo, $dato);
			return $usuario;
			//var_dump($usuario);
		}
		/*else{
			$usuario = UsuariosModel::buscarDatos('', '');
			return $usuario;
		}*/
	}
}
