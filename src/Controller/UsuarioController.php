<?php

namespace App\Controller;

use App\Model\Usuario;
use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Service\SeguridadService;
use App\Service\QueriesService;


class UsuarioController
{

    private $dbConnection;
    private $queryService;
    private $seguridadService;

    public function __construct(DbConnection $dbC, QueriesService $queryService, SeguridadService $seguridadService)
    {
        $this->dbConnection = $dbC;
        $this->queryService = $queryService;
        $this->seguridadService = $seguridadService;
    }

    public function mostrarUsuarios(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        try {
            $sql = "SELECT * FROM usuarios ORDER BY id_usuario DESC;";
            $usuarios = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($usuarios as $key => $usuario) {
                $usuarios[$key] = new Usuario($usuario);
            }
        } catch (\PDOException $e) {
            echo "ERROR - No se pudieron obtener los usuarios: " . $e->getMessage();
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo' => 'Administración de Usuarios',
            'usuarios' => $usuarios,
        ];
        return MostrarVista::mostrarVista('adminUsuariosVista.php', $variablesParaPasarAVista);
    }

    public function crearUsuario(): string
    {   
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        $rol = 'Usuario';
        if (!empty($_POST['nombre']) & !empty($_POST['apellidos'])) {
            try {
                $sql = "INSERT INTO usuarios (rol, nombre, apellidos, email, telefono, direccion, codigo_postal, municipio, provincia)
                    VALUES ('$rol','" . $_POST['nombre'] . "','" . $_POST['apellidos'] . "','" . $_POST['email'] . "','" . $_POST['telefono'] . "','" . $_POST['direccion'] . "','" . $_POST['cp'] . "','" . $_POST['municipio'] . "','" . $_POST['provincia'] . "');";
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/usuarios");
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los usuarios: " . $e->getMessage();
            }
        } else {
            return MostrarVista::mostrarVista('adminUsuarioCrearVista.php');
        }
    }

    public function editarUsuario($idUsuario): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);

        $sql = "SELECT * FROM usuarios WHERE id_usuario = $idUsuario";
        $publicacionArray = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $usuarioObjeto = new Usuario($publicacionArray);
        $variablesParaPasarAVista = [  //solamente hay una variable, que es la publicación
            'usuario' => $usuarioObjeto,
        ];

        if (!empty($_POST['nombreEditado']) & !empty($_POST['apellidosEditados']) & !empty($_POST['emailEditado'])) {
            try {
                $sql = "UPDATE usuarios SET 
                    nombre = '" . $_POST['nombreEditado'] . "', 
                    apellidos = '" . $_POST['apellidosEditados'] . "', 
                    email ='" . $_POST['emailEditado'] . "' , 
                    telefono = '" . $_POST['telefonoEditado'] . "',
                    direccion = '" . $_POST['direccionEditada'] . "',
                    codigo_postal = '" . $_POST['codigo_postalEditado'] . "',
                    municipio = '" . $_POST['municipioEditado'] . "',
                    provincia = '" . $_POST['provinciaEditada'] . "' 
                    WHERE id_usuario = " . $idUsuario . " ";
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/usuarios"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        }
        return MostrarVista::mostrarVista('adminUsuarioEditarVista.php', $variablesParaPasarAVista);
    }
}
