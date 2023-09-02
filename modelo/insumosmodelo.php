<?php
 
include_once("conexion.php");

class insumosmodelo{
    public static function md_RegistrarInsumo($nombreInsumo, $descripcionInsumo, $valorInsumo){
        $mensaje =[];
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO insumos(nombre_insumo,descripcion_insumo,valor_insumo)VALUES(:nombre_insumo, :descripcion_insumo, :valor_insumo)");
            $objRespuesta->bindParam(":nombre_insumo",$nombreInsumo);
            $objRespuesta->bindParam(":descripcion_insumo",$descripcionInsumo);
            $objRespuesta->bindParam(":valor_insumo",$valorInsumo);

            
            // si todo esta bien lo ejecuta 
            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"200","mensaje"=>"insumo registrado correctamente");
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"Error al registrar el insumo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }

        return $mensaje;

    }


    public static function mdl_ListarInsumos(){
        $listaInsumos = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM insumos");
            $objRespuesta->execute();
            $listaInsumos = $objRespuesta->fetchAll();
            $objRespuesta= null;
        } catch (Exception $e) {
            $listaInsumos = $e->getMessage();
        }

        return $listaInsumos;
    }

    public static function mdlEditarInsumo($idInsumo,$nombreInsumo,$descripcionInsumo,$valorInsumo){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE insumos SET nombre_insumo = :nombre_insumo, descripcion_insumo = :descripcion_insumo,  valor_insumo = :valor_insumo  WHERE idinsumos=:idinsumos");
            $objRespuesta->bindParam(":nombre_insumo",$nombreInsumo);
            $objRespuesta->bindParam(":descripcion_insumo",$descripcionInsumo);
            $objRespuesta->bindParam(":valor_insumo",$valorInsumo);

            $objRespuesta->bindParam(":idinsumos",$idInsumo);

            

            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"200","mensaje"=>"Insumo actualizado correctamente");
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"Error en la actualizacion del insumo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }

    public static function mdlEliminarInsumo($idInsumo){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM insumos WHERE idinsumos=:idinsumos");
            $objRespuesta->bindParam(":idinsumos",$idInsumo);
            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"200","mensaje"=>"insumo eliminado correctamente");
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"Error al eliminar el insumo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }

    

}
include_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class archivoModelo
{
    public static function mdlSubirArchivo($nombreArchivo, $archivo)
    {
        $mensaje = array();
        $ruta = "../vista/excel/";
        $rutaPrincipal = "../vista/excel/" . $nombreArchivo;
        $extencion = strtoupper(substr($nombreArchivo, -4));

        if ($extencion == "XLSX" || $extencion == ".xls") {
            if (move_uploaded_file($archivo['tmp_name'], $ruta . $nombreArchivo)) {

                $documento = IOFactory::load($rutaPrincipal);
                $totalHojas = $documento->getSheetCount();

                for ($indicehoja = 0; $indicehoja < $totalHojas; $indicehoja++) {
                    $hojaActual = $documento->getSheet($indicehoja);
                    $numeroFilas = $hojaActual->getHighestDataRow();

                    for ($ndiceFila = 2; $ndiceFila <= $numeroFilas; $ndiceFila++) {

                        $nombreInsumo = $hojaActual->getCellByColumnAndRow(1, $ndiceFila);
                        $descripcionInsumo = $hojaActual->getCellByColumnAndRow(2, $ndiceFila);
                        $valorInsumo = $hojaActual->getCellByColumnAndRow(3, $ndiceFila);

                        // Verificar si el registro ya existe en la base de datos
                        try {
                            $objVerificar = Conexion::conectar()->prepare("SELECT * FROM insumos WHERE nombre_insumo=:nombre_insumo AND descripcion_insumo=:descripcion_insumo AND valor_insumo=:valor_insumo");
                            $objVerificar->bindParam(":nombre_insumo", $nombreInsumo);
                            $objVerificar->bindParam(":descripcion_insumo", $descripcionInsumo);
                            $objVerificar->bindParam(":valor_insumo", $valorInsumo);
                            if ($objVerificar->execute()) {
                                // Si el registro ya existe, no intentar insertarlo de nuevo
                                if ($objVerificar->rowCount() > 0) {
                                    continue;
                                }
                            }
                        } catch (Exception $e) {
                            $mensaje = array("codigo" => "425", "mensaje" => "Error al consular el insumo");
                        }

                        try {
                            // Intentar insertar el registro en la base de datos
                            // si no existe un registro duplicado
                            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO insumos(nombre_insumo,descripcion_insumo,valor_insumo)VALUES(:nombre_insumo, :descripcion_insumo, :valor_insumo)");
                            $objRespuesta->bindParam(":nombre_insumo", $nombreInsumo);
                            $objRespuesta->bindParam(":descripcion_insumo", $descripcionInsumo);
                            $objRespuesta->bindParam(":valor_insumo", $valorInsumo);

                            if ($objRespuesta->execute()) {
                                $mensaje = array("codigo" => "200", "mensaje" => "insumo registrado correctamente");

                            } else {
                                $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el insumo");
                            }
                        } catch (Exception$e) {
                            $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
                        }
                    }
                }

                $mensaje = array("codigo" => "202", "mensaje" => "Archivo subido correctamente");
            } else {
                $mensaje = array("codigo" => "404", "mensaje" => "error al subir el archivo");
            }
        } else {
            $mensaje = array("codigo" => "404", "mensaje" => "el tipo de archivo no es compatible las extenciones permitidas son xlsx, xls.");
        }

        return $mensaje;
    }
}

