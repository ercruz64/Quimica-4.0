<?php
class ActividadesControlador
{
    public function registrarActividadesControlador()
    {
        if (isset($_POST['regActividad'])) {
            $actividadModelo = new ActividadModel();
            $preguntaControlador = new PreguntaControlador();
            $respuestaControlador = new RespuestaControlador();            
            
            $contPreguntas = 0;
            $datosActividad = array('actividad' => $_POST['actividad'], 
                'nivelMinimo' => $_POST['nivelMinimo'],
                'puntaje' => $_POST['puntaje'],
                'idUsuario' => $_SESSION['idPersonas']);

            $resultado = $actividadModelo->registrarActividadModelo($datosActividad);
            if ($resultado) {
                $ultimoIdActividad = $actividadModelo->obtenerIdInsertActividadModelo();
                $idActividad = $ultimoIdActividad[0]['id'];   
            }

            if (isset($_POST['pregunta'])) {
                foreach ($_POST['pregunta'] as $keyPregunta => $valuePregunta) {
                    $datosPregunta = array('idActividad'=>$idActividad,
                        'descripcionPregunta' => $valuePregunta);

                    $resultadoPreguntas = $preguntaControlador->insertarPreguntaContralador($datosPregunta);

                    if ($resultadoPreguntas) {
                        $respuesta = $preguntaControlador->obtenerUltimoIdPreguntaControlador();
                        $contPreguntas++;
                        $idPregunta = $respuesta[0]['id'];
                    }

                    $numRespuestas = count($_POST['respuesta'][$keyPregunta]);

                    $controlMultiple = false;
                    
                    foreach ($_POST['respuesta'][$keyPregunta] as $keyRespuesta => $valueRespuesta) {

                        if ($numRespuestas == 1) {
                            $resultadoMultiple = 'Correcto';
                        }
                        elseif ($numRespuestas > 1) {
                            if ($controlMultiple == false) {
                                $resultadoMultiple = 'Correcto';
                                $controlMultiple = true;
                            }
                            else{
                                $resultadoMultiple = 'Incorrecto';
                            }
                        }
                        $datosRespuesta = array('idPregunta' => $idPregunta,
                            'descripcionRespuesta' => $valueRespuesta,
                            'resultado' => $valueRespuesta,
                            'resultadoMultiple' => $resultadoMultiple);

                        $respuestaControlador->insertarRespuestaControlador($datosRespuesta);
                    }
                }
            }
        }
    }

    

    

    

    //Listar actividades

    public function listarActividad()
    {
        $respuesta = ActividadModel::listarActividadModel('preguntas');
        #var_dump($respuesta);
        foreach ($respuesta as $row => $valor) {
            print
            "
            <tr>
            <td>{$valor['idActividades']}</td>
            <td>{$valor['tituloActividad']}</td>
            <td>{$valor['nivelMinimo']}</td>
            <td><a href='index.php?action=RealizarActividad&id={$valor['idActividades']}'><button class='btn btn-primary mb-2'><img src='https://image.flaticon.com/icons/png/128/1160/1160758.png' width='20'></button></a></td>
            </a>
            </td>
            </tr>
            ";
        }
    }
    public function ListarActividadControlador(){
        $respuesta = ActividadModel::listarActividadModel('actividad');
        #var_dump($respuesta);
        return $respuesta;
    }
    public function listarPreguntaControlador(){
        $respuesta = ActividadModel::listarPreguntaModel('pregunta');
        return $respuesta;
    }
    //Actualizar Actividades

    public function ConsultarActividad()
    {
        $id = $_SESSION['idPersonas'];
        $respuesta = ActividadModel::ConsultarActividadesModelo($id);
        return $respuesta;
    }

 
    public function ActualizarActividades(){
        if (isset($_POST['ActividadEditar'])) {
            $datos = array('idActividad' => $_POST['id'],
                'nombre' => $_POST['ActividadEditar'],
                'estado_pregunta' => $_POST['estado']);

            $respuesta = ActividadModel::ActualizarActividadesModelo($datos, 'actividad');
            if ($respuesta == "success") {
                header('location:oksss');
            }
        }
    }

    public function EliminarActividad() {
        if (isset($_GET['del'])) {
            $dato = $_GET['del'];
            $respuesta = ActividadModel::eliminarAcctividadModel($dato, 'actividad');

            if ($respuesta == "success") {
                header('location:del');
                //header('location:usuario');
            }
        }
    }
}
