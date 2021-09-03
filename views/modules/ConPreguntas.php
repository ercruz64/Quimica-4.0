<?php 

$actividadControlador = new ActividadesControlador();
$preguntaControlador = new PreguntaControlador();


$datosActividades = $actividadControlador->ConsultarActividad();
$datosPregunta = $preguntaControlador->consultarPreguntasIdActividadControlador();

?>

<div class="row">
	<div class="col">
		<h1>CONSULTAR PREGUNTAS DE ACTIVIDADES</h1>
	</div>
</div>
<div class="row">	
	<div class="col">
		<form method="post">
			<label for="">Activades</label>
			<select name="idActividad" id="idActividad">
				<option value="0">Seleccione una Actividad</option>
				<?php 

				foreach ($datosActividades as $keyActivdad => $valueActividad) {
					print '<option value="'.$valueActividad['idActividades'].'">'.$valueActividad['tituloActividad'].'</option>';
				}

				?>

			</select>
			<input type="submit" name="conPreguntas" value="Consultar">
		</form>
	</div>
</div>
<div class="row">
	<div class="col">
		<h2 class="text-center">Preguntas de las actividades</h2>
	</div>
</div>

<?php 

if (isset($datosPregunta)): ?>
<div class="row">
	<div class="col">
		<table class="table">
			<thead>
				<th>Enunciado de las Preguntas</th>
			</thead>
			<tbody>
				<?php 

				foreach ($datosPregunta as $keyPregunta => $valuePregunta) {
					print '<tr><td>'.$valuePregunta['descripcionPregunta'].'</td>
					<td><a href="index.php?action=upPregunta&id='.$valuePregunta['idPreguntas'].'">Editar</a></td></tr>';
				}

				 ?>
			</tbody>
		</table>
	</div>
</div>	
<?php endif ?>

