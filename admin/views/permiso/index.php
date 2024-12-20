<?php require('views/header_admin.php'); ?>
<h1>Permisos</h1>
<?php if (isset($mensaje)):
    $app->alert($tipo, $mensaje);
endif; ?>
<a href="permiso.php?accion=crear" class="btn btn-success">Nuevo</a>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">I</th>
            <th scope="col">Permiso</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($permisos as $permiso): ?>
            <tr>
                <th scope="row"><?php echo $permiso['id_permiso']; ?></th>
                <td><?php echo $permiso['permiso']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="permisos.php?accion=actualizar&id=<?php echo $permiso['id_permiso']; ?>"
                            class="btn btn-primary">Actualizar</a>
                        <a href="permisos.php?accion=eliminar&id=<?php echo $permiso['id_permiso']; ?>"
                            class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require('views/footer.php'); ?>