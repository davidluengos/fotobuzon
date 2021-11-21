<?php

namespace App\Service;

use App\Library\DbConnection;
use App\Model\Usuario;

class SeguridadService {
    
    private $dbConnection;

    public function __construct(DbConnection $dbC){
        $this->dbConnection = $dbC;
    }

    public function obtenerUsuarioLogueado() :?Usuario{
        if (!isset($_COOKIE['emailCookie'])){
            return null;
        }
        $sql= "SELECT * FROM usuarios WHERE email = '".$_COOKIE['emailCookie']."'";
        $usuario = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $usuarioLogueado = new Usuario($usuario);
        return $usuarioLogueado;
    }


    public function regirigeALoginSiNoEresRol(array $roles) :void{
        $rolUsuarioConectado = $this->obtenerUsuarioLogueado() ? $this->obtenerUsuarioLogueado()->getRol() : null;
        if (!in_array($rolUsuarioConectado, $roles)) {
            header("location:/login");
        }
    }    
}