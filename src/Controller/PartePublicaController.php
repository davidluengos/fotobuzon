<?php

namespace App\Controller;

use App\Library\MostrarVista;
use App\Library\DbConnection;
use App\Library\MensajeFlash;
use App\Service\SeguridadService;
use App\Service\QueriesService;
use Exception;

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

    //
    //
    // Funciones correspondientes a la parte pública (las que van a realizar los usuarios)
    //
    //

    // Ruta: /
    // Muestra la página de inicio
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


    // Ruta: /publicación/crear
    // función para crear una publicación
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

        if (!empty($_POST['titulo']) && !empty($_POST['descripcion'])) {
            $id_publicacion = $_POST['id_publicacion'];
            $esCorrecto = true;

            $imagenes = $this->queryService->getImagenes($id_publicacion);
            if (count($imagenes) == 0) {
                $esCorrecto = false;
                MensajeFlash::crearMensaje('Por favor, incluya imágenes en la nueva publicación.', 'danger');
            }
            $textoDescripcion = $_POST['descripcion'];
            $textoTitulo = $_POST['titulo'];
            $textoLocalizacion = $_POST['localizacion'];
            $palabras = $this->queryService->getPalabrasProhibidas();

            foreach ($palabras as $palabra) {
                $posTitulo = strpos($textoTitulo, $palabra->getPalabra());
                $posDescripcion = strpos($textoDescripcion, $palabra->getPalabra());
                $posLocalizacion = strpos($textoLocalizacion, $palabra->getPalabra());

                if ($posTitulo !== false || $posDescripcion !== false || $posLocalizacion !== false) {
                    $esCorrecto = false;
                    MensajeFlash::crearMensaje('Por favor, vuelva a escribir su mensaje sin utilizar alguna de las palabras prohibidas.', 'danger');
                    break;
                }
            }
            if ($esCorrecto) {
                try {
                    $sql = "UPDATE publicaciones SET fecha_publicacion = '$fecha_publicacion', titulo='" . $textoTitulo . "', descripcion='" . $textoDescripcion . "', id_categoria='" . $_POST['categoria'] . "', id_estado='$estado', id_autor='$autor', localizacion='" . $textoLocalizacion . "', esta_creada = '1' WHERE id_publicacion=" . $id_publicacion . "";
                    $this->dbConnection->ejecutarQuery($sql);
                    if ($this->seguridadService->obtenerUsuarioLogueado()->getRol() == 'Admin') {
                        header("location:/admin/publicaciones");
                    } else {
                        header("location:/");
                    }
                } catch (\PDOException $e) {
                    throw new Exception("ERROR - Se produjo un error al crear una publicación " . $e->getMessage());
                }
            }
        } else {
            // Creamos una publicación vacía para poder tener un identificador al que asociar las imágenes
            $sql = "INSERT INTO publicaciones (id_autor) VALUES ($autor)";
            $id_publicacion = $this->dbConnection->ejecutarQuery($sql, true);
        }
        $variablesParaPasarAVista = [ //llevamos el array de objetos 'categorías'
            'categorias' => $categorias,
            'id_publicacion' => $id_publicacion
        ];
        return MostrarVista::mostrarVistaPublica('publicoPublicacionCrearVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /publicacion/ver?id=$id_publicacion
    // función para mostrar una publicación
    public function verPublicacion($id_publicacion)
    {
        $fechaComentario = date('Y-m-d H:i:s');
        if (!empty($_POST['textoComentario']) && isset($_POST['submit'])) {
            $autor = $this->seguridadService->obtenerUsuarioLogueado();
            if ($autor) {
                $autor = $autor->getId_usuario();

                $textoComentario = $_POST['textoComentario'];
                $palabras = $this->queryService->getPalabrasProhibidas();
                print_r($palabras);
                foreach ($palabras as $palabra) {
                    $pos = strpos($textoComentario, $palabra->getPalabra());
                    if ($pos !== false) {
                        MensajeFlash::crearMensaje('Por favor, vuelva a escribir su mensaje sin utilizar alguna de las palabras prohibidas.', 'danger');
                        header("location:/publicacion/ver?id=$id_publicacion");
                        exit;
                    }
                }
            } else {
                MensajeFlash::crearMensaje('Debe iniciar la sesión para poder realizar un comentario.', 'danger');
                header("location:/publicacion/ver?id=$id_publicacion");
            }

            try {
                $sql = "INSERT INTO comentarios (id_publicacion, fecha_comentario, comentario, autor_comentario) VALUES ($id_publicacion, '$fechaComentario', '   " . $_POST['textoComentario']  . "    ', $autor)";
                $this->dbConnection->ejecutarQuery($sql);
                //aquí tengo que destruir el $_POST porque al recargar la página vuelve a crear el comentario
                //(con unset no lo hace, porque sigue teniendo el valor de post)
                //así que redirijo a la misma publicación para vaciar POST
                header("location:/publicacion/ver?id=$id_publicacion");
            } catch (\PDOException $e) {
                throw new Exception("ERROR - No se pudo insertar el comentario " . $e->getMessage());
            }
        }
        $publicacion = $this->queryService->getPublicacion($id_publicacion);
        $categorias = $this->queryService->getCategorias();
        $estadosPublicacion = $this->queryService->getEstadosPublicacion($id_publicacion);
        $variablesParaPasarAVista = [
            'publicacion' => $publicacion,
            'categorias' => $categorias,
            'estadosPublicacion' => $estadosPublicacion
        ];

        return MostrarVista::mostrarVistaPublica('publicoPublicacionVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /usuario/crear
    // función para crear un usuario
    public function crearUsuario(): string
    {
        $rol = 'Usuario';
        if (!empty($_POST['nombre']) & !empty($_POST['apellidos'])) {
            $correo = $_POST['email'];
            $existeMailEnBD = $this->queryService->existeCorreoEnBD($correo);
            if ($existeMailEnBD == true) {
                MensajeFlash::crearMensaje('Email ya registrado en el sistema. Escriba su mail y contraseña para acceder.', 'danger');
                header("location:/login");
                exit;
            }
            try {
                $sql = "INSERT INTO usuarios (rol, nombre, apellidos, email, password,  telefono, direccion, codigo_postal, municipio, provincia)
                    VALUES ('$rol','" . $_POST['nombre'] . "','" . $_POST['apellidos'] . "','" . $_POST['email'] . "','" . md5($_POST['password']) . "','" . $_POST['telefono'] . "','" . $_POST['direccion'] . "','" . $_POST['cpostal'] . "','" . $_POST['municipio'] . "','" . $_POST['provincia'] . "');";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('Email registrado correctamente. Escriba su mail y contraseña para acceder.', 'success');
                header("location:/login");
                exit;
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al insertar un usuario " . $e->getMessage());
            }
        } else {
            $categorias = $this->queryService->getCategorias();
            $variablesParaPasarAVista = [
                'categorias' => $categorias
            ];
            return MostrarVista::mostrarVistaPublica('publicoUsuarioCrearVista.php', $variablesParaPasarAVista);
        }
    }

    // Ruta: /publicaciones/categoria
    // función para ver las categorías de una categoría
    public function verPublicacionesDeCategoria()
    {
        $categoriaSeleccionada = $_POST['categoriaSeleccionada'];
        $publicaciones = $this->queryService->getPublicacionesDeCategoria($categoriaSeleccionada);
        $variablesParaPasarAVista = [
            'publicaciones' => $publicaciones,
            'categoria' => $this->queryService->getNombreCategoria($categoriaSeleccionada),
            'categorias' => $this->queryService->getCategorias()
        ];

        return MostrarVista::mostrarVistaPublica('publicoPublicacionesPorCategoriaVista.php', $variablesParaPasarAVista);
    }


    // Ruta: página no encontrada
    // función que dirige a una página 404
    public function paginaNoEncontrada()
    {
        $categorias = $this->queryService->getCategorias();
        $variablesParaPasarAVista = [
            'categorias' => $categorias
        ];
        return MostrarVista::mostrarVistaPublica('publico404.php', $variablesParaPasarAVista);
    }

    // Ruta: /terminos
    // función que muestra la página de términos y condiciones
    public function paginaTerminos()
    {
        $categorias = $this->queryService->getCategorias();
        $variablesParaPasarAVista = [
            'categorias' => $categorias
        ];
        return MostrarVista::mostrarVistaPublica('publicoTerminos.php', $variablesParaPasarAVista);
    }
}
