<?php

namespace App\Controller;

use App\Library\DbConnection;
use App\Library\MensajeFlash;
use App\Library\MostrarVista;
use App\Model\PalabraProhibida;
use App\Service\QueriesService;
use App\Service\SeguridadService;
use Exception;

class PalabraProhibidaController
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
    // Funciones desarrolladas para las palabras prohibidas: mostrar, crear y editar.
    //
    //

    // Ruta: /admin/palabrasprohibidas
    // función que muestra las palabras prohibidas en la vista de palabras prohibidas del administrador
    public function mostrarPalabrasProhibidas(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        try {
            $sql = "SELECT * FROM palabras_prohibidas;";
            $palabras = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($palabras as $key => $palabra) {
                $palabras[$key] = new PalabraProhibida($palabra);
            }
        } catch (\PDOException $e) {
            throw new Exception("ERROR - Se produjo un error al mostrar las palabras prohibidas " . $e->getMessage());
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo' => 'Administración de Palabras Prohibidas',
            'palabras' => $palabras,
        ];
        return MostrarVista::mostrarVista('adminPalabrasProhibidasVista.php', $variablesParaPasarAVista);
    }

    // Ruta: /admin/palabraprohibida/crear
    // función que crea las palabras prohibidas en la vista de palabras prohibidas del administrador
    public function crearPalabraProhibida(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        if (!empty($_POST['palabraprohibida'])) {
            $palabra = $_POST['palabraprohibida'];
            $existePalabraEnBD = $this->queryService->existePalabraEnBD($palabra);
            if ($existePalabraEnBD == true) {
                MensajeFlash::crearMensaje('La palabra prohibida ya está en el sistema.', 'danger');
                header("location:/admin/palabraprohibida/crear");
                exit;
            } 
            try {
                $sql = "INSERT INTO palabras_prohibidas (nombre_palabra) VALUES ('" . $_POST['palabraprohibida'] . "')";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('La palabra prohibida ha sido añadida correctamente.', 'success');
                header("location:/admin/palabrasprohibidas");
                exit;
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al crear las palabras prohibidas " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminPalabraProhibidaCrearVista.php');
    }

    // Ruta: /admin/palabraprohibida/editar?id=id_pp
    // función que edita las palabras prohibidas en la vista de palabras prohibidas del administrador
    public function editarPalabraProhibida($idPalabra): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);

        $sql = "SELECT * FROM palabras_prohibidas WHERE id_palabra = $idPalabra";
        $publicacionArray = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $palabraObjeto = new PalabraProhibida($publicacionArray);
        $variablesParaPasarAVista = [  //solamente hay una variable, que es la publicación
            'palabra' => $palabraObjeto,
        ];

        if (!empty($_POST['palabraEditada'])) {
            $palabra = $_POST['palabraEditada'];
            $existePalabraEnBD = $this->queryService->existePalabraEnBD($palabra);
            if ($existePalabraEnBD == true) {
                MensajeFlash::crearMensaje('La palabra prohibida ya está en el sistema.', 'danger');
                header("location:/admin/palabraprohibida/editar?id=$idPalabra");
                exit;
            } 
            try {
                $sql = "UPDATE palabras_prohibidas SET 
                    nombre_palabra = '" . $_POST['palabraEditada'] . "' 
                    WHERE id_palabra = " . $idPalabra . " ";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('La palabra prohibida ha sido actualizada correctamente.', 'success');
                header("location:/admin/palabrasprohibidas"); //redirijo a la página de publicaciones después de editar
                exit;
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al editar las palabras prohibidas " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminPalabraProhibidaEditarVista.php', $variablesParaPasarAVista);
    }


    // Ruta: /admin/palabraprohibida/eliminar
    // función para eliminar una publicación desde la vista del administrador
    public function eliminarPalabraProhibida($idPalabra)
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        $idPalabra = $_POST['eliminarporpost'];
        if ($idPalabra) {
            try {
                $sql = "DELETE FROM palabras_prohibidas WHERE id_palabra = $idPalabra";
                $this->dbConnection->ejecutarQuery($sql);
                MensajeFlash::crearMensaje('Palabra eliminada correctamente.', 'success');
                header("location:/admin/palabrasprohibidas"); 
                exit;
            } catch (\Exception $e) {
                throw new Exception("ERROR - Se produjo un error al eliminar una publicación " . $e->getMessage());
            }
        }
        $variablesParaPasarAVista = [];
        return MostrarVista::mostrarVista('adminPublicacionesVista.php', $variablesParaPasarAVista);
    }
}
