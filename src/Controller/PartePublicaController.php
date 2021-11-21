<?php

namespace App\Controller;

use App\Library\MostrarVista;
use App\Service\QueriesService;

class PartePublicaController
{

    private $queryService;

    public function __construct(QueriesService $queryService)
    {
        $this->queryService = $queryService;
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
        $publicacion = $this->queryService->getPublicacion($id_publicacion);
        $comentarios = $this->queryService->getComentarios($id_publicacion);
        $imagenes = $this->queryService->getImagenes($id_publicacion);
        $nombreCategoria = $this->queryService->getNombreCategoriaEnPublicacion($id_publicacion);
        $variablesParaPasarAVista = [
            'publicacion' => $publicacion,
            'comentarios' => $comentarios,
            'imagenes' => $imagenes,
            'categoria' => $nombreCategoria
        ];
        return MostrarVista::mostrarVistaPublica('publicoPublicacionVista.php', $variablesParaPasarAVista);
    }
}
