<?php

namespace App\Controller;

use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Model\PalabraProhibida;
use App\Service\QueriesService;
use App\Service\SeguridadService;
use Exception;

class PalabraProhibidaController
{

    private $dbConnection;
    private $seguridadService;

    public function __construct(DbConnection $dbC, SeguridadService $seguridadService)
    {
        $this->dbConnection = $dbC;
        $this->seguridadService = $seguridadService;
    }

    // Ruta: /admin/palabrasprohibidas
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
    public function crearPalabraProhibida(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        if (!empty($_POST['palabraprohibida'])) {
            echo $_POST['palabraprohibida'];
            try {
                $sql = "INSERT INTO palabras_prohibidas (nombre_palabra) VALUES ('" . $_POST['palabraprohibida'] . "')";
                $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/palabrasprohibidas");
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al crear las palabras prohibidas " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminPalabraProhibidaCrearVista.php');
    }

    // Ruta: /admin/palabraprohibida/editar?id=id_pp
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
            try {
                $sql = "UPDATE palabras_prohibidas SET 
                    nombre_palabra = '" . $_POST['palabraEditada'] . "' 
                    WHERE id_palabra = " . $idPalabra . " ";
                $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/palabrasprohibidas"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al editar las palabras prohibidas " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminPalabraProhibidaEditarVista.php', $variablesParaPasarAVista);
    }
}
