<?php

namespace App\Library;

class UtilesFicheros
{
    // función que devuelve la extensión de un fichero
    public static function obtenerExtension(string $nombre_fichero): string
    {
        $aux = explode('.', $nombre_fichero);
        return end($aux);
    }

    // función que genera el nombre de una imagen recortada desde una ruta
    public static function generarRutaImagenRecortada(string $ruta): string
    {
        $aux = explode('/', $ruta);
        $nombre_fichero_con_extension = end($aux);
        list($nombre_fichero, $extension) = explode('.', $nombre_fichero_con_extension);
        return str_replace($nombre_fichero_con_extension, $nombre_fichero . '_recortada.'.$extension, $ruta);
    }


    // función que coge la imagen subida en un formulario y la coipa a la carpeta web/uploads
    public static function crearImagen(string $file, int $id_publicacion): string
    {
        $extension = self::obtenerExtension($file);
        $nombre_random = substr(md5((string) mt_rand()), 0, 10);
        $ruta_imagen_navegador = '/uploads/' . $id_publicacion . '/' . $nombre_random . '.' . $extension;
        $ruta_imagen_fisica = '../web/uploads/' . $id_publicacion . '/' . $nombre_random . '.' . $extension;
        $ruta_imagen_fisica_recortada = self::generarRutaImagenRecortada($ruta_imagen_fisica);
        if (!is_dir('../web/uploads/' . $id_publicacion . '/')) {
            mkdir('../web/uploads/' . $id_publicacion . '/', 0777, true);
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $ruta_imagen_fisica);

        self::recortarImagen($ruta_imagen_fisica, $ruta_imagen_fisica_recortada);
        return $ruta_imagen_navegador;
    }

    // función que recorta una imagen cuya ruta se pasa por parámetro ($src) y la guarda con el nombre $filename
    public static function recortarImagen(string $src, string $filename)
    {
        $image = imagecreatefromjpeg($src);

        $thumb_width = 500;
        $thumb_height = 500;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ($original_aspect >= $thumb_aspect) {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        } else {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled(
            $thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
            0 - ($new_height - $thumb_height) / 2, // Center the image vertically
            0,
            0,
            $new_width,
            $new_height,
            $width,
            $height
        );
        imagejpeg($thumb, $filename, 80);
    }
}
