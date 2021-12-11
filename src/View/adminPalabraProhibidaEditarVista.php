<section class="section">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h3 class="title">Editar palabra prohibida</h3>
			</div>
			<div class="col-md-8">

				<?php

				use App\Library\MensajeFlash;

				echo MensajeFlash::obtenerMensaje() ?>
			</div>
			<form id="contact-form" name="contact-form" action="" method="POST">
				<div class="col-md-6">
					<div class="billing-details">
						<div class="form-group">
							<input type="text" id="categoria" name="palabraEditada" class="input" value="<?php echo($datos['palabra']->getPalabra()); ?>">
						</div>
					</div>
				</div>
				<div class="text-center text-md-left">
					<a class="primary-btn order-submit" onclick="document.getElementById('contact-form').submit();">Actualizar Palabra</a>
				</div>
			</form>
		</div>
	</div>
</section>