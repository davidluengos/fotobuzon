<section class="section">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h3 class="title">Editar Estado</h3>
			</div>
			<form id="contact-form" name="contact-form" action="" method="POST">
				<div class="col-md-6">
					<div class="billing-details">
						<div class="form-group">
							<input type="text" id="categoria" name="estadoEditado" class="input" value="<?php echo ($datos['estado']->getEstado()); ?>">
						</div>

					</div>
				</div>
				<div class="text-center text-md-left">
					<a class="primary-btn order-submit" onclick="document.getElementById('contact-form').submit();">Actualizar Estado</a>
				</div>
			</form>
		</div>
	</div>
</section>