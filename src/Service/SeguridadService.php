<?php

namespace App\Service;

use App\Library\DbConnection;
use App\Model\Usuario;

class SeguridadService
{
    private $dbConnection;

    public function __construct(DbConnection $dbC)
    {
        $this->dbConnection = $dbC;
    }

    // devuelve el usuario conectado
    public function obtenerUsuarioLogueado() :?Usuario
    {
        if (!isset($_COOKIE['user'])) {
            return null;
        }
        list($user, $password) = explode('|', $_COOKIE['user']);
        $sql= "SELECT * FROM usuarios WHERE email = '".$user."' AND password='".$password."'";
        $usuario = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        if ($usuario) {
            $usuarioLogueado = new Usuario($usuario);
            return $usuarioLogueado;
        }

        return null;
    }

    // redirige al login si no existe un rol
    public function regirigeALoginSiNoEresRol(array $roles) :void
    {
        $rolUsuarioConectado = $this->obtenerUsuarioLogueado() ? $this->obtenerUsuarioLogueado()->getRol() : null;
        if (!in_array($rolUsuarioConectado, $roles)) {
            header("location:/login");
        }
    }
}
