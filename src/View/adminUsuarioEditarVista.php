<section class="section">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3 class="title">Editar usuario registrado</h3>
                <p>
                <ul>
                    <li>Identificador de usuario: <?php echo $datos['usuario']->getId_Usuario(); ?></li>
                    <li>Rol: <?php echo $datos['usuario']->getRol(); ?></li>
                </ul>
                </p>
            </div>
            <form id="contact-form" name="contact-form" action="" method="POST">
                <div class="col-md-6">
                    <div class="billing-details">
                        <div class="form-group">
                            <input type="text" id="nombre" name="nombreEditado" class="input" value="<?php echo $datos['usuario']->getNombre(); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="apellidos" name="apellidosEditados" class="input" value="<?php echo $datos['usuario']->getApellidos(); ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="emailEditado" class="input" value="<?php echo $datos['usuario']->getEmail(); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="telefono" name="telefonoEditado" class="input" value="<?php echo $datos['usuario']->getTelefono(); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="billing-details">

                        <div class="form-group">
                            <input type="text" id="direccion" name="direccionEditada" class="input" value="<?php echo $datos['usuario']->getDireccion(); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="cp" name="codigo_postalEditado" class="input" value="<?php echo $datos['usuario']->getCodigo_postal(); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="municipio" name="municipioEditado" class="input" value="<?php echo $datos['usuario']->getMunicipio(); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="provincia" name="provinciaEditada" class="input" value="<?php echo $datos['usuario']->getProvincia(); ?>">
                        </div>
                    </div>
                </div>
                <div class="text-center text-md-left">
                    <a class="primary-btn cta-btn" onclick="document.getElementById('contact-form').submit();">Actualizar Usuario</a>
                </div>
            </form>
        </div>
    </div>
</section>