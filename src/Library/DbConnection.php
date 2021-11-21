<?php

namespace App\Library;
use App\Model\Publicacion;

use \PDO;

//Con este objeto vamos a conectarnos a la base de datos y mantener guardada la conexión
class DbConnection{
    
    private $connection;

    public function __construct(string $host, string $user, string $password, string $dbName)
    {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $conn;
        } catch(\Exception $e) {
            die('No se pudo conectar a la base de datos: ' . $e->getMessage());
        }
    }
    //devolvemos la conexión
    public function getConnection(){
        return $this->connection;
    }

    public function ejecutarQuery(string $sql, bool $esUnaInsercion = false){
        $this->connection->query($sql);
        if ($esUnaInsercion) {
            return $this->connection->lastInsertId();
        }
    }

    public function ejecutarQueryConResultado(string $sql){
        $resultado = $this->connection->query($sql);
            $datos = array();
            if ($resultado) {
                $row = $resultado->fetch();
                while ($row != null) {
                    $datos[] = $row;
                    $row = $resultado->fetch();
                }
            }
            return $datos;
    }

    public function ejecutarQueryConUnResultado(string $sql){
        $resultado = $this->connection->query($sql);
        if ($resultado) {
            $row = $resultado->fetch();
            return $row;
        }
        return null;
    }       

    
/*
    public function eliminarPublicacion($idPublicacion){
        */

}