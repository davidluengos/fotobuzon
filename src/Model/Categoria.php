<?php

namespace App\Model;

class Categoria
{
    private $id_categoria;
    private $categoria;

   private $diasPromedioResolucion;

    public function __construct(array $row)
    {
        $this->id_categoria = $row['id_categoria'];
        $this->categoria = $row['categoria'];
    }


    /**
     * Get the value of id_categoria
     */
    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of diasPromedioResolucion
     *
     * @return  self
     */
    public function setDiasPromedioResolucion($diasPromedioResolucion)
    {
        $this->diasPromedioResolucion = $diasPromedioResolucion;

        return $this;
    }

    /**
     * Get the value of diasPromedioResolucion
     */
    public function getDiasPromedioResolucion()
    {
        return $this->diasPromedioResolucion;
    }
}
