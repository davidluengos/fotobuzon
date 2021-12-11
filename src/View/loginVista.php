<?php

use App\Library\MensajeFlash;

?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="billing-details">
                    <form action="" method="POST">
                        <div class="section-title">
                            <h3 class="title">Inicie sesión</h3>
                        </div>
                        <?php echo MensajeFlash::obtenerMensaje() ?>
                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo @$_POST['email']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="password" name="password" placeholder="Contraseña">
                        </div>
                        <input type="submit" name="submit" id="submit" class="primary-btn order-submit" value="Enviar" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>