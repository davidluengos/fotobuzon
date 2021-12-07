<?php

use App\Library\MensajeFlash; ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<?php
					foreach ($datos['publicacion']->getImagenes() as $imagen) { ?>
						<div class="product-preview">
							<img src="<?php echo $imagen->getPath_imagen(); ?>" alt="">
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<?php foreach ($datos['publicacion']->getImagenes() as $imagen) { ?>
						<div class="product-preview">
							<img src="<?php echo $imagen->getPath_imagen(); ?>" alt="">
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-5">
				<div class="product-details">
					<?php echo MensajeFlash::obtenerMensaje() ?>
					<p class="categoria-producto"><?php echo $datos['publicacion']->getNombreCategoria(); ?> </p>
					<h2 class="product-name"><?php echo $datos['publicacion']->getTitulo(); ?></h2>
					<div>
						<p><?php echo $datos['publicacion']->getNumeroComentarios(); ?> Comentario(s) </p>
						<div class="product-label">
							<p class="estado_color"><?php echo $datos['publicacion']->getNombreEstado(); ?></p>
						</div>
					</div>
					<div>
						<p class="product-available">
							<?php
							$theDate = $datos['publicacion']->getFecha_publicacion();
							$fecha = date('d-m-Y', strtotime($theDate));
							echo $fecha;
							?>
						</p>
						<p class="autor_publicacion"><?php echo $datos['publicacion']->getNombreAutor(); ?> </p>
						<p><?php echo $datos['publicacion']->getDescripcion(); ?></p>
					</div>
					<div>
						<?php
						if ($datos['estadosPublicacion']) {
							echo "<table class='table table-hover table-sm'>";
							echo "<caption>Seguimiento de la incidencia</caption>";
							echo "<tr><th scope='col'>Fecha</th><th scope='col'>Estado</th><th scope='col'>Días</th></tr>";
							foreach ($datos['estadosPublicacion'] as $estado) {
								$theDate = $estado['fecha_cambio'];
								$fecha = date('d-m-Y', strtotime($theDate));
								echo "<tr><td>";
								echo $fecha . "</td>";
								echo "<td>" . $estado['estado'] . "</td>";
								echo "<td>" . $estado['diasdesdepublicacion'] . "</td></tr>";
							}
							echo "</table>";
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div id="product-tab">
					<ul class="tab-nav">
						<li><a data-toggle="tab" href="#tab1">Comentarios (<?php echo $datos['publicacion']->getNumeroComentarios(); ?>)</a></li>
					</ul>
					<div class="tab-content">
						<div class="row">
							<div class="col-md-8">
								<div id="reviews">
									<ul class="reviews">
										<?php foreach ($datos['publicacion']->getComentarios() as $comentario) {
										?>
											<li>
												<div class="review-heading">
													<h5 class="name">
														<?php
														echo $comentario['nombre'] . " " . $comentario['apellidos'];
														?></h5>
													<p class="date"><?php echo $comentario['fecha_comentario']; ?></p>
												</div>
												<div class="review-body">
													<p><?php echo $comentario['comentario']; ?></p>
												</div>
											</li>
										<?php
										}
										?>
								</div>
							</div>
							<div class="col-md-4">
								<div id="review-form">
									<form class="review-form" method="post">
										<p>Realiza aquí tu comentario. Debes haber iniciado la sesión.</p>
										<textarea class="input" name="textoComentario" placeholder="Tu comentario"></textarea>
										<button class="primary-btn" name="submit">Enviar comentario</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>