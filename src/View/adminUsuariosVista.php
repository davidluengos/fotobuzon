<section class="section">
  <div class="container">
    <div class="table-responsive fondo">
      <div class="encabezado">
        <h2 class="tituloh2">
          <?php
          if ($datos['titulo']) {
            echo $datos['titulo'];
          }
          ?>
        </h2>
          
        <a class="primary-btn cta-btn botonPublicaciones" href="/admin/usuario/crear" >Nuevo Usuario</a>
      </div>
      <table class="table  table-hover table-sm">
        <caption>Lista de Usuarios</caption>
        <thead class="">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Rol</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
            <th scope="col">CP</th>
            <th scope="col">Municipio</th>
            <th scope="col">Provincia</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          /** @var App\Model\Usuario $usuario */
          foreach ($datos['usuarios'] as $usuario) {
          ?>
            <tr>
              <th scope="row"><?php echo $usuario->getId_usuario(); ?></th>
              <td><?php echo $usuario->getRol(); ?></td>
              <td><?php echo $usuario->getNombre(); ?></td>
              <td><?php echo $usuario->getApellidos(); ?></td>
              <td><?php echo $usuario->getEmail(); ?></td>
              <td><?php echo $usuario->getTelefono(); ?></td>
              <td><?php echo $usuario->getDireccion(); ?></td>
              <td><?php echo $usuario->getCodigo_postal(); ?></td>
              <td><?php echo $usuario->getMunicipio(); ?></td>
              <td><?php echo $usuario->getProvincia(); ?></td>
              <td>
                <a href="/admin/usuario/editar?id=<?php echo $usuario->getId_usuario(); ?>"><button>Editar</button></a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>