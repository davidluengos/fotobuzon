<section class="section">
    <div class="container">

        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">Editamos el usuario con id: <?php echo $datos['usuario']->getId_Usuario(); ?></h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
            a matter of hours to help you.</p>

        <div class="row">
            <!--Grid column-->
            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="" method="POST">

                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="nombre" class="">Nombre</label>
                                <input type="text" id="nombre" name="nombreEditado" class="form-control" value="<?php echo $datos['usuario']->getNombre(); ?>">
                            </div>
                        </div>
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="apellidos" class="">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidosEditados" class="form-control" value="<?php echo $datos['usuario']->getApellidos(); ?>">
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="email" class="">email</label>
                                <input type="email" id="email" name="emailEditado" class="form-control" value="<?php echo $datos['usuario']->getEmail(); ?>">
                            </div>
                        </div>
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="telefono" class="">Teléfono</label>
                                <input type="text" id="telefono" name="telefonoEditado" class="form-control" value="<?php echo $datos['usuario']->getTelefono(); ?>">
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="direccion" class="">Dirección</label>
                                <input type="text" id="direccion" name="direccionEditada" class="form-control" value="<?php echo $datos['usuario']->getDireccion(); ?>">
                            </div>
                        </div>
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="cp" class="">Código Postal</label>
                                <input type="text" id="cp" name="codigo_postalEditado" class="form-control" value="<?php echo $datos['usuario']->getCodigo_postal(); ?>">
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="municipio" class="">Municipio</label>
                                <input type="text" id="municipio" name="municipioEditado" class="form-control" value="<?php echo $datos['usuario']->getMunicipio(); ?>">
                            </div>
                        </div>
                        <!--Grid column-->
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <label for="provincia" class="">Provincia</label>
                                <input type="text" id="provincia" name="provinciaEditada" class="form-control" value="<?php echo $datos['usuario']->getProvincia(); ?>">
                            </div>
                        </div>
                    </div>




                </form>

                <div class="text-center text-md-left">
                    <a class="primary-btn cta-btn" onclick="document.getElementById('contact-form').submit();">Actualizar Usuario</a>
                </div>
                <div class="status"></div>
            </div>
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