<!-- SECTION -->
	<div class="section">
	    <!-- container -->
	    <div class="container">
	        <!-- row -->
	        <div class="row">
	            <!-- Product main img -->
	            <div class="col-md-5 col-md-push-2">
	                <div id="product-main-img">
						<?php foreach($datos['publicacion']->getImagenes() as $imagen) { ?>
	                    <div class="product-preview">
	                        <img src="<?php echo $imagen->getPath_imagen(); ?>" alt="">
	                    </div>
						<?php } ?>
	                </div>
	            </div>
	            <!-- /Product main img -->

	            <!-- Product thumb imgs -->
	            <div class="col-md-2  col-md-pull-5">
	                <div id="product-imgs">
					<?php foreach($datos['publicacion']->getImagenes() as $imagen) { ?>
	                    <div class="product-preview">
	                        <img src="<?php echo $imagen->getPath_imagen(); ?>" alt="">
	                    </div>
						<?php } ?>
	                </div>
	            </div>
	            <!-- /Product thumb imgs -->
	            <!-- Product details -->
	            <div class="col-md-5">
	                <div class="product-details">
						<p class="categoria-producto"><?php echo $datos['publicacion']->getNombreCategoria(); ?> </p>
	                    <h2 class="product-name"><?php echo $datos['publicacion']->getTitulo(); ?></h2>
	                    <div>
	                    	<!--    <div class="product-rating">
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star-o"></i>
	                        </div>-->
	                        <p><?php echo $datos['publicacion']->getNumeroComentarios(); ?> Comentario(s)  </p>
							
							<div class="product-label">
								<p class="estado_color"><?php echo $datos['publicacion']->getNombreEstado(); ?></p>
							</div>
								
	                    </div>
	                    <div>
							<p class="product-available"><?php 
								$theDate = $datos['publicacion']->getFecha_publicacion();
								$fecha = date('d-m-Y', strtotime($theDate));
								echo $fecha; 
								?></p>
							
							

							<p class="autor_publicacion"><?php echo $datos['publicacion']->getNombreAutor(); ?> </p>
							<p><?php echo $datos['publicacion']->getDescripcion(); ?></p>
	                    </div>
						

	                </div>
	            </div>
	            <!-- /Product details -->

	            <!-- Product tab -->
	            <div class="col-md-12">
	                <div id="product-tab">
	                    <!-- product tab nav -->
	                    <ul class="tab-nav">
	                        
	                        <li><a data-toggle="tab" href="#tab1">Comentarios (<?php echo $datos['publicacion']->getNumeroComentarios(); ?>)</a></li>
	                    </ul>
	                    <!-- /product tab nav -->

	                    <!-- product tab content -->
	                    <div class="tab-content">
	                        

	                        <!-- tab3  -->
	                            <div class="row">
	                                

	                                <!-- Reviews -->
	                                <div class="col-md-8">
	                                    <div id="reviews">
	                                        <ul class="reviews">
	                                        <?php foreach ($datos['publicacion']->getComentarios() as $comentario){
											?>	
												<li>
	                                                <div class="review-heading">
	                                                    <h5 class="name">
														<?php 
                                                            echo $comentario['nombre']." ".$comentario['apellidos'];
                                                         ?></h5>
	                                                    <p class="date"><?php echo $comentario['fecha_comentario'];?></p>
	                                                    <!--<div class="review-rating">
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star-o empty"></i>
	                                                    </div>-->
	                                                </div>
	                                                <div class="review-body">
	                                                    <p><?php echo $comentario['comentario'];?></p>
	                                                </div>
	                                            </li>
												<?php
											}
											?> 
	                                            
	                                        
	                                    </div>
	                                </div>
	                                <!-- /Reviews -->

	                                <!-- Review Form -->
	                                <div class="col-md-4">
	                                    <div id="review-form">
	                                        <form class="review-form" method="post">
	                                            <p>Realiza aquí tu comentario. Debes haber iniciado la sesión.</p>
	                                            <textarea class="input" name="textoComentario" placeholder="Tu comentario"></textarea>
	                                            <!--<div class="input-rating">
	                                                <span>Your Rating: </span>
	                                                <div class="stars">
	                                                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
	                                                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
	                                                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
	                                                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
	                                                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
	                                                </div>
	                                            </div>-->
	                                            <button class="primary-btn" name="submit">Enviar comentario</button>
	                                        </form>
	                                    </div>
	                                </div>
	                                <!-- /Review Form -->
	                        </div>
	                        <!-- /tab3  -->
	                    </div>
	                    <!-- /product tab content  -->
	                </div>
	            </div>
	            <!-- /product tab -->
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	</div>
	<!-- /SECTION -->

	

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