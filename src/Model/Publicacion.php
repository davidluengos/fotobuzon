<?php

namespace App\Model;

class Publicacion {
    private $id_publicacion;
    private $fecha_publicacion;
    private $titulo;
    private $descripcion;
    private $categoria;
    private $estado;
    private $autor_publicacion;
    private $localizacion;

    private $nombreCategoria;
    private $nombreEstado;
    private $nombreAutor;

    public function __construct(array $row){
        $this->id_publicacion = $row['id_publicacion'];
        $this->fecha_publicacion = $row['fecha_publicacion'];
        $this->titulo = $row['titulo'];
        $this->descripcion = $row['descripcion'];
        $this->categoria = $row['id_categoria'];
        $this->estado = $row['id_estado'];
        $this->autor_publicacion = $row['id_autor'];
        $this->localizacion = $row['localizacion'];
    }

    

    /**
     * Get the value of id_publicacion
     */ 
    public function getId_publicacion()
    {
        return $this->id_publicacion;
    }

    /**
     * Get the value of fecha_publicacion
     */ 
    public function getFecha_publicacion()
    {
        return $this->fecha_publicacion;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Get the value of autor_publicacion
     */ 
    public function getAutor_publicacion()
    {
        return $this->autor_publicacion;
    }

    /**
     * Get the value of localizacion
     */ 
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Set the value of nombreCategoria
     *
     * @return  self
     */ 
    public function setNombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;

        return $this;
    }

    /**
     * Get the value of nombreCategoria
     */ 
    public function getNombreCategoria()
    {
        return $this->nombreCategoria;
    }

    /**
     * Get the value of nombreEstado
     */ 
    public function getNombreEstado()
    {
        return $this->nombreEstado;
    }

    /**
     * Set the value of nombreEstado
     *
     * @return  self
     */ 
    public function setNombreEstado($nombreEstado)
    {
        $this->nombreEstado = $nombreEstado;

        return $this;
    }

    /**
     * Get the value of nombreAutor
     */ 
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    /**
     * Set the value of nombreAutor
     *
     * @return  self
     */ 
    public function setNombreAutor($nombreAutor)
    {
        $this->nombreAutor = $nombreAutor;

        return $this;
    }
}

