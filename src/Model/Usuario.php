<?php

namespace App\Model;

class Usuario
{
    private $id_usuario;
    private $rol;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;
    private $direccion;
    private $codigo_postal;
    private $municipio;
    private $provincia;

    public function __construct(array $row)
    {
        $this->id_usuario = $row['id_usuario'];
        $this->rol = $row['rol'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->email = $row['email'];
        $this->telefono = $row['telefono'];
        $this->direccion = $row['direccion'];
        $this->codigo_postal = $row['codigo_postal'];
        $this->municipio = $row['municipio'];
        $this->provincia = $row['provincia'];
    }

    /**
     * Get the value of id_usuario
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get the value of codigo_postal
     */
    public function getCodigo_postal()
    {
        return $this->codigo_postal;
    }

    /**
     * Get the value of municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Get the value of provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
