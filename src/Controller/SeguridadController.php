<?php

namespace App\Controller;

use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Model\Usuario;

class SeguridadController
{
    private $dbConnection;

    public function __construct(DbConnection $dbC)
    {
        $this->dbConnection = $dbC;
    }

    public function loginUsuario(){

        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $sql= "SELECT * FROM usuarios WHERE email = '".$_POST['email']."' AND password = '".$_POST['password']."'";
            $usuario = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            $usuarioLogueado = new Usuario($usuario);
            if($usuarioLogueado->getId_usuario()){
                setcookie("emailCookie", $usuarioLogueado->getEmail(), time()+3600);
            }
            header("location:/");
        }
        return MostrarVista::mostrarVistaPublica('loginVista.php');
    }

    public function logoutUsuario(){
        if(isset($_COOKIE['emailCookie'])){
            setcookie("emailCookie", $_COOKIE['emailCookie'], time()-60);
            header("location:/");
        } 
    }

}