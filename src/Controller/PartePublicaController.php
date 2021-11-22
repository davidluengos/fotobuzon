<?php

namespace App\Controller;

use App\Library\MostrarVista;
use App\Library\DbConnection;
Use App\Service\SeguridadService;
use App\Service\QueriesService;

class PartePublicaController
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
    
    // Ruta: /
    public function initIndex()
    {
        $publicaciones = $this->queryService->getUltimasPublicaciones();
        $categorias = $this->queryService->getCategorias();
        $variablesParaPasarAVista = [
            'publicaciones' => $publicaciones,
            'categorias' => $categorias
        ];
        return MostrarVista::mostrarVistaPublica('publicoIndexVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /publicacion/ver?id=$id_publicacion
    public function verPublicacion($id_publicacion)
    {
        $fechaComentario = date('Y-m-d H:i:s');
        if (!empty($_POST['textoComentario']) && isset($_POST['submit']) ) {
            $autor = $this->seguridadService->obtenerUsuarioLogueado()->getId_usuario();
            try {
                $sql = "INSERT INTO comentarios (id_publicacion, fecha_comentario, comentario, autor_comentario) VALUES ($id_publicacion, '$fechaComentario', '   " . $_POST['textoComentario']  . "    ', $autor)";
                $this->dbConnection->ejecutarQuery($sql);
                //aquí tengo que destruir el $_POST porque al recargar la página vuelve a crear el comentario 
                //(con unset no lo hace, porque sigue teniendo el valor de post)
                //así que redirijo a la misma publicación para vaciar POST
                header("location:/publicacion/ver?id=$id_publicacion");
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        }
            $publicacion = $this->queryService->getPublicacion($id_publicacion);
            //$comentarios = $this->queryService->getComentarios($id_publicacion);
            $imagenes = $this->queryService->getImagenes($id_publicacion);
            //$usuariosDeComentarios = $this->queryService->getUsuariosQueComentanPublicacion($id_publicacion);
            $nombreCategoria = $this->queryService->getNombreCategoriaEnPublicacion($id_publicacion);
            $numeroComentariosDePublicacion = $this->queryService->getContarComentariosDePublicacion($id_publicacion);
            $estadoDePublicacion = $this->queryService->getNombreEstadoDePublicacion($id_publicacion);
            $autorDePublicacion = $this->queryService->getNombreAutorDePublicacion($id_publicacion);
            $comentariosConNombre = $this->queryService->getComentariosConNombreAutor($id_publicacion);
            $variablesParaPasarAVista = [
                'publicacion' => $publicacion,
                //'comentarios' => $comentarios,
                'imagenes' => $imagenes,
                'categoria' => $nombreCategoria,
                //'usuariosDeComentarios' => $usuariosDeComentarios,
                'numeroComentarios'=>$numeroComentariosDePublicacion,
                'estadoDePublicacion'=>$estadoDePublicacion,
                'autor'=>$autorDePublicacion,
                'comentariosConNombre'=>$comentariosConNombre
            ];
            
            return MostrarVista::mostrarVistaPublica('publicoPublicacionVista.php', $variablesParaPasarAVista);
        
    }
}
