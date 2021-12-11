<?php

namespace App\Library;

class MensajeFlash
{
    // función para crear un mensaje. Si no se declara el tipo de mensaje, por defecto será 'info'
    public static function crearMensaje(string $mensaje, string $tipo = 'info'): void
    {
        session_start();
        $_SESSION['mensajeFlash'] = $mensaje;
        $_SESSION['mensajeFlashTipo'] = $tipo;
    }

    // función para mostrar el mensaje
    public static function obtenerMensaje(): string
    {
        @session_start();
        if (isset($_SESSION['mensajeFlash'])) {
            $mensaje = $_SESSION['mensajeFlash'];
            unset($_SESSION['mensajeFlash']);
            $tipo = $_SESSION['mensajeFlashTipo'];
            return '<div class="alert alert-' . $tipo . '" role="alert">' . $mensaje . '</div>';
        }
        return '';
    }
}
