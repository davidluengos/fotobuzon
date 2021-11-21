	<!-- SECTION -->
	<div class="section">
	    <!-- container -->
	    <div class="container">
	        <!-- row -->
	        <div class="row">
	            <!-- Product main img -->
	            <div class="col-md-5 col-md-push-2">
	                <div id="product-main-img">
						<?php foreach($datos['imagenes'] as $imagen) { ?>
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
					<?php foreach($datos['imagenes'] as $imagen) { ?>
	                    <div class="product-preview">
	                        <img src="<?php echo $imagen->getPath_imagen(); ?>" alt="">
	                    </div>
						<?php } ?>
	                </div>
	            </div>
	            <!-- /Product thumb imgs -->
				<?php
                    foreach ($datos['publicacion'] as $publicacion) {
				?>				
	            <!-- Product details -->
	            <div class="col-md-5">
	                <div class="product-details">
	                    <h2 class="product-name"><?php echo $publicacion->getTitulo(); ?></h2>
	                    <div>
	                    	<!--    <div class="product-rating">
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star"></i>
	                            <i class="fa fa-star-o"></i>
	                        </div>-->
	                        <a class="review-link" href="#">10 Review(s)  </a>
							<p><?php echo $publicacion->getFecha_Publicacion(); ?></p>
	                    </div>
	                    <div>
	                        <h3 class="product-price"><?php echo $datos['categoria']; ?> </h3>
	                        <span class="product-available"><?php 
								$theDate = $publicacion->getFecha_publicacion();
								$fecha = date('d-m-Y', strtotime($theDate));
								echo $fecha; 
							?></span>
	                    </div>
	                    <p><?php echo $publicacion->getDescripcion(); ?></p>
						<!--
	                    <div class="product-options">
	                        <label>
	                            Size
	                            <select class="input-select">
	                                <option value="0">X</option>
	                            </select>
	                        </label>
	                        <label>
	                            Color
	                            <select class="input-select">
	                                <option value="0">Red</option>
	                            </select>
	                        </label>
	                    </div>

	                    <div class="add-to-cart">
	                        <div class="qty-label">
	                            Qty
	                            <div class="input-number">
	                                <input type="number">
	                                <span class="qty-up">+</span>
	                                <span class="qty-down">-</span>
	                            </div>
	                        </div>
	                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
	                    </div>

	                    <ul class="product-btns">
	                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
	                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
	                    </ul>

	                    <ul class="product-links">
	                        <li>Category:</li>
	                        <li><a href="#">Headphones</a></li>
	                        <li><a href="#">Accessories</a></li>
	                    </ul>

	                    <ul class="product-links">
	                        <li>Share:</li>
	                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
	                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
	                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
	                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
	                    </ul>-->
	                <?php
                            } ?>

	                </div>
	            </div>
	            <!-- /Product details -->

	            <!-- Product tab -->
	            <div class="col-md-12">
	                <div id="product-tab">
	                    <!-- product tab nav -->
	                    <ul class="tab-nav">
	                        
	                        <li><a data-toggle="tab" href="#tab1">Comentarios (3)</a></li>
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
	                                        <?php foreach ($datos['comentarios'] as $comentario){
											?>	
											   
											
											
											
												<li>
	                                                <div class="review-heading">
	                                                    <h5 class="name"><?php echo $comentario->getAutor_comentario();?></h5>
	                                                    <p class="date"><?php echo $comentario->getFecha_comentario();?></p>
	                                                    <!--<div class="review-rating">
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star-o empty"></i>
	                                                    </div>-->
	                                                </div>
	                                                <div class="review-body">
	                                                    <p><?php echo $comentario->getComentario();?></p>
	                                                </div>
	                                            </li>
												<?php
											}
											?> 
	                                            <li>
	                                                <div class="review-heading">
	                                                    <h5 class="name">John</h5>
	                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
	                                                     <!--<div class="review-rating">
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star-o empty"></i>
	                                                    </div>-->
	                                                </div>
	                                                <div class="review-body">
	                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
	                                                </div>
	                                            </li>
	                                            <li>
	                                                <div class="review-heading">
	                                                    <h5 class="name">John</h5>
	                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
	                                                     <!--<div class="review-rating">
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star"></i>
	                                                        <i class="fa fa-star-o empty"></i>
	                                                    </div>-->
	                                                </div>
	                                                <div class="review-body">
	                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
	                                                </div>
	                                            </li>
	                                        </ul>
	                                        <ul class="reviews-pagination">
	                                            <li class="active">1</li>
	                                            <li><a href="#">2</a></li>
	                                            <li><a href="#">3</a></li>
	                                            <li><a href="#">4</a></li>
	                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
	                                        </ul>
	                                    </div>
	                                </div>
	                                <!-- /Reviews -->

	                                <!-- Review Form -->
	                                <div class="col-md-4">
	                                    <div id="review-form">
	                                        <form class="review-form">
	                                            <input class="input" type="text" placeholder="Tu nombre">
	                                            <input class="input" type="email" placeholder="Tu email">
	                                            <textarea class="input" placeholder="Tu comentario"></textarea>
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
	                                            <button class="primary-btn">Submit</button>
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