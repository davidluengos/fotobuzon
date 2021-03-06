<?php

use App\Controller\PublicacionController;
use App\Controller\UsuarioController;
use App\Controller\CategoriaController;
use App\Controller\PalabraProhibidaController;
use App\Controller\SeguridadController;
use App\Controller\PartePublicaController;
use App\Controller\EstadoController;
use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Service\QueriesService;
use App\Service\SeguridadService;

require_once "../vendor/autoload.php";
require_once "../dbConfig.php";

//Configuración inicial de los controladores (inyección de dependencias)

//Crear una conexión a la base de datos
$dbConnection = new DbConnection(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Cargar los servicios
$queriesService = new QueriesService($dbConnection);
$seguridadService = new SeguridadService($dbConnection);

// Cargar los controladores con los servicios inyectados
$partePublicaController = new PartePublicaController($dbConnection, $queriesService, $seguridadService);
$publicacionController = new PublicacionController($dbConnection, $queriesService, $seguridadService);
$usuarioController = new UsuarioController($dbConnection, $queriesService,$seguridadService);
$categoriaController = new CategoriaController($dbConnection, $queriesService, $seguridadService);
$palabraProhibidaController = new PalabraProhibidaController($dbConnection, $queriesService,$seguridadService);
$seguridadController = new SeguridadController($dbConnection, $queriesService);
$estadoController = new EstadoController($dbConnection, $seguridadService);


// Enrutamiento. Cada url apunta a un método del controlador correspondiente
try{
    switch (@$_GET['path']) {
        case "":
            echo $partePublicaController->initIndex();
            break;
        case "publicacion/crear":
            echo $partePublicaController->crearPublicacion();
            break;    
        case "publicacion/ver":
            echo $partePublicaController->verPublicacion($_GET['id']);
            break;
        case "publicaciones/categoria":
            echo $partePublicaController->verPublicacionesDeCategoria();
            break;    
        case "usuario/crear":
            echo $partePublicaController->crearUsuario();
            break;    
        case "publicacion/crear-imagen":
            echo $publicacionController->crearPublicacionImagen($_GET['id_publicacion']);
            break;    
        case "admin/publicacion/crear":
            echo $publicacionController->crearPublicacion();
            break;
        case "admin/publicacion/ver":
            echo $publicacionController->verPublicacion($_GET['id']);
            break;
        case "admin/publicacion/editar":
            echo $publicacionController->editarPublicacion($_GET['id']);
            break;
        case "admin/publicacion/eliminar":
            echo $publicacionController->eliminarPublicacion($id);
            break;
        case "admin/publicaciones":
            echo $publicacionController->mostrarPublicaciones();
            break;
        case "admin/usuarios":
            echo $usuarioController->mostrarUsuarios();
            break;
        case "admin/usuario/crear":
            echo $usuarioController->crearUsuario();
            break;
        case "admin/usuario/editar":
            echo $usuarioController->editarUsuario($_GET['id']);
            break;
        case "admin/categorias":
            echo $categoriaController->mostrarCategorias();
            break;
        case "admin/categoria/crear":
            echo $categoriaController->crearCategoria();
            break;
        case "admin/categoria/editar":
            echo $categoriaController->editarCategoria($_GET['id']);
            break;
        case "admin/palabrasprohibidas":
            echo $palabraProhibidaController->mostrarPalabrasProhibidas();
            break;
        case "admin/palabraprohibida/crear":
            echo $palabraProhibidaController->crearPalabraProhibida();
            break;
        case "admin/palabraprohibida/editar":
            echo $palabraProhibidaController->editarPalabraProhibida($_GET['id']);
            break;
        case "admin/palabraprohibida/eliminar":
            echo $palabraProhibidaController->eliminarPalabraProhibida($id);
            break;    
        case "admin/estados":
            echo $estadoController->mostrarEstados();
            break;
        case "admin/estado/editar":
            echo $estadoController->editarEstado($_GET['id']);
            break;    
        case "login":
            echo $seguridadController->loginUsuario();
            break;
        case "logout":
            echo $seguridadController->logoutUsuario();
            break;
        case "terminos";
            echo $partePublicaController->paginaTerminos();
            break;    
        default:
            echo $partePublicaController->paginaNoEncontrada();
        }
}catch(\Exception $e){
    if ($e->getCode() == 999) {
        throw $e;
    }
    $errores=['error'=>$e];
    echo MostrarVista::mostrarVistaPublica('excepcionVista.php',$errores);
}