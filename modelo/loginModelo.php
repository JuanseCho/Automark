<?php

include_once("conexion.php");
class loginModelo{

    public static function mdIniciarSesion($email,$password){
    
        $mensaje = [];
        try {
            $sql = "SELECT * FROM usuario u INNER JOIN tipo_usuario Tu ON u.tipo_usuario_idtipo_usuario = Tu.idtipo_usuario WHERE u.email = :email AND u.password = :password ";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta ->bindParam("email",$email);  
            $objRespuesta ->bindParam("password",$password);
            $objRespuesta->execute();
            $datosUsuario = $objRespuesta->fetch();
            $objRespuesta = null;

            if ($datosUsuario != null ) {
                
                if ($datosUsuario["idtipo_usuario"] == 1) {
                    $_SESSION["ruta"] = "inicioAdmin";
                    
                }elseif($datosUsuario["idtipo_usuario"] == 2){
                    $_SESSION["ruta"] = "inicioEmpleado";
                }elseif($datosUsuario["idtipo_usuario"] == 3){
                    $_SESSION["ruta"] = "inicioCliente";
                }
                $mensaje = ["codigo"=>"200","mensaje"=> $_SESSION["ruta"]];
                
            }else{
                $mensaje = ["codigo"=>"425","mensaje"=>" error al iniciar sesion por favor ingrese nuevamente los datos"];
            }

        } catch (Exception $e) {
            $mensaje = ["codigo"=>"425","mensaje"=>$e->getMessage()];
        }
        return $mensaje;
    }
}
 