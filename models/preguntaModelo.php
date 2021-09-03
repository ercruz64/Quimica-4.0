<?php 


class PreguntaModelo extends Conexion {
	private $tabla = "preguntas";
	public function cargarPreguntasModelo($idActividad) {
		$sql = "SELECT * FROM $this->tabla WHERE idActividades=? ";
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);
			$stmt->bindParam(1,$idActividad, PDO::PARAM_INT);
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


	public function insertarPreguntaModelo($datosPregunta){
		$sql = "INSERT INTO $this->tabla (idActividades, descripcionPregunta) VALUES (?,?)";
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);
			$stmt->bindParam(1, $datosPregunta['idActividad'], PDO::PARAM_INT);
			$stmt->bindParam(2, $datosPregunta['descripcionPregunta'], PDO::PARAM_STR);

			if ($stmt->execute()) {
				return true;
			}
			else{
				return false;
			}
			$stmt->close();			
		} catch (PDOException $e) {
			print_r($e->getMessage());
		}
	}


	public function consultarUltimoIdPreguntaModelo(){
		$sql = "SELECT MAX(idPreguntas) AS id FROM $this->tabla";
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);

			if ($stmt->execute()) {
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
}
