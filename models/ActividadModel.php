<?php
require_once('conexion.php');
class ActividadModel extends Conexion
{
    private $tabla = "actividades";
    //Registrar actividad
    public function registrarActividadModelo($datos)
    {
        $sql = "INSERT INTO $this->tabla (tituloActividad, nivelMinimo, actividadPuntaje, idUsuario) VALUES (?,?,?,?)";
        try {
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(1, $datos['actividad'], PDO::PARAM_STR);
            $stmt->bindParam(2, $datos['nivelMinimo'], PDO::PARAM_INT);
            $stmt->bindParam(3, $datos['puntaje'], PDO::PARAM_INT);
            $stmt->bindParam(4, $datos['idUsuario'], PDO::PARAM_INT);

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


    public function obtenerIdInsertActividadModelo(){
        $sql = "SELECT MAX(idActividades) AS id FROM $this->tabla";
        try {
            $conn = new Conexion();
            $stmt = $conn->conectar()->prepare($sql);
            if($stmt->execute()){
                return $stmt->fetchAll();
            }
            else{
                return [];
            }
        } catch (Exception $e) {
            
        }

    }

    
    //Listar actividades

    public function listarActividadModel(){
        /*$stmt = Conexion::conectar()->prepare("SELECT * FROM `actividad` INNER JOIN preguntas ON actividad.idpreguntas = preguntas.id INNER JOIN respuestas ON actividad.idrespuestas = respuestas.id WHERE 1");*/
        $stmt = Conexion::conectar()->prepare("SELECT * FROM `actividades` WHERE 1");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }

    
    public function ConsultarActividadesModelo($id){
        $sql = "SELECT * FROM Actividades ORDER BY idActividades DESC";
        try {
            $conn = new Conexion();
            $stmt = $conn->conectar()->prepare($sql);

            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }
            else{
                [];
            }
            $stmt->close();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }





    //Actualizar Actividades con id

    public function ConsultarActividadesIdModelo($id){
        $sql = "SELECT * FROM Actividades WHERE idActividades=?";
        try {
            $conn = new Conexion();
            $stmt = $conn->conectar()->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $stmt->fetchAll();
            }
            else{
                [];
            }
            $stmt->close();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }



    

    public function ActualizarActividadesModelo($datos, $tabla){
        #print "Entro a actualizar";
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre= :nombre, estado_pregunta = :estado_pregunta WHERE idActividad = :idActividad");
        $stmt->bindParam(':idActividad', $datos['idActividad'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':estado_pregunta', $datos['estado_pregunta'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "success";
        }else{
            return "error";
        }

        $stmt->close();
        #UPDATE actividad INNER JOIN preguntas ON actividad.idpreguntas = preguntas.id INNER JOIN respuestas ON actividad.idrespuestas = respuestas.id SET preguntas.preguntas = 'holas', respuestas.respuestas = 'feo' WHERE actividad.id = 1
    }

    public function eliminarAcctividadModel($id, $tabla){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idActividad = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "success";
        }
        else{
            return "error";
        }

        $stmt->close();
    }
}
