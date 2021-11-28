<?php

namespace App\Controller;

use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Model\Estado;
use App\Service\SeguridadService;

class EstadoController
{

    private $dbConnection;
    private $seguridadService;
   

    public function __construct(DbConnection $dbC, SeguridadService $seguridadService){
        $this->dbConnection = $dbC;
        $this->seguridadService = $seguridadService;
        
    }

    // Ruta: /admin/estados
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
            echo "ERROR - No se pudieron obtener los estados: " . $e->getMessage();
        }
        $variablesParaPasarAVista = [ 
            'titulo' => 'Administración de Estados',
            'estados' => $estados
        ];
        return MostrarVista::mostrarVista('adminEstadosVista.php', $variablesParaPasarAVista);
    }

    // RUta: /admin/estado/editar?id=id_estado
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
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        }
        return MostrarVista::mostrarVista('adminEstadosEditarVista.php', $variablesParaPasarAVista);
    }

    
}
