<?php

namespace App\Service;

use App\Library\DbConnection;
use App\Model\Categoria;
use App\Model\Publicacion;
use App\Model\Comentario;
use App\Model\Estado;
use App\Model\Imagen;
use App\Model\Usuario;
use DateTime;
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
                $categorias[] = new Categoria($resultado);
            }
            return $categorias; //Devolvemos el array con todos los datos
        } catch (\Exception $e) {
            echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
        }
    }

    //tenemos un servicio que devuelve los estados
    public function getEstados(): array
    {
        try {
            $sql = "SELECT * FROM estados;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $estados[] = new Estado($resultado);
            }
            return $estados; //Devolvemos el array con todos los datos
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
            $sql = "SELECT id_publicacion FROM publicaciones WHERE esta_creada = 1 ORDER BY id_publicacion DESC LIMIT 10;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $publicaciones[] = $this->getPublicacion($resultado['id_publicacion']);
            }
            return $publicaciones; //Devolvemos el array de objetos publicación
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    public function getPublicacion($id_publicacion): Publicacion
    {
        try {
            $sql = "SELECT * FROM publicaciones WHERE id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            $publicacion = new Publicacion($resultado);
            $imagenes = $this->getImagenes($id_publicacion);
            $publicacion->setImagenes($imagenes);
            $nombreCategoria = $this->getNombreCategoria($publicacion->getCategoria());
            $publicacion->setNombreCategoria($nombreCategoria);
            $estadoDePublicacion = $this->getNombreEstado($publicacion->getEstado());
            $publicacion->setNombreEstado($estadoDePublicacion);
            $autorDePublicacion = $this->getNombreAutor($publicacion->getAutor_publicacion());
            $publicacion->setNombreAutor($autorDePublicacion);
            $comentariosConNombre = $this->getComentariosConNombreAutor($id_publicacion);
            $publicacion->setComentarios($comentariosConNombre);

            return $publicacion; //Devolvemos el array de objetos con una publicación
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }
/*
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
    }*/

    // Construyo un array con los datos que necesito para mostrar los comentarios en una publicación
    public function getComentariosConNombreAutor($id_publicacion)
    {

        try {
            $sql = "SELECT C.fecha_comentario, U.nombre, U.apellidos, C.comentario FROM comentarios C, usuarios U WHERE C.id_publicacion = $id_publicacion AND C.autor_comentario=U.id_usuario ORDER BY id_comentario DESC;";
            $comentarios = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($comentarios as $key => $comentario) {
                $comentarios[$key] = $comentario;
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
/*
    public function getUsuariosQueComentanPublicacion($id_publicacion){
        try {
            $sql = "SELECT * FROM usuarios U, comentarios C WHERE C.id_publicacion = $id_publicacion AND U.id_usuario = C.autor_comentario ORDER BY C.id_comentario DESC;";
            $usuarios = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($usuarios as $key => $usuario) {
                $usuarios[$key] = new Usuario($usuario);
            }
            return $usuarios;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún usuario " . $e->getMessage());
        }
    }*/

    public function getContarComentariosDePublicacion($id_publicacion){
        try {
            $sql = "SELECT count(comentario) FROM comentarios WHERE id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado; 
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    public function getNombreCategoriaEnPublicacion (int $id_publicacion){
        try {
        $sql = "SELECT categoria FROM categorias C, publicaciones P WHERE P.id_categoria = C.id_categoria AND P.id_publicacion = $id_publicacion;";
        $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado['categoria'];
        } catch (\Exception $e) {
            echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
        }
    }

    public function getNombreEstadoDePublicacion ($id_publicacion){
        try {
            $sql = "SELECT estado FROM estados E, publicaciones P WHERE P.id_estado = E.id_estado AND P.id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
                return $resultado;
            } catch (\Exception $e) {
                echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
            }
    }

    public function getNombreAutorDePublicacion ($id_publicacion){
        try {
            $sql = "SELECT * FROM usuarios U, publicaciones P WHERE P.id_autor = U.id_usuario AND P.id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
                return $resultado;
            } catch (\Exception $e) {
                echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
            }
    }

    public function getFechaResolucionIncidencia ($id_publicacion){
        try {
            $sql = "SELECT fecha_cambio FROM cambios_estado WHERE id_publicacion = $id_publicacion AND estado_final = 4;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
                return $resultado;
            } catch (\Exception $e) {
                echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
            }
    }

    public function getDiasResolucionIncidencia ($id_publicacion){
        try {
            $fechaInicio = $this->getPublicacion($id_publicacion)->getFecha_publicacion();
            $fechaFin = $this->getFechaResolucionIncidencia($id_publicacion);
            $fecha1= new DateTime($fechaInicio);
            $fecha2= new DateTime($fechaFin);
            $diff = $fecha1->diff($fecha2);
            return $diff->days;
            } catch (\Exception $e) {
                echo "ERROR - No se pudo obtener ninguna familia " . $e->getMessage();
            }

    }


}
