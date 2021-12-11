<?php

namespace App\Model;

class PalabraProhibida
{
    private $id_palabra;
    private $palabra;

    public function __construct(array $row)
    {
        $this->id_palabra = $row['id_palabra'];
        $this->palabra = $row['nombre_palabra'];
    }

    public function getId_palabra()
    {
        return $this->id_palabra;
    }

    public function getPalabra()
    {
        return $this->palabra;
    }
}
