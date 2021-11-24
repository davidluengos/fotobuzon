<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<h2 class="text-uppercase">Envíanos tu sugerencia</h2>
				<p>¡Bienvenidos a Fotobuzón!</p>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="enviarsugerencia">
					<a class="primary-btn cta-btn" href="/publicacion/crear">Nueva publicación</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Últimas Publicaciones Recibidas</h3>
					
				</div>
			</div>
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<div id="tab1" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-1">
								<?php
								foreach ($datos['publicaciones'] as $publicacion) {
									$imagenPrincipal = $publicacion->getImagenPrincipal();
								?>
									<div class="product">
										<div class="product-img">
											<?php if ($imagenPrincipal) { ?>
												<img src="<?php echo $imagenPrincipal->getPath_imagen() ?>" alt="">
											<?php } else { ?>
												<img src="./img/product01.png" alt="">
											<?php } ?>
											<div class="product-label">
												<span class="new"><?php echo $publicacion->getNombreCategoria(); ?></span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category"><?php
																		$theDate = $publicacion->getFecha_publicacion();
																		$fecha = date('d-m-Y', strtotime($theDate));
																		echo $fecha; ?></p>
											<h3 class="product-name"><a href="#"><?php echo $publicacion->getTitulo() ?></a></h3>
											<p><?php
												$descripcion =  $publicacion->getDescripcion();
												$descripcionCorta = substr($descripcion, 0, 100);
												echo $descripcionCorta;
												if ((strlen($descripcion)) > 100) {
													echo "...";
												}
												?></p>
											<div class="product-rating">

												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<?php echo $publicacion->getNumeroComentarios(); ?> <i class="fa fa-comments"></i>
											</div>
										</div>
										<div class="add-to-cart">
											<a href="/publicacion/ver?id=<?php echo $publicacion->getId_Publicacion(); ?>">
												<button class="add-to-cart-btn"><i class="fa fa-eye"></i> Ver Publicación</button>
											</a>
										</div>
									</div>

								<?php
								}
								?>
								<!-- /product -->


							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div class="section chart-section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">

				<div class="hot-deal">
					<h2 class="text-uppercase">¿Cuánto se tarda en resolver las incidencias?</h2>
					<p>Aquí puedes ver el tiempo promedio de resolución por categorías</p>

					<div>
						<canvas id="myChart"></canvas>
					</div>

					<script>
						var etiquetas = [
							<?php foreach ($datos['categorias'] as $categoria) {
								echo "'{$categoria->getCategoria()}',";
							} ?>
						];

						var numeros = [
							<?php foreach ($datos['categorias'] as $categoria) {
								echo "'" . rand(0, 100) . "',";
							} ?>
						];

						var data = {
							labels: etiquetas,
							datasets: [{
								label: 'Tiempo Promedio de Resolución (días)',
								backgroundColor: 'rgb(0, 99, 132)',
								borderColor: 'rgb(255, 99, 132)',
								data: numeros,
							}]
						};
						var config = {
							type: 'bar',
							data: data,
							options: {}
						};
					</script>



				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->


<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form>
						<input class="input" type="email" placeholder="Enter Your Email">
						<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
					</form>
					<ul class="newsletter-follow">
						<li>
							<a href="#"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->