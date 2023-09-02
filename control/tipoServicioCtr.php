<?php

include_once "../modelo/TServiciomodelo.php";
class TipoServicio{
    public $idTiposervicio;
    public $tiposervicio;
    public function ctr_registrarTServicio(){
        $objRespuesta = Tserviciomodelo::md_RegistrarServicio($this->tiposervicio);
        echo json_encode($objRespuesta);
    }
    
    public function ctr_listarTServicios(){
        $objRespuesta = Tserviciomodelo::md_ListarServicios();
        echo json_encode($objRespuesta);
    }
    
    public function ctr_ActualizarTServicio(){
        $objRespuesta = Tserviciomodelo::md_EditarServicio($this->idTiposervicio,$this->tiposervicio);
        echo json_encode($objRespuesta);
    }
    
    public function ctr_EliminarTServicio(){
        $objRespuesta = Tserviciomodelo::md_EliminarServicio($this->idTiposervicio);
        echo json_encode($objRespuesta);
    }

}

if (isset($_POST["regTiposervicio"])) {
    $objTipoServicio= new TipoServicio();
    $objTipoServicio->tiposervicio=$_POST["regTiposervicio"];
    $objTipoServicio->ctr_registrarTServicio();
}

if (isset($_POST["listarTiposServicio"])== "ok") {
    $objTipoServicio = new TipoServicio();
    $objTipoServicio->ctr_listarTServicios();
    
}
if (isset($_POST["editId"],$_POST["editNombreTservicio"])) {
    $objTipoServicio = new TipoServicio();
    $objTipoServicio->tiposervicio = $_POST["editNombreTservicio"];
    $objTipoServicio->idTiposervicio = $_POST["editId"];
    $objTipoServicio->ctr_ActualizarTServicio();
}

if (isset($_POST["eliminarTipoServicio"])) {
    $objTipoServicio = new TipoServicio();
    $objTipoServicio->idTiposervicio = $_POST["eliminarTipoServicio"];
    $objTipoServicio->ctr_EliminarTServicio();
}