<?php
namespace App\Library;

class UtilesFicheros
{

    public static function obtenerExtension(string $nombre_fichero): string
    {
        $aux = explode('.', $nombre_fichero);
        return end($aux);
    }
}