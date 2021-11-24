<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="section-title">
				<h3 class="title">Registrar una nueva publicación</h3>
			</div>

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<form id="contact-form" name="contact-form" action="" method="POST">
						<input type="hidden" value="<?php echo $datos['id_publicacion']; ?>" name="id_publicacion" />
						<div class="form-group">
							<input class="input" type="text" name="titulo" placeholder="Título">
						</div>
						<div class="order-notes">
							<textarea class="input" name="descripcion" placeholder="Descripción"></textarea>
						</div>
						<div class="form-group">
							<select class="input" name="categoria" placeholder="Categoría">
								<?php
								foreach ($datos['categorias'] as $categoria) {
									//para cada item del array $categoria imprimo el nombre con el código como su value
									echo '<option value="' . $categoria->getId_categoria() . '">' . $categoria->getCategoria() . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<input class="input" type="email" name="localizacion" placeholder="Localización">
						</div>
						<div class="text-center text-md-left">
							<a class="primary-btn order-submit" onclick="document.getElementById('contact-form').submit();">Enviar</a>
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
				
				<form action="/publicacion/crear-imagen?id_publicacion=<?php echo $datos['id_publicacion'] ?>" class="dropzone" ></form>
			</div>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->