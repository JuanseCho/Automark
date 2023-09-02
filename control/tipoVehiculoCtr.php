<?php

include_once "../modelo/TVehiculomodelo.php";
class tipoVehiculo{
    public $idTipovehiculo;
    public $tipovehiculo;

    public function ctr_registrarTVehiculo() {
        $objRespuesta = Tvehiculomodelo::md_RegistrarVehiculo($this->tipovehiculo);
        echo json_encode($objRespuesta);
    }

    public function ctr_listarTVehiculos() {
        $objRespuesta = Tvehiculomodelo::md_ListarVehiculos();
        echo json_encode($objRespuesta);
    }

    public function ctr_editarTVehiculo() {
        $objRespuesta = Tvehiculomodelo::md_EditarVehiculo($this->idTipovehiculo, $this->tipovehiculo);
        echo json_encode($objRespuesta);
    }

    public function ctr_eliminarTVehiculo() {
        $objRespuesta = Tvehiculomodelo::md_EliminarVehiculo($this->idTipovehiculo);
        echo json_encode($objRespuesta);
    }
}

// Acciones según las peticiones POST

if (isset($_POST["regTipovehiculo"])) {
    $objTipoVehiculo = new TipoVehiculo();
    $objTipoVehiculo->tipovehiculo = $_POST["regTipovehiculo"];
    $objTipoVehiculo->ctr_registrarTVehiculo();
}

if (isset($_POST["listarTiposVehiculo"]) == "ok"){
    $objTipoVehiculo = new TipoVehiculo();
    $objTipoVehiculo->ctr_listarTVehiculos();
}

if (isset($_POST["editId"],$_POST["editNombreTvehiculo"])) {
    $objTipoVehiculo = new TipoVehiculo();
    $objTipoVehiculo->tipovehiculo = $_POST["editNombreTvehiculo"];
    $objTipoVehiculo->idTipovehiculo = $_POST["editId"];
    $objTipoVehiculo->ctr_editarTVehiculo();
}

if (isset($_POST["eliminarTipoVehiculo"])) {
    $objTipoVehiculo = new TipoVehiculo();
    $objTipoVehiculo->idTipovehiculo = $_POST["eliminarTipoVehiculo"];
    $objTipoVehiculo->ctr_eliminarTVehiculo();
}
?>
