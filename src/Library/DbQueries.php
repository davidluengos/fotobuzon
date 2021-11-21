<?php

namespace App\Library;

use App\Model\Publicacion;

class DbQueries{
    
    public static function getPublicaciones(){
        echo "estoy usando getPublicaciones()";
        $connection = Database::getConnection();
        try {
            $sql = "SELECT id, titulo, contenido FROM publicacion;";
            $resultado = $connection->query($sql);
            $publicaciones = array();
            if ($resultado) {
                $row = $resultado->fetch();
                while ($row != null) {
                    $publicaciones[] = new Publicacion($row);
                    $row = $resultado->fetch();
                }
            }
            $connection = null;
            echo"<pre>";
            print_r ($publicaciones);
            echo "</pre>";
        } catch (\PDOException $e) {
            echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
        }
    }

    public static function eliminarDeVerdadUnaPublicacion($idPublicacion){
        $connection = Database::getConnection();
        echo "estoy eliminando la publicación ".$idPublicacion;
        if ($idPublicacion){
            try {
                $sql = "DELETE FROM publicacion WHERE id = $idPublicacion";
                $resultado = $connection->query($sql);
            } catch (\Exception $e) {
                echo "ERROR - No se pudieron obtener los productos para eliminar: " . $e->getMessage();
            }
        }

    }
}