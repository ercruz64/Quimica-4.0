<?php  

require_once('conexion.php');

class UsuariosModel extends Conexion{
		//METODO PARA INSERTAR (CREATE) DATOS EN LA BD
	public function registarUsuariosModelo($datos, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, email, apellido, password, documentoIdentidad, numeroDocumento, fechaNacimiento) VALUES (:nombre,:email, :clave, :numero, :t_d, :n_d, :fn)");
		$stmt->bindParam(':nombre',$datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':email',$datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(':clave',$datos['clave'], PDO::PARAM_STR);
		$stmt->bindParam(':t_d',$datos['t_d'], PDO::PARAM_STR);
		$stmt->bindParam(':n_d',$datos['n_d'], PDO::PARAM_STR);
		$stmt->bindParam(':fn',$datos['fn'], PDO::PARAM_STR);
		$stmt->bindParam(':numero',$datos['numero'], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();
	}

	public function registrarPersonasRolesModelo($datos, $tabla){
		$sql = "INSERT INTO $tabla(`idPersonas`, `idRol`) VALUES (?,?)";
		try {
			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->bindParam(1,$datos['persona'],PDO::PARAM_INT);
			$stmt->bindParam(2,$datos['rol'],PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "success";
			}else{
				return "error";
			}
		} catch (Exception $e) {
			
		}
		$stmt->close();
	}

	public function ingresarUsuariosModelo($datos, $tabla){
		//$stmt = Conexion::conectar()->prepare("SELECT * FROM `personasrol` INNER JOIN personas ON personasrol.idPersonas = personas.idPersonas INNER JOIN rol ON personasrol.idRol = rol.idRol WHERE email = email");

		$stmt = Conexion::conectar()->prepare("SELECT personas.idPersonas, personas.email, personas.password, rol.Roles FROM `personasrol` INNER JOIN personas ON personasrol.idPersonas = personas.idPersonas INNER JOIN rol ON personasrol.idRol = rol.idRol WHERE personas.email = :email");

		$stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	public function listarUsuariosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM `personas` WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
	}

	public function listarRolesModel($table){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM `rol` WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();

		$stmt->close();
	}

	public function consultarUsuariosIdModel($id, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idPersonas = :id");

		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	public function actualizarUsuarioModel($datos, $tabla){
		$stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email,
			password = :clave, documentoIdentidad = :t_d, numeroDocumento = :n_d, fechaNacimiento = :fN, apellido = :apellido WHERE idPersonas = :id");

		$stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(':clave', $datos['clave'], PDO::PARAM_STR);
		$stmt->bindParam(':t_d', $datos['t_d'], PDO::PARAM_STR);
		$stmt->bindParam(':n_d', $datos['n_d'], PDO::PARAM_STR);
		$stmt->bindParam(':fN', $datos['fN'], PDO::PARAM_STR);
		$stmt->bindParam(':apellido', $datos['apellido'], PDO::PARAM_STR);
		$stmt->bindParam(':id', $datos['id'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "success";
		}
		else{
			return "Error";
		}

		$stmt->close();

	}

	//Perfil

	public function actualizarPerfilModel($datos, $tabla){
		$stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email,
			password = :claves, fechaNacimiento = :fN, apellido = :apellido WHERE idPersonas = :id");

		$stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(':email', $datos['email'], PDO::PARAM_STR);
		$stmt->bindParam(':claves', $datos['claves'], PDO::PARAM_STR);
		$stmt->bindParam(':fN', $datos['fN'], PDO::PARAM_STR);
		$stmt->bindParam(':apellido', $datos['apellido'], PDO::PARAM_STR);
		$stmt->bindParam(':id', $datos['id'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "success";
		}
		else{
			return "Error";
		}

		$stmt->close();

	}



	public function eliminarUsuarioModel($id, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idPersonas = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();
	}

	public function buscarDatos($campo, $dato){
		switch ($campo) {
			case 'nombre':
				$cond = "nombre like ?";
				$dato .= '%';
				break;
			case 'email':
				$cond = "email like ?";
				$dato .= '%';
				break;
			case 'tipoDocumento':
				$cond = "tipoDocumento like ?";
				$dato .= '%';
				break;
			case 'numeroDocumento':
				$cond = "numeroDocumento like ?";
				$dato .= '%';
				break;
			case 'numero':
				$cond = "numero like ?";
				$dato .= '%';
				break;
			case 'fechaNacimeinto':
				$cond = "fechaNacimeinto like ?";
				$dato .= '%';
				break;
			default:
				$cond = 1;
				break;
		}
		$sql = "SELECT * FROM `personasrol` INNER JOIN personas ON personasrol.idPersonas = personas.idPersonas INNER JOIN rol ON personasrol.idRol = rol.idRol WHERE $cond";
		#print $sql;
		try {
			$stmt = Conexion::conectar()->prepare($sql);
			$stmt -> bindParam(1,$dato, PDO::PARAM_STR);
			if($stmt->execute()){
				return $stmt -> fetchAll();
			}
			else{
				return [];
			}
			$stmt -> close();
		} catch (\Throwable $th) {
			print_r("ocurrio un error");
		}
	}

}
