<?php

namespace App\Library;

class MostrarVista
{

    public static function mostrarVista(string $rutaVista, array $datos = []): string
    {
        ob_start();
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        include('../src/View/publicoHead.php');
        echo "<body class='fondo'>";
        include('../src/View/adminHeader.php');
        include('../src/View/adminNav.php');
        include('../src/View/' . $rutaVista);
        include('../src/View/publicoFooter.php');
        echo "</body>";
        echo "</html>";
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public static function mostrarVistaPublica(string $rutaVista, array $datos = []): string
    {
        ob_start();
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        include('../src/View/publicoHead.php');
        echo "<body>";
        include('../src/View/publicoHeader.php');
        include('../src/View/' . $rutaVista);
        include('../src/View/publicoFooter.php');
        echo "</body>";
        echo "</html>";
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }
}
