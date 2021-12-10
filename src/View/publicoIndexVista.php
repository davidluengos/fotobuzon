<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<h2 class="text-uppercase">Envíanos tu sugerencia</h2>
				<p>Bienvenidos a Fotobuzón, el registro de incidencias de tu Ayuntamiento.</p>
				<p>Ayuda a tu ciudad a ser una mejor comunidad gracias a tus sugerencias. </p>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="enviarsugerencia botonPublicaciones">
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
												<img src="./img/fotobuzon.jpg" alt="">
											<?php } ?>
											<div class="product-label">
												<span class="new"><?php echo $publicacion->getNombreCategoria(); ?></span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">
												<?php
												$theDate = $publicacion->getFecha_publicacion();
												$fecha = date('d-m-Y', strtotime($theDate));
												echo $fecha; ?>
											</p>
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
												<i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-down"></i>
												<i class="fa fa-chevron-down"></i>
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
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Gráfico con los días de resolución-->
<div class="section chart-section button-top">
	<div class="container">
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
								echo "'{$categoria->getDiasPromedioResolucion()}',";
							} ?>
						];
						var data = {
							labels: etiquetas,
							datasets: [{
								label: 'Tiempo Promedio de Resolución (días)',
								backgroundColor: 'rgb(209, 0, 36)',
								borderColor: 'rgb(209, 0 , 36)',
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
	</div>
</div>