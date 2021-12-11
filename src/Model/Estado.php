<?php

namespace App\Model;

class Estado
{
    private $id_estado;
    private $estado;

    public function __construct(array $row)
    {
        $this->id_estado = $row['id_estado'];
        $this->estado = $row['estado'];
    }



    /**
     * Get the value of id_estado
     */
    public function getId_estado()
    {
        return $this->id_estado;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
