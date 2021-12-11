<?php

use App\Library\MensajeFlash;

?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3 class="title">Publicaciones de la categoría de <?php echo $datos['categoria']; ?></h3>
                
            </div>
            <?php echo MensajeFlash::obtenerMensaje() ?>
            <?php foreach ($datos['publicaciones'] as $publicacion) {
    ?>
                <div class="col-md-6 col-xs-6">
                    <div class="product-widget">
                        <div class="product-img">
                            <?php $imagenPrincipal = $publicacion->getImagenPrincipal();
    if ($imagenPrincipal) { ?>
                                <img src="<?php echo $imagenPrincipal->getPath_imagen(true) ?>" alt="">
                            <?php } else { ?>
                                <img src="./img/fotobuzon.jpg" alt="">
                            <?php } ?>
                        </div>
                        <div class="product-body">
                            <p class="product-category">
                                <?php
                                $theDate = $publicacion->getFecha_publicacion();
    $fecha = date('d-m-Y', strtotime($theDate));
    echo $fecha; ?>
                            </p>
                            <h3 class="product-name"><a href="/publicacion/ver?id=<?php echo $publicacion->getId_Publicacion(); ?>"><?php echo $publicacion->getTitulo(); ?></a></h3>
                            <p><?php $descripcion =  $publicacion->getDescripcion();
    $descripcionCorta = substr($descripcion, 0, 100);
    echo $descripcionCorta;
    if ((strlen($descripcion)) > 100) {
        echo "...";
    } ?>
                            </p>
                            <h4 class="product-price"><?php echo $publicacion->getNombreEstado(); ?></h4>
                        </div>
                    </div>
                </div>
            <?php
} ?>
        </div>
    </div>
</div>