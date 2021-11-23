<!--

<section class="mb-4">

    <h2 class="h1-responsive font-weight-bold text-center my-4">Enviar nueva publicación</h2>
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="titulo" class="">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message">Descripción</label>
                            <textarea type="text" id="descripcion" name="descripcion" rows="2" class="form-control md-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="categoria" class="">Categoría</label>
                            <select name="categoria" class="form-control">
                                <?php
                                foreach ($datos['categorias'] as $categoria) {
                                    //para cada item del array $categoria imprimo el nombre con el código como su value
                                    echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['categoria'] . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="localizacion" class="">Localización</label>
                            <input type="text" id="localizacion" name="localizacion" class="form-control">
                        </div>
                    </div>
                    
                </div>
            </form>

            <div class="text-center text-md-left">
                <a class="primary-btn cta-btn" onclick="document.getElementById('contact-form').submit();">Enviar</a>
            </div>
            <div class="status"></div>
        </div>
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>San Francisco, CA 94126, USA</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+ 01 234 567 89</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>contact@mdbootstrap.com</p>
                </li>
            </ul>
        </div>

    </div>

</section>
-->




<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
                        <form id="contact-form" name="contact-form" action="" method="POST">
							<div class="section-title">
								<h3 class="title">Registar una nueva publicación</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="titulo" placeholder="Título">
							</div>
                            <div class="order-notes">
							<textarea class="input" name="descripcion" placeholder="Descripción"></textarea>
						    </div>
							<div class="form-group">
                                <select class="input" name="categoria"  placeholder="Categoría">
                                <?php
                                foreach ($datos['categorias'] as $categoria) {
                                    //para cada item del array $categoria imprimo el nombre con el código como su value
                                    echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['categoria'] . '</option>';
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
							<form action="/file-upload"
      class="dropzone"
      id="my-awesome-dropzone"></form>
						</div>
						<!-- /Billing Details -->

						

						<!-- Order notes -->
						
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$2940.00</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="#" class="primary-btn order-submit">Place order</a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->