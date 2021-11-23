<div class="section">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3 class="title">Editar publicación</h3>
                <p>
                    <ul>
                        <li>Identificador: <?php echo $datos['publicacion']->getId_Publicacion(); ?></li>
                        <li>Fecha de publicación: <?php echo $datos['publicacion']->getFecha_publicacion(); ?></li>
                        <li>Autor: <?php echo $datos['autor']; ?></li>
                    </ul>
                </p>
            </div>
            <div>
                <form id="contact-form" name="contact-form" action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="billing-details">
                                <div class="form-group">
                                    <label for="titulo" class="">Título</label>
                                    <input type="text" id="titulo" name="tituloEditado" class="form-control" value="<?php echo $datos['publicacion']->getTitulo(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message">Descripción</label>
                                    <textarea type="text" id="message" name="descripcionEditada" rows="2" class="form-control md-textarea"><?php echo $datos['publicacion']->getDescripcion(); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="localizacion" class="">Localización</label>
                                    <input type="text" id="localizacion" name="localizacionEditada" class="form-control" value="<?php echo $datos['publicacion']->getLocalizacion(); ?>">
                                </div>

                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="billing-details">
                                <div class="form-group">
                                    <label for="categoria" class="">Categoría</label>
                                        
                                        
                                    <?php
                                            
                                            $idCategoria = $datos['publicacion']->getCategoria();
                                            echo "Id de categoría en la publicación: ".$idCategoria;
                                            $idPosicionCategoriaEnArray = $idCategoria-1;
                                            echo ". Posición en el array: ".$idPosicionCategoriaEnArray;
                                    ?>
                                    <?php echo "<pre>"; print_r($datos['categorias'][$idCategoria]['categoria']); echo "</pre>";?>
                                    <select name="categoriaEditada" class="form-control" >
                                        <?php
                                        echo "<option selected>". $datos['categorias'][$idPosicionCategoriaEnArray]['categoria'] ."</option>";
                                        foreach ($datos['categorias'] as $categoria) {
                                            //para cada item del array $categoria imprimo el nombre con el código como su value
                                            echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['categoria'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="estado" class="">Estado</label>
                                    <select name="estadoEditado" class="form-control">
                                        <?php
                                        foreach ($datos['estados'] as $estado) {
                                            //para cada item del array $categoria imprimo el nombre con el código como su value
                                            echo '<option value="' . $estado['id_estado'] . '">' . $estado['estado'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="text-center text-md-left">
                        <a class="primary-btn order-submit" onclick="document.getElementById('contact-form').submit();">Actualizar Publicación</a>
                    </div>
                </form>

            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

