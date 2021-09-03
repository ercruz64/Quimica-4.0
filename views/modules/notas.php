<?php  

$nota = new NotasControlador();
$notas = $nota -> listarNotas();
?>
<h1>Entro a Notas</h1>
<br>
<div class="row">
	<div class="col-2">
		
	</div>
	<div class="col-8">
		<table class="table table-striped table-dark" border="1">
			<thead>
				<tr>
					<th>Documento</th>
					<th>Estudiante</th>
					<th>Actividad</th>
					<th>Notas</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				foreach ($notas as $key => $value) {
					print '
					<tr>
						<td>'.$value['numeroDocumento'].'</td>
						<td>'.$value['nombre'].' '.$value['apellido'].'</td>
						<td>'.$value['tituloActividad'].'</td>
						<td>'.$value['nota'].'</td>
					</tr>';
				}
				?>
				<!--<tr>
					<td>Jogan Felipe Rengifo Solarte</td>
					<td>Quimica</td>
					<td>50</td>
				</tr>-->
			</tbody>
		</table>
	</div>
</div>
