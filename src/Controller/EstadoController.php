<?php

namespace App\Controller;

use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Model\Estado;
use App\Service\SeguridadService;
use Exception;

class EstadoController
{
    private $dbConnection;
    private $seguridadService;

    public function __construct(DbConnection $dbC, SeguridadService $seguridadService)
    {
        $this->dbConnection = $dbC;
        $this->seguridadService = $seguridadService;
    }

    //
    //
    // Funciones desarrolladas para los estados: mostrar y editar.
    // No se contempla en el proyecto que se puedan crear nuevos estados, pues algunas funciones dependen del estado.
    //
    //

    // Ruta: /admin/estados
    // función que muestra los estados en la vista de estados del administrador
    public function mostrarEstados(): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);
        try {
            $sql = "SELECT * FROM estados;";
            $estados = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($estados as $key => $estado) {
                $estados[$key] = new Estado($estado);
            }
        } catch (\PDOException $e) {
            throw new Exception("ERROR - Se produjo un error al mostrar los estados " . $e->getMessage());
        }
        $variablesParaPasarAVista = [
            'titulo' => 'Administración de Estados',
            'estados' => $estados
        ];
        return MostrarVista::mostrarVista('adminEstadosVista.php', $variablesParaPasarAVista);
    }

    // RUta: /admin/estado/editar?id=id_estado
    // función que edita los estados en la vista de estados del administrador
    public function editarEstado($idEstado): string
    {
        $this->seguridadService->regirigeALoginSiNoEresRol(["Admin"]);

        $sql = "SELECT * FROM estados WHERE id_estado = $idEstado";
        $publicacionArray = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $estado = new Estado($publicacionArray);
        $variablesParaPasarAVista = [  //solamente hay una variable, que es la publicación
            'estado' => $estado,
        ];

        if (!empty($_POST['estadoEditado'])) {
            try {
                $sql = "UPDATE estados SET 
                    estado = '" . $_POST['estadoEditado'] . "' 
                    WHERE id_estado = " . $idEstado . " ";
                $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/estados"); //redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                throw new Exception("ERROR - Se produjo un error al editar los estados " . $e->getMessage());
            }
        }
        return MostrarVista::mostrarVista('adminEstadosEditarVista.php', $variablesParaPasarAVista);
    }
}
