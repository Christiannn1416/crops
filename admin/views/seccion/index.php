<?php require('views/header.php') ?>
    <h1>Secciones</h1>
    <?php if(isset($mensaje)):$app->alert($tipo,$mensaje); endif;?>
    <a href="seccion.php?accion=crear" class="btn btn-success">Nuevo<a>
    
    <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Área</th>
      <th scope="col">Id invernadero</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($secciones as $seccion): ?>
    <tr>
      <th scope="row"><?php echo $seccion['id_seccion']; ?> </th>
      <td><?php echo $seccion['seccion']; ?></td>
      <td><?php echo $seccion['area']; ?></td>
      <td><?php echo $seccion['id_invernadero']; ?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <a href="seccion.php?accion=actualizar&id=<?php echo $seccion['id_seccion']; ?>" class="btn btn-primary" style="margin-right:1rem;">Actualizar</a>
            <a href="seccion.php?accion=eliminar&id=<?php echo $seccion['id_seccion']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

<?php require('views/footer.php') ?>