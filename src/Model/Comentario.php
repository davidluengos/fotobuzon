<?php

namespace App\Model;

class Comentario {
    private $id_comentario;
    private $id_publicacion;
    private $fecha_comentario;
    private $comentario;
    private $autor_comentario;

    public function __construct(array $row){
        $this->id_comentario = $row['id_comentario'];
        $this->id_publicacion = $row['id_publicacion'];
        $this->fecha_comentario = $row['fecha_comentario'];
        $this->comentario = $row['comentario'];
        $this->autor_comentario = $row['autor_comentario'];
    }


    /**
     * Get the value of id_comentario
     */ 
    public function getId_comentario()
    {
        return $this->id_comentario;
    }

    /**
     * Get the value of id_publicacion
     */ 
    public function getId_publicacion()
    {
        return $this->id_publicacion;
    }

    /**
     * Get the value of fecha_comentario
     */ 
    public function getFecha_comentario()
    {
        return $this->fecha_comentario;
    }

    /**
     * Get the value of comentario
     */ 
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Get the value of autor_comentario
     */ 
    public function getAutor_comentario()
    {
        return $this->autor_comentario;
    }
}

