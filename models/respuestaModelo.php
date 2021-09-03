<?php 


class RespuestaModelo extends Conexion {
	private $tabla = 'respuestas';
	function cargarRespuestasModelo($id)
	{
		$sql = "SELECT * FROM $this->tabla WHERE idPreguntas = ?";
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			if($stmt->execute()){
				return $stmt->fetchAll();
			}
			else{
				return [];
			}
			$stmt->close();
		} catch (PDOException $e) {
			print_r($e->getMessage());
		}
	}


	public function insertarRespuestasModelo($datosRespuesta){
		$sql = "INSERT INTO $this->tabla (idPreguntas, descripcionRespuesta, resultado, resultadoMultiple) VALUES (?,?,?,?)";
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);
			$stmt->bindParam(1, $datosRespuesta['idPregunta'], PDO::PARAM_INT);
			$stmt->bindParam(2, $datosRespuesta['descripcionRespuesta'], PDO::PARAM_STR);
			$stmt->bindParam(3, $datosRespuesta['resultado'], PDO::PARAM_STR);
			$stmt->bindParam(4, $datosRespuesta['resultadoMultiple'], PDO::PARAM_STR);
			$stmt->execute();
			//$stmt->close();
		} catch (PDOException $e) {
			print_r($e->getMessage());
		}
	}
}
