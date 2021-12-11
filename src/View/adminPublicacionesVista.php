<section class="section">
  <div class="container">
    <div class="table-responsive fondo">
      <div>
        <div class="encabezado col-md-6">
          <h2 class="tituloh2">
            <?php
            if ($datos['titulo']) {
              echo $datos['titulo'];
            }
            ?>
          </h2>
        </div>
        <div class="col-md-6">
          <div class="header-search botonPublicaciones">
            <form method="post" action="/admin/publicaciones">
              <select class="input-select" name="estadoSeleccionado">
                <option value="">-- Seleccione un estado --</option>
                <?php
                foreach ($datos['estados'] as $estado) {
                  echo "<option value='" . $estado->getId_Estado() . "'>" . $estado->getEstado() . "</option>";
                }
                ?>
              </select>
              <button class="search-btn">Ver</button>
            </form>
          </div>
          <a class="primary-btn cta-btn botonPublicaciones" href="/admin/publicacion/crear">Nueva Publicación</a>
        </div>
      </div>

      <div class="col-md-8">

        <?php

        use App\Library\MensajeFlash;

        echo MensajeFlash::obtenerMensaje() ?>
      </div>
      <table class="table  table-hover table-sm">
        <caption>Lista de Publicaciones</caption>
        <thead class="">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Título</th>
            <th scope="col">Descripción</th>
            <th scope="col">Categoría</th>
            <th scope="col">Estado</th>
            <th scope="col">Autor</th>
            <th scope="col">Localización</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          /** @var App\Model\Publicacion $publicacion */
          foreach ($datos['publicaciones'] as $publicacion) {
          ?>
            <tr>
              <th scope="row"><?php echo $publicacion->getId_Publicacion(); ?></th>
              <td><?php echo $publicacion->getFecha_publicacion(); ?></td>
              <td><?php echo $publicacion->getTitulo(); ?></td>
              <td><?php echo $publicacion->getDescripcion(); ?></td>
              <td><?php echo $publicacion->getNombreCategoria(); ?></td>
              <td><?php echo $publicacion->getNombreEstado(); ?></td>
              <td><?php echo $publicacion->getNombreAutor(); ?></td>
              <td><?php echo $publicacion->getLocalizacion(); ?></td>
              <td>
                <div class="row reference">

                  <a href="/admin/publicacion/ver?id=<?php echo $publicacion->getId_Publicacion(); ?>"><i class="fa fa-eye"></i></a>
                  <a href="/admin/publicacion/editar?id=<?php echo $publicacion->getId_Publicacion(); ?>"><i class="fa fa-edit"></i></a>
                  <form action="/admin/publicacion/eliminar" method="post">
                    <input type="hidden" name="eliminarporpost" value="<?php echo $publicacion->getId_Publicacion(); ?>">
                    <i style='cursor:pointer;' class="fa fa-trash hoverthash" onclick="ConfirmDelete($(this).closest('form'))"></i>
                  </form>
                </div>
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