<?php

namespace App\Controller;

use App\Model\Publicacion;
use App\Library\DbConnection;
use App\Library\MostrarVista;
use App\Model\Comentario;
use App\Service\QueriesService;
use App\Service\SeguridadService;

class PublicacionController {

    private $dbConnection;
    private $queryService;
    private $seguridadService;

    public function __construct(DbConnection $dbC, QueriesService $queryService, SeguridadService $seguridadService){
        $this->dbConnection = $dbC;
        $this->queryService = $queryService;
        $this->seguridadService = $seguridadService;
    }


   /*

   public function mostrarPublicaciones() : string {
        $this->seguridadService->regirigeALoginSiNoEresRol("Admin");

        try {
            $sql = "SELECT * FROM publicaciones ORDER BY id_publicacion DESC;";
            $publicaciones = $this->dbConnection->ejecutarQueryConResultado($sql);
            foreach ($publicaciones as $key=>$publicacion){
                $id_estado = $publicacion['id_estado'];
                $id_autor = $publicacion['id_autor'];
                $id_categoria = $publicacion['id_categoria'];
                $nombreCategoria = $this->queryService->getNombreCategoria($id_categoria);
                $nombreEstado = $this->queryService->getNombreEstado($id_estado);
                $nombreAutor = $this->queryService->getNombreAutor($id_autor);
                $publicaciones[$key] = new Publicacion($publicacion);
                $publicaciones[$key]->setNombreCategoria($nombreCategoria);
                $publicaciones[$key]->setNombreEstado($nombreEstado);
                $publicaciones[$key]->setNombreAutor($nombreAutor);

            }
        } catch (\PDOException $e) {
            echo "ERROR - No se pudieron obtener las publicaciones: " . $e->getMessage();
        }
        $variablesParaPasarAVista = [ //llevamos dos variables, el título a mostrar en la página y el array de objetos 'publicaciones'
            'titulo'=>'Mostramos las Publicaciones',
            'publicaciones'=>$publicaciones,
        ];
        return MostrarVista::mostrarVista('adminPublicacionesVista.php', $variablesParaPasarAVista);
        
    }
    public function crearComentario() :string{
        $this->seguridadService->regirigeALoginSiNoEresRol("Admin");
        $categorias = $this->queryService->getCategorias();
        $fecha_comentario = date('Y-m-d H:i:s');
        $id_publicacion= 1;
        $autor = 1;
        if(!empty($_POST['comentario'])){
            try {
                $sql = "INSERT INTO comentarios (id_publicacion, fecha_comentario, comentario, autor_comentario)
                    VALUES ('$id_publicacion', '$fecha_comentario','".$_POST['comentario']."','$autor');";
                echo $sql;
                $comentario = $this->dbConnection->ejecutarQuery($sql);

                header("location:/admin/publicaciones");
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        }else{
            $variablesParaPasarAVista = [ //llevamos el array de objetos 'categorías'
                'categorias'=>$categorias,
            ];
            return MostrarVista::mostrarVista('adminPublicacionCrearVista.php', $variablesParaPasarAVista);
        }

        
    }

    public function eliminarPublicacion($idPublicacion){
        $this->seguridadService->regirigeALoginSiNoEresRol("Admin");
        $idPublicacion = $_POST['eliminarporpost'];
        echo "vamos a eliminar la publicación número ".$idPublicacion;
        if ($idPublicacion){
            try {
                $sql = "DELETE FROM publicaciones WHERE id_publicacion = $idPublicacion";
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/publicaciones");//redirijo a la página de publicaciones después de editar
            } catch (\Exception $e) {
                echo "ERROR - No se pudieron obtener los datos para eliminar: " . $e->getMessage();
            }
        }
        $variablesParaPasarAVista = [];
        return MostrarVista::mostrarVista('adminPublicacionesVista.php', $variablesParaPasarAVista);
    }
   
    public function editarPublicacion($idPublicacion) :string{
        $this->seguridadService->regirigeALoginSiNoEresRol("Admin");
        $categorias = $this->queryService->getCategorias();


        $sql = "SELECT * FROM publicaciones WHERE id_publicacion = $idPublicacion";
        $publicacionArray = $this->dbConnection->ejecutarQueryConUnResultado($sql);
        $publicacionObjeto = new Publicacion($publicacionArray);
        $variablesParaPasarAVista = [  //solamente hay una variable, que es la publicación
            'publicacion'=>$publicacionObjeto,
            'categorias'=>$categorias
        ];
        
        
        if (!empty($_POST['tituloEditado']) & !empty($_POST['descripcionEditada'])) {
            try {
                $sql = "UPDATE publicaciones SET titulo = '".$_POST['tituloEditado']."', descripcion = '".$_POST['descripcionEditada']."', id_categoria ='".$_POST['categoriaEditada']."' , localizacion = '".$_POST['localizacionEditada']."' WHERE id_publicacion = ".$idPublicacion." ";
                $publicaciones = $this->dbConnection->ejecutarQuery($sql);
                header("location:/admin/publicaciones");//redirijo a la página de publicaciones después de editar
            } catch (\PDOException $e) {
                echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
            }
        } 
        return MostrarVista::mostrarVista('adminPublicacionEditarVista.php', $variablesParaPasarAVista);
        
    }

    */
}