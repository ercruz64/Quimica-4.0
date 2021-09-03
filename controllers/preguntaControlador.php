<?php 


class PreguntaControlador {

	public function cargarPreguntasControlador($idActividad) {
		if ($_SESSION['idPersonas']) {
			$preguntaModelo = new PreguntaModelo();
			$respuesta = $preguntaModelo->cargarPreguntasModelo($idActividad);
			return $respuesta;
		}
	}


	public function insertarPreguntaContralador($datosPregunta){
		$preguntaModelo = new PreguntaModelo();
		$respuesta = $preguntaModelo->insertarPreguntaModelo($datosPregunta);
		return $respuesta;
	}

	public function obtenerUltimoIdPreguntaControlador() {
		$preguntaModelo = new PreguntaModelo();
		$respuesta = $preguntaModelo->consultarUltimoIdPreguntaModelo();
		return $respuesta;
	}


	public function consultarPreguntasIdActividadControlador(){
		if (isset($_POST['conPreguntas'])) {
			$preguntaModelo = new PreguntaModelo();
			$datosPregunta = $preguntaModelo->cargarPreguntasModelo($_POST['idActividad']);
			return $datosPregunta;
		}
	}

}