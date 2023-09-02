<?php
include_once("conexion.php");
class Tserviciomodelo
{
    public static function md_RegistrarServicio($tiposervicio)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO tipo_servicio(nombre_tipo_servicio)VALUES(:tipo_servicio)");

            $objRespuesta->bindParam(":tipo_servicio", $tiposervicio);
            // si todo esta bien lo ejecuta 
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de servicio registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el nuevo tipo de servicio");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    public static function md_ListarServicios()
    {
        $listarServicios = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_servicio");
            $objRespuesta->execute();
            $listarServicios = $objRespuesta->fetchAll();
            $objRespuesta= null;
            // si todo esta bien lo ejecuta 
        } catch (Exception $e) {
            $listarServicios = $e->getMessage();
        }
        return $listarServicios;
    }
    public static function md_EditarServicio($idTServicio,$idTiposervicio)
    {
        $mensaje = [];
        try {

            $objRespuesta = Conexion::conectar()->prepare("UPDATE tipo_servicio SET nombre_tipo_servicio = :nombre_tipo_servicio WHERE idtipo_servicio = :idtipo_servicio");
            $objRespuesta->bindParam(":nombre_tipo_servicio", $idTiposervicio);
            $objRespuesta->bindParam(":idtipo_servicio", $idTServicio);

            // si todo esta bien lo ejecuta 
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de servicio actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al actualizar el tippo de vehiculo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    public static function md_EliminarServicio($idTipoServicio)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM tipo_servicio WHERE idtipo_servicio=:idtipo_servicio");
            $objRespuesta->bindParam(":idtipo_servicio", $idTipoServicio);

            // si todo esta bien lo ejecuta 
            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "tipo de servicio eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al eliminar el servicio");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
