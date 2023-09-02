<?php
include_once("conexion.php");

class Tvehiculomodelo
{
    public static function md_RegistrarVehiculo($tipoVehiculo)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO tipo_vehiculo(nombre_tipo_vehiculo) VALUES (:tipo_vehiculo)");

            $objRespuesta->bindParam(":tipo_vehiculo", $tipoVehiculo);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de vehiculo registrado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el nuevo tipo de vehiculo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function md_ListarVehiculos()
    {
        $listaVehiculos = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_vehiculo");
            $objRespuesta->execute();
            $listaVehiculos = $objRespuesta->fetchAll();
            $objRespuesta= null;
            
        } catch (Exception $e) {
            $listaVehiculos = $e->getMessage();
        }
        return $listaVehiculos;
    }

    public static function md_EditarVehiculo($idVehiculo, $nuevoTipo)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE tipo_vehiculo SET nombre_tipo_vehiculo = :nuevo_tipo WHERE idtipo_vehiculo = :id_vehiculo");
            $objRespuesta->bindParam(":nuevo_tipo", $nuevoTipo);
            $objRespuesta->bindParam(":id_vehiculo", $idVehiculo);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de vehiculo actualizado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al actualizar el vehiculo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function md_EliminarVehiculo($idVehiculo)
    {
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM tipo_vehiculo WHERE idtipo_vehiculo = :id_vehiculo");
            $objRespuesta->bindParam(":id_vehiculo", $idVehiculo);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Tipo de vehiculo eliminado correctamente");
            } else {
                $mensaje = array("codigo" => "425", "mensaje" => "Error al eliminar el vehiculo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
?>
