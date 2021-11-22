<section class="section">
    <div class="container">
        <!--Section: Contact v.2-->


        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Editar publicación con id: <?php echo $datos['publicacion']->getId_Publicacion(); ?></h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
            a matter of hours to help you.</p>

        <div class="row">

            <!--Grid column-->
            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="" method="POST">



                    <!--Grid row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="titulo" class="">Título</label>
                                <input type="text" id="titulo" name="tituloEditado" class="form-control" value="<?php echo $datos['publicacion']->getTitulo(); ?>">
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-12">

                            <div class="md-form">
                                <label for="message">Descripción</label>
                                <textarea type="text" id="message" name="descripcionEditada" rows="2" class="form-control md-textarea"><?php echo $datos['publicacion']->getDescripcion(); ?></textarea>
                            </div>

                        </div>
                    </div>
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="md-form mb-0">
                            <label for="categoria" class="">Categoría</label>
                            <select name="categoriaEditada" class="form-control">
                                <?php
                                foreach ($datos['categorias'] as $categoria) {
                                    //para cada item del array $categoria imprimo el nombre con el código como su value
                                    echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['categoria'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="localizacion" class="">Localización</label>
                                <input type="text" id="localizacion" name="localizacionEditada" class="form-control" value="<?php echo $datos['publicacion']->getLocalizacion(); ?>">
                            </div>
                        </div>

                    </div>
                </form>

                <div class="text-center text-md-left">
                    <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Actualizar Publicación</a>
                </div>
                <div class="status"></div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>San Francisco, CA 94126, USA</p>
                    </li>

                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+ 01 234 567 89</p>
                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>contact@mdbootstrap.com</p>
                    </li>
                </ul>
            </div>
            <!--Grid column-->


        </div>
    </div>
</section>
<!--Section: Contact v.2-->