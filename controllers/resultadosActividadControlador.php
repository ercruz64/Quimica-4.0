<?php 



class ResultadosActividadControlador {
	
	public function registrarResultadoActividadControlador() {
		if (isset($_POST['regResultadoActividad'])) {

			$resultadoActividadModelo = new ResultadosActividadModelo();
			$resultado = $resultadoActividadModelo->registrarResultadoActividadModelo($_POST['idPregunta']);

			if ($resultado) {
				header('location:index.php?action=ok1');
			}
			else{
				header('location:index.php?action=fa1');	
			}
		
		}
	}
}

?>