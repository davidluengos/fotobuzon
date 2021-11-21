	
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +34 111 222 333</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> ayuntamiento@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Plaza de España 1</a></li>
					</ul>
					<ul class="header-links pull-right">
						
						<?php 
							if(isset($_COOKIE['emailCookie'])){
								echo "<li><a href='#'><i class='fa fa-user-o'></i>".$_COOKIE['emailCookie'] . "</a></li>";
								echo "<li><a href='/logout'><i class='fa fa-sign-out'></i>Salir</a></li>";



								//" <a href='/logout'>"."    &nbsp&nbsp&nbsp "."<i class='fa fa-sign-out'></i>Salir</a>";
							} else{
								echo "<li><a href='/login'><i class='fa fa-user-o'></i>Login</a></li>";
							}
						?>



							
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							
							<div class="logotipo">
								<a href="/">FOTOBUZÓN</a>
								</div>
						</div>
						<!-- /LOGO -->
						<!-- LOGO -->
						<div class="col-md-3">
							
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">Todas las categorías</option>
										<option value="1">Mobiliario urbano</option>
										<option value="1">Parques y jardines</option>
									</select>
									
									<button class="search-btn">Buscar</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		