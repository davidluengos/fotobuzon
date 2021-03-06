<?php

namespace App\Controller;

use App\Model\Categoria;
use App\Library\DbConnection;
use App\Library\MensajeFlash;
use App\Library\MostrarVista;
use App\Service\QueriesService;
use App\Service\SeguridadService;
use Exception;

class CategoriaController
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

    //
    //
    // Funciones desarrolladas para las categorías: mostrar, crear y editar.
    //
    //

    // Ruta: /admin/categorias
    // función para mostrar las categorías en la vista de categorías del administrador
    public function mostrarCategorias(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        try {
            $sql = "SELECT * FROM categorias;";
            $categorias = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($categorias as $key => $categoria) {
                $categorias[$key] = new Categoria($categoria);
            }
        } catch (\PDOException $e) {
            throw new Exception("ERROR - Se produjo un error al mostrar las categorías " . $e->getMessage());
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo' => 'Administración de Categorías',
            'categorias' => $categorias,
        ];
        return MostrarVista::mostrarVista('adminCategoriasVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /admin/categoria/crear
    // función para crear una categoría en la vista de categorías del administrador
    public function crearCategoria(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        if (!empty($_POST['categoria'])) {
            $cat = $_POST['categoria'];
            $existeCatEnBD = $this->queryService->existeCategoriaEnBD($cat);
            if ($existeCatEnBD == true) {
                MensajeFlash::crearMensaje('La categoría ya está en el sistema.', 'danger');
                header("location:/admin/categorias");
                exit;
            } 
            try {
                $sql = "INSERT INTO categorias (categoria) VALUES ('" . $_POST['categoria'] . "')";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('La categoría se ha insertado.', 'success');
                header("location:/admin/categorias");
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al crear las categorías " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminCategoriaCrearVista.php');
    }

    // Ruta: /admin/categoria/editar?id=id_categoria
    // función para editar una categoría en la vista de categorías del administrador
    public function editarCategoria($idCategoria): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        $sql = "SELECT * FROM categorias WHERE id_categoria = $idCategoria";
        $publicacionArray = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $categoriaObjeto = new Categoria($publicacionArray);
        $variablesParaPasarAVista = [  //solamente hay una variable, que es la publicación
            'categoria' => $categoriaObjeto,
        ];

        if (!empty($_POST['categoriaEditada'])) {
            $cat = $_POST['categoriaEditada'];
            $existeCatEnBD = $this->queryService->existeCategoriaEnBD($cat);
            if ($existeCatEnBD == true) {
                MensajeFlash::crearMensaje('La categoría ya está en el sistema.', 'danger');
                header("location:/admin/categorias");
                exit;
            } 
            try {
                $sql = "UPDATE categorias SET 
                    categoria = '" . $_POST['categoriaEditada'] . "' 
                    WHERE id_categoria = " . $idCategoria . " ";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('La categoría se ha actualizado.', 'success');
                header("location:/admin/categorias"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al editar las categorías " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminCategoriaEditarVista.php', $variablesParaPasarAVista);
    }
}
