<?php

namespace App\Service;

use App\Library\DbConnection;
use App\Library\MensajeFlash;
use App\Library\MostrarVista;
use App\Model\Categoria;
use App\Model\Publicacion;
use App\Model\Comentario;
use App\Model\Estado;
use App\Model\Imagen;
use App\Model\PalabraProhibida;
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
            $categorias=[];
            $sql = "SELECT * FROM categorias;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $dias = $this->getDiasPromedioResolucionIncidencias($resultado['id_categoria']);
                $categoria = new Categoria($resultado);
                $categoria->setDiasPromedioResolucion($dias);
                $categorias[] = $categoria;
            }
            return $categorias; //Devolvemos el array con todos los datos
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna categoría " . $e->getMessage());
        }
    }

    //tenemos un servicio que devuelve los estados
    public function getEstados(): array
    {
        try {
            $estados = [];
            $sql = "SELECT * FROM estados;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $estados[] = new Estado($resultado);
            }
            return $estados; //Devolvemos el array con todos los datos
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener los estados " . $e->getMessage());
        }
    }

    //tenemos un servicio que devuelve los estados
    public function getEstadosPublicacion($idPublicacion): array
    {
        try {
            $estadosPublicacion = [];
            $sql = "SELECT * FROM cambios_estado c, estados e WHERE c.id_publicacion = $idPublicacion AND c.estado_final = e.id_estado;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            if ($resultados) {
                foreach ($resultados as $resultado) {
                    $estadosPublicacion[] = $resultado;
                }
            } 
            return $estadosPublicacion; //Devolvemos el array con todos los datos
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener los estados " . $e->getMessage());
        }
    }

    //tenemos un servicio que devuelve las palabras prohibidas
    public function getPalabrasProhibidas(): array
    {
        try {
            $palabras_prohibidas = [];
            $sql = "SELECT * FROM palabras_prohibidas;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($resultados as $resultado) {
                $palabras_prohibidas[] = new PalabraProhibida($resultado);
            }
            return $palabras_prohibidas; //Devolvemos el array con todos los datos
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna palabra prohibida " . $e->getMessage());
        }
    }

    // servicio que devuelve el nombre de una categoría dado su identificador
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
            throw new Exception("ERROR - No se pudo obtener las categorías " . $e->getMessage());
        }
    }

    // servicio que devuelve el nombre de un estado dado su identificador
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
            throw new Exception("ERROR - No se pudo obtener los estados " . $e->getMessage());
        }
    }

    // servicio que devuelve el nombre de un autor dado su identificador
    public function getNombreAutor(int $id_autor): string
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE id_usuario = $id_autor;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado['nombre'] . " " . $resultado['apellidos'];
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener el nombre del autor " . $e->getMessage());
        }
    }

    // servicio que devuelve las 10 últimas publicaciones para mostrar en la portada
    public function getUltimasPublicaciones(): array
    {
        try {
            $publicaciones = [];
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

    // servicio que devuelve las publicaciones de una categoría
    public function getPublicacionesDeCategoria($id_categoria): array
    {
        try {
            $publicaciones =[];
            $sql = "SELECT id_publicacion FROM publicaciones WHERE esta_creada = 1 AND id_categoria = $id_categoria ORDER BY id_publicacion DESC;";
            $resultados = $this->dbConnection->ejecutarQueryConResultado($sql);
            if ($resultados) {
                foreach ($resultados as $resultado) {
                    $publicaciones[] = $this->getPublicacion($resultado['id_publicacion']);
                }
                return $publicaciones; //Devolvemos el array de objetos publicación
            } else {
                MensajeFlash::crearMensaje('Todavía no hay publicaciones de esta categoría.', 'info');
                $publicaciones = [];
                return $publicaciones;
            }
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    // servicio que devuelve una publicación
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

    // servicio que obtiene las imágenes de una publicación
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

    // devuelve el promedio de días de resolución por categorías cuando el estado es 4 (resuelto)
    public function getDiasPromedioResolucionIncidencias($id_categoria): ?int
    {
        try {
            $sql = "SELECT AVG(diasdesdepublicacion) as mediaDiasPublicacion FROM cambios_estado WHERE estado_final = 4 AND id_categoria = $id_categoria";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            if ($resultado) {
                return $resultado['mediaDiasPublicacion'];
            }
            return null;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún valor " . $e->getMessage());
        }
    }

    // comprueba si el correo ya existe en base de datos
    public function existeCorreoEnBD($mail)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = '$mail'";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            if ($resultado) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún valor " . $e->getMessage());
        }
    }
    // comprueba si la palabra prohibida ya existe en base de datos
    public function existePalabraEnBD($palabra)
    {
        try {
            $sql = "SELECT * FROM palabras_prohibidas WHERE nombre_palabra = '$palabra'";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            if ($resultado) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún valor " . $e->getMessage());
        }
    }
    // comprueba si el correo ya existe en base de datos
    public function existeCategoriaEnBD($categoria)
    {
        try {
            $sql = "SELECT * FROM categorias WHERE categoria = '$categoria'";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            if ($resultado) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún valor " . $e->getMessage());
        }
    }





    //
    //
    // Funciones no utilizadas
    
    // contamos los comentarios que hay en una publicación
    public function getContarComentariosDePublicacion($id_publicacion)
    {
        try {
            $sql = "SELECT count(comentario) FROM comentarios WHERE id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna publicación " . $e->getMessage());
        }
    }

    // obtenemos el nombre de una categoría 
    public function getNombreCategoriaEnPublicacion(int $id_publicacion)
    {
        try {
            $sql = "SELECT categoria FROM categorias C, publicaciones P WHERE P.id_categoria = C.id_categoria AND P.id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado['categoria'];
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna categoría " . $e->getMessage());
        }
    }

    // obtenemos el nombre de un estado 
    public function getNombreEstadoDePublicacion($id_publicacion)
    {
        try {
            $sql = "SELECT estado FROM estados E, publicaciones P WHERE P.id_estado = E.id_estado AND P.id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún estado " . $e->getMessage());
        }
    }

    // obtenemos el nombre de un autor
    public function getNombreAutorDePublicacion($id_publicacion)
    {
        try {
            $sql = "SELECT * FROM usuarios U, publicaciones P WHERE P.id_autor = U.id_usuario AND P.id_publicacion = $id_publicacion;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            return $resultado;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ningún nombre de autor " . $e->getMessage());
        }
    }

    public function getFechaResolucionIncidencia($id_publicacion): ?string
    {
        try {
            $sql = "SELECT fecha_cambio FROM cambios_estado WHERE id_publicacion = $id_publicacion AND estado_final = 4;";
            $resultado = $this->dbConnection->ejecutarQueryConUnResultado($sql);
            if ($resultado) {
                return $resultado['fecha_cambio'];
            }
            return null;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna fecha " . $e->getMessage());
        }
    }

    public function getDiasResolucionIncidencia($id_publicacion): ?int
    {
        try {
            $fechaInicio = $this->getPublicacion($id_publicacion)->getFecha_publicacion();
            $fechaFin = $this->getFechaResolucionIncidencia($id_publicacion);
            if ($fechaFin) {
                $fecha1 = new DateTime($fechaInicio);
                $fecha2 = new DateTime($fechaFin);
                $diff = $fecha1->diff($fecha2);
                return $diff->days;
            }
            return null;
        } catch (\Exception $e) {
            throw new Exception("ERROR - No se pudo obtener ninguna fecha " . $e->getMessage());
        }
    }
}
