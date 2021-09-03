<?php  

class Controlador{
	
	//metodo que carga la plantilla en el index
	///////////////////////////////////////////

	function cargarTemplate(){
		
		include 'views/template.php';
		
	}


	//metodo que permite gestionar los enlaces del sitio
	///////////////////////////////////////////////////

	public function enlacesPaginasControlador(){
		if (isset($_GET['action'])) {
			$enlace = $_GET['action'];
		}
		else{
			$enlace = "ingresar";
		}
		//print $enlace;

		$respuesta = EnlacesPaginasModelo::enlacesPaginas($enlace);
		include ($respuesta);
	}

	
}
?>