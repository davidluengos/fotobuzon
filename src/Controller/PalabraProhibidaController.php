<?php

namespace App\Controller;

use App\Model\Categoria;
use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Model\PalabraProhibida;
use App\Service\QueriesService;
use App\Service\SeguridadService;

class PalabraProhibidaController
{

    private $dbConnection;
    private $queryService;
    private $seguridadService;

    public function __construct(DbConnection $dbC, QueriesService $queryService, SeguridadService $seguridadService){
        $this->dbConnection = $dbC;
        $this->queryService = $queryService;
        $this->seguridadService = $seguridadService;
    }


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
            echo "ERROR - No se pudieron obtener las publicaciones: " . $e->getMessage();
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo' => 'Administración de Palabras Prohibidas',
            'palabras' => $palabras,
        ];
        return MostrarVista::mostrarVista('adminPalabrasProhibidasVista.php', $variablesParaPasarAVista);
    }

    public function crearPalabraProhibida(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        if (!empty($_POST['palabraprohibida'])) {
            echo $_POST['palabraprohibida'];
            try {
                $sql = "INSERT INTO palabras_prohibidas (nombre_palabra) VALUES ('" . $_POST['palabraprohibida'] . "')";
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/palabrasprohibidas");
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener las categorías: " . $e->getMessage();
            }
        }
        return MostrarVista::mostrarVista('adminPalabraProhibidaCrearVista.php');
    }

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
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/palabrasprohibidas"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        }
        return MostrarVista::mostrarVista('adminPalabraProhibidaEditarVista.php', $variablesParaPasarAVista);
    }
}
