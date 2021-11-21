<?php

namespace App\Library;
use \PDO;

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'proyectoD';

class Database{

    public static function getConnection(){
        $conn = null;
        try {
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
          } catch(\Exception $e) {
            die('No se pudo conectar a la base de datos: ' . $e->getMessage());
          }
        return $conn;
    }
}