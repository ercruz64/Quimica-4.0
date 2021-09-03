<?php  
class GradoControlador
{
	
	public function registrarGrado(){
		if (isset($_POST['grado'])) {
			$datos = array('grado' => $_POST['grado']);
			$respuesta = GradoModelo::registrarGradoModelo($datos, 'grado');
			//print $respuesta;
			if ($respuesta == 'success') {
				header('location:gradook');
			}else{
				print '<p class="alert alert-success" role="alert">Grado No registrado<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></p>';
			}
		}
	} 

	public function listarGrado(){
		$respuesta = GradoModelo::listarGradoModelo('grado');
		return $respuesta;
	}

	public function registrarPersonasGrado(){
		if (isset($_POST['grados'])) {
			$datos = array('persona' => $_POST['personas'],
							'grado' => $_POST['grados'],
							'fecha' => $_POST['fechaInicio']);
			//var_dump($datos);
			$respuesta = GradoModelo::registrarPersonasGradoModelo($datos, 'personasgrado');
			//print $respuesta;
			if ($respuesta == 'success') {
				header('location:gradosok');
			}else{
				print '<p class="alert alert-success" role="alert"Persona No registrado<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></p>';
			}
		}
	}

	public function listarPersonasGrado(){
		$respuesta = GradoModelo::listarPersonasGradoModelo('personasgrado');
		return $respuesta;
	}

	public function BuscarPersonas(){
		if (isset($_POST['buscar'])) {
			switch ($_POST['camBuscar']) {
				case 'inicioInscripcion':
					$campo = "inicioInscripcion";
					break;
				
				default:
					$campo = "";
					break;
			}
		}
		if (isset($_POST['campbuscar'])) {
			$dato = $_POST['campbuscar'];
		}else{
			$dato = "";
		}
		//$persona = GradoModelo::BuscarPersona($dato, $campo);
		//return $persona;
	}
}
?>