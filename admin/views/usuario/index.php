<?php require('views/header_admin.php'); ?>
<h1>Usuarios</h1>
<?php if (isset($mensaje)):
    $app->alert($tipo, $mensaje);
endif; ?>
<a href="usuario.php?accion=crear" class="btn btn-success">Nuevo</a>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Correo</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <th scope="row"><?php echo $usuario['id_usuario']; ?></th>
                <td><?php echo $usuario['correo']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="usuario.php?accion=actualizar&id=<?php echo $usuario['id_usuario']; ?>"
                            class="btn btn-primary">Actualizar</a>
                        <a href="usuario.php?accion=eliminar&id=<?php echo $usuario['id_usuario']; ?>"
                            class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require('views/footer.php'); ?>