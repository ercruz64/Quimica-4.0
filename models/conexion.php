<?php  
class Conexion{
	public function conectar(){
		$pdo = new PDO("mysql:host=localhost:3325;dbname=quimica","root","");
		return $pdo;
	}

	
}

?>