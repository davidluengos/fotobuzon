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

      <a class="btn btn-primary botonPublicaciones" href="/admin/publicacion/crear" role="button">Nueva Publicación</a>
    </div>
    <table class="table  table-hover table-sm">
      <caption>Lista de publicaciones</caption>
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
              <a href="/admin/publicacion/editar?id=<?php echo $publicacion->getId_Publicacion(); ?>"><button>Editar</button></a>
              <form action="/admin/publicacion/eliminar" method="post">
                <input type="hidden" name="eliminarporpost" value="<?php echo $publicacion->getId_Publicacion(); ?>">
                <input type="submit" name="eliminar" value="Eliminar">

              </form>
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