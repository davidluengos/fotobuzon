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
    // función que muestra la página de login
    public function loginUsuario()
    {
        try {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $sql = "SELECT * FROM usuarios WHERE email = '" . $_POST['email'] . "' AND password = '" . md5($_POST['password']) . "'";
                $usuario = $this->dbConnection->ejecutarQueryConUnResultado($sql);
                if ($usuario) {
                    $usuarioLogueado = new Usuario($usuario);
                    if ($usuarioLogueado->getId_usuario()) {
                        setcookie("user", $usuarioLogueado->getEmail() . '|' . md5($_POST['password']), time() + 3600);
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
        } catch (\PDOException $e) {
            throw new Exception("ERROR - Se produjo un error al introducir las credenciales de acceso " . $e->getMessage());
        }
        $categorias = $this->queryService->getCategorias();
        $variablesParaPasarAVista = [
            'categorias' => $categorias
        ];
        return MostrarVista::mostrarVistaPublica('loginVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /logout
    // función que elimina la sesión
    public function logoutUsuario()
    {
        if (isset($_COOKIE['user'])) {
            setcookie("user", $_COOKIE['user'], time() - 60);
            header("location:/");
        }
    }
}
