<?php

include_once "conexion.php";
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

                    $letra = $hojaActual->getHighestColumn();
                    $numeroLetras = Coordinate::columnIndexFromString($letra);

                    for ($ndiceFila = 2; $ndiceFila <= $numeroFilas; $ndiceFila++) {

                       // for ($ndiceColumna = 0; $ndiceColumna <= $numeroLetras; $ndiceColumna++) {

                            $nombreInsumo = $hojaActual->getCellByColumnAndRow(1, $ndiceFila);
                            $descripcionInsumo = $hojaActual->getCellByColumnAndRow(2, $ndiceFila);
                            $valorInsumo = $hojaActual->getCellByColumnAndRow(3, $ndiceFila);

                            $mensaje = [];
                            try {
                                $objRespuesta = Conexion::conectar()->prepare("INSERT INTO insumos(nombre_insumo,descripcion_insumo,valor_insumo)VALUES(:nombre_insumo, :descripcion_insumo, :valor_insumo)");
                                $objRespuesta->bindParam(":nombre_insumo", $nombreInsumo);
                                $objRespuesta->bindParam(":descripcion_insumo", $descripcionInsumo);
                                $objRespuesta->bindParam(":valor_insumo", $valorInsumo);


                                // si todo esta bien lo ejecuta 
                                if ($objRespuesta->execute()) {
                                    $mensaje = array("codigo" => "200", "mensaje" => "insumo registrado correctamente");
                                } else {
                                    $mensaje = array("codigo" => "425", "mensaje" => "Error al registrar el insumo");
                                }
                            } catch (Exception $e) {
                                $mensaje = array("codigo" => "425", "mensaje" => $e->getMessage());
                            }



                            $mensaje = array("codigo" => "202", "mensaje" => "Archivo subido correctamente");
                       // }
                    }
                }
            } else {
                $mensaje = array("codigo" => "404", "mensaje" => "error al subir el archivo");
            }
        } else {
            $mensaje = array("codigo" => "404", "mensaje" => "el tipo de archivo no es compatible las extenciones permitidas son jpg,png y jpeg.");
        }

        return $mensaje;
    }
}
