<?php
session_start();
 include_once("../modelo/loginModelo.php");
class login_Ctr{
    public $email;
    public $password;

    public function ctrIniciarSesion(){
        $objRespuesta = loginModelo::mdIniciarSesion($this->email,$this->password);
        echo json_encode($objRespuesta);
    }
}

if (isset($_POST["email_login"], $_POST["password_login"])) {
    // creamos un objeto "login" con permimso a la clase login_Ctr
    $login = new login_Ctr();
    $login->email = $_POST["email_login"];
    $login->password = $_POST["password_login"];
    $login->ctrIniciarSesion();
}
