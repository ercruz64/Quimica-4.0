<?php  
require_once('conexion.php');
class NotasModel extends Conexion
{
	private $tabla = 'notas';
	public function listarNotasModelo(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM notas INNER JOIN personas ON notas.idPersonas = personas.idPersonas INNER JOIN actividades ON notas.idActividad = actividades.idActividades WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
	}

	public function registrarNotasModel($datos, $notas){
		$sql = "INSERT INTO $this->tabla(idPersonas, idActividad, nota) VALUES ";
		for ($i = 0; $i < count($notas); $i++) {
			$sql .= "(?,?,?),";
			#var_dump($datos);
		}
        #var_dump($sql);
		$sql = rtrim($sql, ',');
		#var_dump($sql);
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);
			for ($i = 0; $i < count($datos); $i++) {
				$stmt->bindParam($i + 1, $datos['idPersona'], PDO::PARAM_INT);
				$stmt->bindParam($i + 2, $datos['idActividad'], PDO::PARAM_INT);
				$stmt->bindParam(3, $notas[$i], PDO::PARAM_STR);
			}
            //var_dump($datos);
            var_dump($notas);

			if ($stmt->execute()) {
				return "success";
			} else {
				return "error";
			}
		} catch (Exception $e) {
			print_r("ocurrio un error");
		}
	}
}
?>