<?php  

$grado = new GradoControlador();
$grado->registrarGrado();
$grado->registrarPersonasGrado();
$ctrl = $grado->listarGrado();
if (isset($_GET['action'])) {
	if ($_GET['action'] ==  "gradook") {
		print '<p class="alert alert-success" role="alert">Grado Registrado<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button></p>';
	}


	$persona = new UsuarioControlador();
	$ctrl1 = $persona->listarPersonasControlador();
}
if (isset($_GET['action'])) {
	if ($_GET['action'] ==  "gradosok") {
		print '<p class="alert alert-success" role="alert">Persona Registrado<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button></p>';
	}
}

?>
<div class="row">
	<div class="col-2">
		
	</div>
	<div class="col-4">
		<form action="" method="post" accept-charset="utf-8">
			<label>Curso o Grado</label>
			<br>
			<input type="text" name="grado" placeholder="Grado" required="" class="form-control">
			<br>
			<button type="submit" name="enviars" class="btn btn-primary mb-2">Registrar Grado</button>
		</form>
	</div>

	<div class="col-4">
		<form action="" method="post" accept-charset="utf-8">
			<label>Usuario</label>
			<select class="form-control" name="personas">
				<option >Seleccione un usuario</option>
				<?php  
				foreach ($ctrl1 as $key => $value) {
					print '<option value="'.$value[0].'">'.$value[4].' '.$value[1].'  '.$value[2].'</option>}
					option';
				}
				?>
			</select>
			<label>Grado</label>
			<select class="form-control" name="grados">
				<option >Seleccione un Grado</option>
				<?php  
				foreach ($ctrl as $key => $value) {
					print '<option value="'.$value[0].'">'.$value[1].'</option>}
					option';
				}
				?>
			</select>
			<label>Fecha de inicio</label>
			<input type="date" name="fechaInicio" class="form-control">
			<br>
			<button type="submit" class="btn btn-primary mb-2">Asignar Grado</button>
		</form>
	</div>
</div>
<br><br>
<div class="row">
	<div class="col-2">
		<?php 
			$buscar = new GradoControlador();
			$buscar->BuscarPersonas();
		?>
		<!--<form action="" method="post" class="formulario">
			<div class="form-group mx-sm-3 mb-2">
				<input class="form-control" type="text" name="campbuscar" require>
			</div>
			<button type="submit" class="btn btn-primary mb-2" name="buscar" value="buscar">Buscar</button>
			<div class="row">
				<div class="col-4">
					<input type="date" name="camBuscar" value="fechaInscripcion" required> FechaInscripcion
				</div>
			</div>
		</form>-->
	</div>
	<div class="col-8">
		<?php  
		$personasGrado = new GradoControlador();
		$ctrl = $personasGrado->listarPersonasGrado();
		?>
		<table class="table table-striped table-dark">
			<thead>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Numero Documento</th>
				<th>Grado</th>
				<th>Fecha de Inicio</th>
			</thead>
			<tbody>
				<?php  
				foreach ($ctrl as $key => $value) {
					print '<tr>
					<td>'.$value['nombre'].'</td>
					<td>'.$value['apellido'].'</td>
					<td>'.$value['numeroDocumento'].'</td>
					<td>'.$value['nombreGrado'].'</td>
					<td>'.$value['fechaInscripcion'].'</td>
					</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>
