<?php

namespace App\Service;

use App\Library\DbConnection;
use App\Model\Publicacion;
use App\Model\Comentario;
use App\Model\Imagen;
use Exception;

class QueriesService
{

    private $dbConnection;

    public function __construct(DbConnection $dbC)
    {
        $this->dbConnection = $dbC;
    }


    //tenemos un servicio que devuelve las categorías
    public function getCategorias(): array
    {
        try {
            $sql = "SELECT * FROM categorias;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $categorias[] = $resultado;
            }
            return $categorias; //Devolvemos el array con todos los datos
        } catch (\Exception $e) {
            echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
        }
    }

    public function getNombreCategoria(int $id_categoria = null): string
    {
        if ($id_categoria == null) {
            return '';
        }

        try {
            $sql = "SELECT * FROM categorias WHERE id_categoria = $id_categoria;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado['categoria'];
        } catch (\Exception $e) {
            echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
        }
    }
    public function getNombreEstado(int $id_estado = null): string
    {
        if ($id_estado == null) {
            return '';
        }

        try {
            $sql = "SELECT * FROM estados WHERE id_estado = $id_estado;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado['estado'];
        } catch (\Exception $e) {
            echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
        }
    }
    public function getNombreAutor(int $id_autor): string
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_autor;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado['nombre'] . " " . $resultado['apellidos'];
        } catch (\Exception $e) {
            echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
        }
    }

    public function getUltimasPublicaciones(): array
    {
        try {
            $sql = "SELECT * FROM publicaciones WHERE esta_creada = 1 ORDER BY id_publicacion DESC LIMIT 10;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $publicaciones[] = new Publicacion($resultado);
            }
            return $publicaciones; //Devolvemos el array de objetos publicación
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    public function getPublicacion($id_Publicacion): array
    {
        try {
            $sql = "SELECT * FROM publicaciones WHERE id_publicacion = $id_Publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            $publicacion[] = new Publicacion($resultado);
            return $publicacion; //Devolvemos el array de objetos con una publicación
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    public function getComentarios($id_publicacion)
    {

        try {
            $sql = "SELECT * FROM comentarios WHERE id_publicacion = $id_publicacion ORDER BY id_comentario DESC;";
            $comentarios = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($comentarios as $key => $comentario) {
                $comentarios[$key] = new Comentario($comentario);
            }
            return $comentarios;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    public function getImagenes($id_publicacion)
    {

        try {
            $sql = "SELECT * FROM imagenes WHERE id_objeto = $id_publicacion AND tipo_imagen = 'publicacion' ORDER BY id_imagen DESC;";
            $imagenes = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($imagenes as $key => $imagen) {
                $imagenes[$key] = new Imagen($imagen);
            }
            return $imagenes;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }
}
