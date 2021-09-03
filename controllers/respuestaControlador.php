<?php 


class RespuestaControlador {
	
	function cargarRespuestasControlador($id) 	{
		$respuestaModelo = new RespuestaModelo();
		$respuestas = $respuestaModelo->cargarRespuestasModelo($id);
		//print_r($respuestas);
		return $respuestas;
	}


	public function insertarRespuestaControlador($datosRespuesta){
		$respuestaModelo = new RespuestaModelo();
		$respuestaModelo->insertarRespuestasModelo($datosRespuesta);
	}
}