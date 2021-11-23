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

        <a class="primary-btn cta-btn botonPublicaciones" href="/admin/palabraprohibida/crear" >Nueva Palabra Prohibida</a>
      </div>
      <table class="table  table-hover table-sm">
        <caption>Lista de Palabras Prohibidas</caption>
        <thead class="">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Palabra Prohibida</th>
            <th scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>
          <?php
          /** @var App\Model\Categoria $categoria */
          foreach ($datos['palabras'] as $palabra) {
          ?>
            <tr>
              <th scope="row"><?php echo $palabra->getId_palabra(); ?></th>
              <td><?php echo $palabra->getPalabra(); ?></td>
              <td>
                <a href="/admin/palabraprohibida/editar?id=<?php echo $palabra->getId_palabra(); ?>"><button>Editar</button></a>
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