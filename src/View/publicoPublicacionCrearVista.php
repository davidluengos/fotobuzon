<?php

use App\Library\MensajeFlash; ?>
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="section-title">
				<h3 class="title">Registrar una nueva publicación</h3>
			</div>

			<div id="messages" class="col-md-12">
				<div class="panel-body" id="panel-errores"></div>
				<?php echo MensajeFlash::obtenerMensaje() ?>
			</div>

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<form id="contact-form" name="contact-form" action="" method="POST" onsubmit="return validarCrearPublicacion()">
						<input type="hidden" value="<?php echo $datos['id_publicacion']; ?>" name="id_publicacion" />
						<?php echo MensajeFlash::obtenerMensaje() ?>
						<div class="form-group">
							<input class="input" type="text" name="titulo" id="titulo" placeholder="Título"  value="<?php echo @$_POST['titulo']?>">
						</div>
						<div class="order-notes">
							<textarea class="input" name="descripcion" id="descripcion" placeholder="Descripción" ><?php echo @$_POST['descripcion']?></textarea>
						</div>
						<div class="form-group">
							<select class="input" name="categoria" id="categoria" placeholder="Categoría">
								<option value=''>-- Seleccione una categoría --</option>
								<?php
								foreach ($datos['categorias'] as $categoria) {
									//para cada item del array $categoria imprimo el nombre con el código como su value
									echo '<option value="' . $categoria->getId_categoria() . '" '.(($categoria->getId_categoria() == @$_POST['categoria'])?'selected':'').'>' . $categoria->getCategoria() . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="localizacion" id="localizacion" placeholder="Localización"   value="<?php echo @$_POST['localizacion']?>">
						</div>
						<div class="col-md-6">
							<div class="text-center">
								<input type="checkbox" class="input" name="aceptarTerminos" id="aceptarTerminos" <?php echo ((isset($_POST['aceptarTerminos']))?'checked':'')?>> Acepto los términos y condiciones</input>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-center">
								<input class="primary-btn order-submit" type="submit" value="Enviar" id="btn-enviar" />
							</div>
						</div>

					</form>

				</div>
				<!-- /Billing Details -->



				<!-- Order notes -->

				<!-- /Order notes -->
			</div>

			<!-- Order Details -->
			<div class="col-md-5 order-details">
				<div class="section-title text-center">
					<h3 class="title">Imágenes</h3>
				</div>

				<form action="/publicacion/crear-imagen?id_publicacion=<?php echo $datos['id_publicacion'] ?>" class="dropzone"></form>
			</div>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->