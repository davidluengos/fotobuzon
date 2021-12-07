<div class="section">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h3 class="title">Registro de nuevo usuario</h3>
			</div>
			<div id="messages" class="col-md-12">
				<div class="panel-body" id="panel-errores"></div>
			</div>
			<form id="contact-form" name="contact-form" action="" method="POST" onsubmit="return validarUsuarioNuevo()">
				<div class="col-md-6">
					<div class="billing-details">
						<div class="form-group">
							<input class="input" type="text" name="nombre" id="nombre" placeholder="Nombre">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
						</div>
						<div class="form-group">
							<input class="input" type="email" name="email" id="email" placeholder="Email">
						</div>
						<div class="form-group">
							<input class="input" type="password" name="password" id="password" placeholder="Contraseña">
						</div>
						<div class="form-group">
							<input class="input" type="password" name="password2" id="password2" placeholder="Repite contraseña">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="billing-details">
						<div class="form-group">
							<input class="input" type="text" name="telefono" id="telefono" placeholder="Teléfono">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="direccion" id="direccion" placeholder="Dirección">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="cpostal" id="cpostal" placeholder="Código Postal">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="municipio" id="municipio" placeholder="Municipio">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="provincia" id="provincia" placeholder="Provincia">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-center">
						<input type="checkbox" class="input" name="aceptarTerminos" id="aceptarTerminos"> Acepto los términos y condiciones</input>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-center">
						<input class="primary-btn order-submit" type="submit" value="Enviar" id="btn-enviar" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>