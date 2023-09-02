<?php

include_once "../modelo/insumosmodelo.php";

class insumoControl
{
    public $id;
    public $nombreInsumo;
    public $descripcionInsumo;
    public $valorInsumo;
    public $nombreArchivo;
    public $archivo;


    public function ctrRegistrarInsumo()
    {
        $objRespuesta = insumosmodelo::md_RegistrarInsumo($this->nombreInsumo, $this->descripcionInsumo, $this->valorInsumo);
        echo json_encode($objRespuesta);
    }

    public function ctrListarInsumo()
    {
        $objRespuesta = insumosmodelo::mdl_ListarInsumos();
        echo json_encode($objRespuesta);
    }

    public function ctrEditarInsumo()
    {
        $objRespuesta = insumosmodelo::mdlEditarInsumo($this->id, $this->nombreInsumo, $this->descripcionInsumo, $this->valorInsumo);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarInsumo()
    {
        $objRespuesta = insumosmodelo::mdlEliminarInsumo($this->id);
        echo json_encode($objRespuesta);
    }
    

        public function ctrSubirArchivos(){
            $objRespuesta = archivoModelo::mdlSubirArchivo($this->nombreArchivo,$this->archivo);
            echo json_encode($objRespuesta);
        }
    
    
    

}



// verificar si llego por post los datos de la categoria para crear el registro
if (isset($_POST["regNombreInsummo"], $_POST["regDescripcionInsumo"], $_POST["regValorInsumo"])) {
    $objInsumo = new insumoControl();
    $objInsumo->nombreInsumo = $_POST["regNombreInsummo"];
    $objInsumo->descripcionInsumo = $_POST["regDescripcionInsumo"];
    $objInsumo->valorInsumo = $_POST["regValorInsumo"];


    $objInsumo->ctrRegistrarInsumo();
}


// verificar si se realizo peticion para listar las insumoses  
if (isset($_POST["listarInsumos"]) == "ok") {
    $objInsumo = new insumoControl();
    $objInsumo->ctrListarInsumo();
}



if (isset($_POST["editnobre_insumos"], $_POST["editDescripcion_insumos"], $_POST["editValor_insumos"], $_POST["editId"])) {
    $objInsumo = new insumoControl();
    $objInsumo->nombreInsumo = $_POST["editnobre_insumos"];
    $objInsumo->descripcionInsumo = $_POST["editDescripcion_insumos"];
    $objInsumo->valorInsumo = $_POST["editValor_insumos"];

    $objInsumo->id = $_POST["editId"];
    $objInsumo->ctrEditarInsumo();
}


// validar si hay peticion para eliminar
if (isset($_POST["idEliminar_insumo"])) {
    $objInsumo = new insumoControl();
    $objInsumo->id = $_POST["idEliminar_insumo"];
    $objInsumo->ctrEliminarInsumo();
}

// subir archivos
if (isset($_FILES["file"])){
    $objArchivo = new insumoControl();
    $objArchivo->nombreArchivo = $_FILES["file"]["name"];
    $objArchivo->archivo = $_FILES["file"];
    $objArchivo->ctrSubirArchivos();
}
