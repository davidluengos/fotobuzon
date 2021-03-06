<?php

namespace App\Controller;

use App\Model\Usuario;
use App\Library\DbConnection;
use App\Library\MensajeFlash;
use App\Library\MostrarVista;
use App\Service\QueriesService;
use App\Service\SeguridadService;
use Exception;

class UsuarioController
{
    private $dbConnection;
    private $queryService;
    private $seguridadService;

    public function __construct(DbConnection $dbC, QueriesService $queryService,SeguridadService $seguridadService)
    {
        $this->dbConnection = $dbC;
        $this->queryService = $queryService;
        $this->seguridadService = $seguridadService;
    }


    //
    //
    // Funciones desarrolladas para los usuarios: mostrar, crear y editar.
    //
    //

    // Ruta: /admin/usuarios
    // función que muestra los usuarios en la vista de usuarios del administrador
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
            throw new Exception("ERROR - Se produjo un error al mostrar los usuarios " . $e->getMessage());
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo' => 'Administración de Usuarios',
            'usuarios' => $usuarios,
        ];
        return MostrarVista::mostrarVista('adminUsuariosVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /admin/usuario/crear
    // función que crea los usuarios en la vista de usuarios del administrador
    public function crearUsuario(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        $rol = 'Usuario';
        if (!empty($_POST['nombre']) & !empty($_POST['apellidos'])) {
            $correo = $_POST['email'];
            $existeMailEnBD = $this->queryService->existeCorreoEnBD($correo);
            if ($existeMailEnBD == true) {
                MensajeFlash::crearMensaje('Email ya registrado en el sistema. No se ha registrado el usuario.', 'danger');
                header("location:/admin/usuarios");
                exit;
            } 
            try {
                $sql = "INSERT INTO usuarios (rol, nombre, apellidos, email, password,  telefono, direccion, codigo_postal, municipio, provincia)
                    VALUES ('$rol','" . $_POST['nombre'] . "','" . $_POST['apellidos'] . "','" . $_POST['email'] . "','" . md5($_POST['password']) . "',
                    '" . $_POST['telefono'] . "','" . $_POST['direccion'] . "','" . $_POST['cpostal'] . "','" . $_POST['municipio'] . "',
                    '" . $_POST['provincia'] . "');";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('Usuario registrado correctamente.', 'success');
                header("location:/admin/usuarios");
                exit;
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al insertar un usuario " . $e->getMessage());
            }
        } else {
            
            return MostrarVista::mostrarVista('adminUsuarioCrearVista.php');
        }
    }

    // Ruta: /admin/usuario/editar?id=$id_usuario
    // función que edita los usuarios en la vista de usuarios del administrador
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
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('Usuario editado correctamente.', 'success');
                header("location:/admin/usuarios"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un editar al mostrar los usuarios " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminUsuarioEditarVista.php', $variablesParaPasarAVista);
    }
}
