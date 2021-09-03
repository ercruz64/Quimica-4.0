<?php 
require_once('conexion.php');

class ResultadosActividadModelo extends Conexion {
	
	private $tabla = "resultadosactividades";
	private $valoresInsertar = '';

	function registrarResultadoActividadModelo($datosRespuesta)	{
		
		$sql = "INSERT INTO $this->tabla (idRespuesta, idPersona) VALUES ";

		foreach ($datosRespuesta as $key => $value) {
			$this->valoresInsertar .= '(?,?),';
			print "<br>El valor en el modelo es ".$value;
		}

		$this->valoresInsertar = substr($this->valoresInsertar, 0, -1);

		$sql .= $this->valoresInsertar;
		$posicionBind = 1;
		try {
			$conn = new Conexion();
			$stmt = $conn->conectar()->prepare($sql);
			for ($i=0; $i < count($datosRespuesta); $i++) { 
				$stmt->bindParam($posicionBind, $datosRespuesta[$i], PDO::PARAM_STR);
				$posicionBind++;
				$stmt->bindParam($posicionBind, $_SESSION['idPersonas'], PDO::PARAM_INT);
				$posicionBind++;
			}
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
}