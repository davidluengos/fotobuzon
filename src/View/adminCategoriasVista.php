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
        <a class="primary-btn cta-btn botonPublicaciones" href="/admin/categoria/crear">Nueva Categoría</a>
        <table class="table  table-hover table-sm">
          <caption>Lista de Categorías</caption>
          <thead class="">
            <tr>
              <th scope="col">id</th>
              <th scope="col">Categoría</th>
              <th scope="col">Acciones</th>

            </tr>
          </thead>
          <tbody>
            <?php
            /** @var App\Model\Categoria $categoria */
            foreach ($datos['categorias'] as $categoria) {
            ?>
              <tr>
                <th scope="row"><?php echo $categoria->getId_Categoria(); ?></th>
                <td><?php echo $categoria->getCategoria(); ?></td>
                <td>
                  <a href="/admin/categoria/editar?id=<?php echo $categoria->getId_categoria(); ?>"><button>Editar</button></a>
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