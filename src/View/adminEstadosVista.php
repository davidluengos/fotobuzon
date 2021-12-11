<section class="section">
  <div class="container">
    <div class="table-responsive fondo">
      <div class="encabezado">
        <h2 class="tituloh2">
          <?php
          if ($datos['titulo']) {
              echo($datos['titulo']);
          }
          ?>
        </h2>
      </div>
      <div class="col-md-8">

          <?php

          use App\Library\MensajeFlash;

          echo MensajeFlash::obtenerMensaje() ?>
        </div>
      <table class="table  table-hover table-sm">
        <caption>Lista de Estados</caption>
        <thead class="">
          <tr>
            <th scope="col">id</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          /** @var App\Model\Categoria $categoria */
          foreach ($datos['estados'] as $estado) {
              ?>
            <tr>
              <th scope="row"><?php echo $estado->getId_estado(); ?></th>
              <td><?php echo $estado->getEstado(); ?></td>
              <td>
                <a href="/admin/estado/editar?id=<?php echo $estado->getId_estado(); ?>"><i class="fa fa-edit"></i></a>
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