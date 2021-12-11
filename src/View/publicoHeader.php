<header>
	<div id="top-header">
		<div class="container">
			<ul class="header-links pull-left">
				<li><a href="#"><i class="fa fa-phone"></i> +34 111 222 333</a></li>
				<li><a href="#"><i class="fa fa-envelope-o"></i> ayuntamiento@email.com</a></li>
				<li><a href="#"><i class="fa fa-map-marker"></i> Plaza de España 1</a></li>
			</ul>
			<ul class="header-links pull-right">
				<?php
                if (isset($_COOKIE['user'])) {
                    list($user, $password) = explode('|', $_COOKIE['user']);
                    echo "<li><a href='#'><i class='fa fa-user-o'></i>" . $user . "</a></li>";
                    echo "<li><a href='/logout'><i class='fa fa-sign-out'></i>Salir</a></li>";
                } else {
                    echo "<li><a href='/usuario/crear'><i class='fa fa-user-o'></i>Nuevo Usuario</a></li>";
                    echo "<li><a href='/login'><i class='fa fa-user-o'></i>Login</a></li>";
                }
                ?>
			</ul>
		</div>
	</div>
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="logotipo">
						<a href="/">FOTOBUZÓN</a>
					</div>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="header-search">
						<form method="post" action="/publicaciones/categoria">
							<select class="input-select" name="categoriaSeleccionada">
								<option value="">-- Seleccione una categoría --</option>
								<?php
                                foreach ($datos['categorias'] as $categoria) {
                                    echo "<option value='" . $categoria->getId_categoria() . "'>" . $categoria->getCategoria() . "</option>";
                                }

                                ?>
							</select>
							<button class="search-btn">Ver</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>