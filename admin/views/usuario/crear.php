<?php require('views/header_admin.php') ?>
<h1><?php if ($accion == "crear"):
    echo ("Nuevo ");
else:
    echo ("Modificar ");
endif; ?>usuario</h1>
<form action="usuario.php?accion=<?php if ($accion == "crear"):
    echo ('nuevo');
else:
    echo ('modificar&id=' . $id);
endif; ?>" method="post">
    <div class="row mb-3">
        <label for="usuario" class="col-sm-2 col-form-label">Nombre del usuario</label>
        <div class="col-sm-10">
            <input type="text" name="data[usuario]" placeholder="Escribe aquí el nombre" class="form-control" value="<?php if (isset($usuarios['usuario'])):
                echo ($usuarios['usuario']);
            endif; ?>" />
        </div>
    </div>


    <div class="row mb-3">
        <label for="fecha_creacion" class="col-sm-2 col-form-label">Contraseña</label>
        <div class="col-sm-10">
            <input type="password" name="data[fecha_creacion]" placeholder="Escribe aquí la contraseña"
                class="form-control" value="<?php if (isset($usuarios['fecha_creacion'])):
                    echo ($usuarios['contrasena']);
                endif; ?>" />
        </div>
    </div>
    <?php foreach ($roles as $rol): ?>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                name="rol[<?php echo ($rol['id_rol']); ?>]">
            <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $rol['rol']; ?></label>
        </div>
    <?php endforeach ?>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success" />
</form>
<?php require('views/footer.php') ?>