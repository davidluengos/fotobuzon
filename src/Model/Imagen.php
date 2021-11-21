<?php

namespace App\Model;

class Imagen {
    private $id_imagen;
    private $tipo_imagen;
    private $id_objeto;
    private $path_imagen;
    private $nombre_imagen;

    public function __construct(array $row){
        $this->id_imagen = $row['id_imagen'];
        $this->tipo_imagen = $row['tipo_imagen'];
        $this->id_objeto = $row['id_objeto'];
        $this->path_imagen = $row['path_imagen'];
        $this->nombre_imagen = $row['nombre_imagen'];
    }



    /**
     * Get the value of id_imagen
     */ 
    public function getId_imagen()
    {
        return $this->id_imagen;
    }

    /**
     * Get the value of tipo_imagen
     */ 
    public function getTipo_imagen()
    {
        return $this->tipo_imagen;
    }

    /**
     * Get the value of id_objeto
     */ 
    public function getId_objeto()
    {
        return $this->id_objeto;
    }

    /**
     * Get the value of path_imagen
     */ 
    public function getPath_imagen()
    {
        return $this->path_imagen;
    }

    /**
     * Get the value of nombre_imagen
     */ 
    public function getNombre_imagen()
    {
        return $this->nombre_imagen;
    }
}

