<?php

namespace App\Controller;

use App\Model\Publicacion;
use App\Library\DbConnection;
use App\Library\Database;
use App\Library\DbQueries;
use App\Library\MostrarVista;
use App\Library\UtilesFicheros;
use App\Service\QueriesService;
use App\Service\SeguridadService;
use Exception;

class PublicacionController
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

    public function crearPublicacion(): string
    {
        
        // Roles que pueden crear una publicación.
        $roles = ['Admin', 'Usuario'];

        $this->seguridadService->regirigeALoginSiNoEresRol($roles);
        // if ($this->seguridadService->obtenerUsuarioLogueado()) {
        $categorias = $this->queryService->getCategorias();
        $fecha_publicacion = date('Y-m-d H:i:s');
        $estado = 1; //Por defecto se establece el estado inicial
        $autor = $this->seguridadService->obtenerUsuarioLogueado()->getId_usuario();

        if (!empty($_POST['titulo']) & !empty($_POST['descripcion'])) {
            try {
                $sql = "UPDATE publicaciones SET fecha_publicacion = '$fecha_publicacion', titulo='" . $_POST['titulo'] . "', descripcion='" . $_POST['descripcion'] . "', id_categoria='" . $_POST['categoria'] . "', id_estado='$estado', id_autor='$autor', localizacion='" . $_POST['localizacion'] . "', esta_creada = '1' WHERE id_publicacion=" . $_POST['id_publicacion'] . "";
                $this->dbConnection->ejecutarQuery($sql);
                if ($this->seguridadService->obtenerUsuarioLogueado()->getRol() == 'Admin') {
                    header("location:/admin/publicaciones");
                } else {
                    header("location:/");
                }
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        } else {
            // Creamos una publicación vacía para poder tener un identificador al que asociar las imágenes
            $sql = "INSERT INTO publicaciones (id_autor) VALUES ($autor)";
            $id_publicacion = $this->dbConnection->ejecutarQuery($sql, true);

            $variablesParaPasarAVista = [ //llevamos el array de objetos 'categorías'
                'categorias' => $categorias,
                'id_publicacion' => $id_publicacion
            ];

            return MostrarVista::mostrarVistaPublica('publicoPublicacionCrearVista.php', $variablesParaPasarAVista);
        }
    }

    public function crearPublicacionImagen($id_publicacion): string
    {
        try {
            $roles = ['Admin', 'Usuario'];
            $this->seguridadService->regirigeALoginSiNoEresRol($roles);
            // Si no ha llegado imagen, tiramos excepción con código 999 para que en el index la vuelva a lanzar en vez de devolver un 200
            if (!$_FILES['file'] && !$_FILES['file']['name']) {
                throw new Exception('No ha subido ninguna imagen', 999);
            }

            // Copiamos imagen física a la carpeta /uploads
            $extension = UtilesFicheros::obtenerExtension($_FILES['file']['name']);
            $nombre_random = substr(md5(mt_rand()), 0, 10);
            $ruta_imagen_navegador = '/uploads/' . $id_publicacion . '/' . $nombre_random . '.' . $extension;
            $ruta_imagen_fisica = '../web/uploads/' . $id_publicacion . '/' . $nombre_random . '.' . $extension;
            if (!is_dir('../web/uploads/' . $id_publicacion . '/')) {
                mkdir('../web/uploads/' . $id_publicacion . '/', 0777, true);
            }
            move_uploaded_file($_FILES['file']['tmp_name'], $ruta_imagen_fisica);

            // Insertar imagen en la base de datos
            $sql = "INSERT INTO imagenes (tipo_imagen, id_objeto, size, mimetype, path_imagen, nombre_imagen)
        VALUES ('publicacion', $id_publicacion, '" . $_FILES['file']['size'] . "', '" . $_FILES['file']['type'] . "', '$ruta_imagen_navegador',  '" . $_FILES['file']['name'] . "')";
            $this->dbConnection->ejecutarQuery($sql);

            return $_FILES['file']['name'];
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 999);
        }
    }


    public function eliminarPublicacion($idPublicacion)
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        $idPublicacion = $_POST['eliminarporpost'];
        echo "vamos a eliminar la publicación número " . $idPublicacion;
        if ($idPublicacion) {
            try {
                $sql = "DELETE FROM publicaciones WHERE id_publicacion = $idPublicacion";
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/publicaciones"); //redirijo a la página de publicaciones después de editar
            } catch (\Exception $e) {
                echo "ERROR - No se pudieron obtener los datos para eliminar: " . $e->getMessage();
            }
        }
        $variablesParaPasarAVista = [];
        return MostrarVista::mostrarVista('adminPublicacionesVista.php', $variablesParaPasarAVista);
    }

    public function editarPublicacion($idPublicacion): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        $categorias = $this->queryService->getCategorias();
        $estados = $this->queryService->getEstados();

        $sql = "SELECT * FROM publicaciones WHERE id_publicacion = $idPublicacion";
        $publicacionArray = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $publicacionObjeto = new Publicacion($publicacionArray);
        $idAutor = $publicacionObjeto->getAutor_publicacion(); 
        $nombreAutor = $this->queryService->getNombreAutor($idAutor);
        $variablesParaPasarAVista = [  //solamente hay una variable, que es la publicación
            'publicacion' => $publicacionObjeto,
            'categorias' => $categorias,
            'estados' => $estados,
            'autor' => $nombreAutor
        ];

        if (!empty($_POST['tituloEditado']) & !empty($_POST['descripcionEditada'])) {
            try {
                $sql = "UPDATE publicaciones SET 
                titulo = '" . $_POST['tituloEditado'] . "', 
                descripcion = '" . $_POST['descripcionEditada'] . "', 
                id_categoria ='" . $_POST['categoriaEditada'] . "' , 
                id_estado ='" . $_POST['estadoEditado'] ."', 
                localizacion = '" . $_POST['localizacionEditada'] . "' 
                WHERE  id_publicacion = " . $idPublicacion . " ";
                $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/publicaciones"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        }
        return MostrarVista::mostrarVista('adminPublicacionEditarVista.php', $variablesParaPasarAVista);
    }

    public function mostrarPublicaciones(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);

        try {
            $sql = "SELECT * FROM publicaciones WHERE esta_creada = 1 ORDER BY id_publicacion DESC;";
            $publicaciones = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($publicaciones as $key => $publicacion) {
                $id_estado = $publicacion['id_estado'];
                $id_autor = $publicacion['id_autor'];
                $id_categoria = $publicacion['id_categoria'];
                $nombreCategoria = $this->queryService->getNombreCategoria($id_categoria);
                $nombreEstado = $this->queryService->getNombreEstado($id_estado);
                $nombreAutor = $this->queryService->getNombreAutor($id_autor);
                $publicaciones[$key] = new Publicacion($publicacion);
                $publicaciones[$key]->setNombreCategoria($nombreCategoria);
                $publicaciones[$key]->setNombreEstado($nombreEstado);
                $publicaciones[$key]->setNombreAutor($nombreAutor);
            }
        } catch (\PDOException $e) {
            echo "ERROR - No se pudieron obtener las publicaciones: " . $e->getMessage();
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo' => 'Administración de Publicaciones',
            'publicaciones' => $publicaciones,
        ];
        return MostrarVista::mostrarVista('adminPublicacionesVista.php', $variablesParaPasarAVista);
    }
}
