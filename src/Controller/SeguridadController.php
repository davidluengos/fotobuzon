<?php

namespace App\Controller;

use App\Library\DbConnection;
use App\Library\MensajeFlash;
use App\Library\MostrarVista;
use App\Model\Usuario;
use App\Service\QueriesService;
use Exception;

class SeguridadController
{
    private $dbConnection;
    private $queryService;

    public function __construct(DbConnection $dbC, QueriesService $queryService)
    {
        $this->dbConnection = $dbC;
        $this->queryService = $queryService;
    }

    // Ruta: /login
    public function loginUsuario(){
        try {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $sql= "SELECT * FROM usuarios WHERE email = '".$_POST['email']."' AND password = '".$_POST['password']."'";
                $usuario = $this->dbConnection->ejecutarQueryConUnResultado($sql);
                if ($usuario) {
                    $usuarioLogueado = new Usuario($usuario);
                    if ($usuarioLogueado->getId_usuario()) {
                        setcookie("emailCookie", $usuarioLogueado->getEmail(), time()+3600);
                    }
                    if ($usuarioLogueado->getRol() == "Admin") {
                        header("location:/admin/publicaciones");
                    }
                    if ($usuarioLogueado->getRol() == "Usuario") {
                        header("location:/");
                    }
                }
                MensajeFlash::crearMensaje('Usuario o contraseña incorrectas. Inténtelo de nuevo.', 'danger');
              //  header("location:/login");
            }
        }catch(\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al introducir las credenciales de acceso " . $e->getMessage());
        }
        $categorias = $this->queryService->getCategorias();
        $variablesParaPasarAVista = [
            'categorias' => $categorias
        ];
        return MostrarVista::mostrarVistaPublica('loginVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /logout
    public function logoutUsuario(){
        if(isset($_COOKIE['emailCookie'])){
            setcookie("emailCookie", $_COOKIE['emailCookie'], time()-60);
            header("location:/");
        } 
    }

}