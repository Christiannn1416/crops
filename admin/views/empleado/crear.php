<?php require('views/header_admin.php') ?>
<h1 class="text-center"><?php if ($accion == "crear"):
    echo ("Nuevo ");
else:
    echo ("Modificar ");
endif; ?>empleado</h1>
<form action="empleado.php?accion=<?php if ($accion == "crear"):
    echo ('nuevo');
else:
    echo ('modificar&id=' . $id);
endif; ?>" method="post">
    <div class="row mb-3">
        <label for="empleado" class="col-sm-2 col-form-label">Primer Apellido</label>
        <div class="col-sm-10">
            <input type="text" name="data[primer_apellido]" placeholder="Escribe aquí el Primer Apellido"
                class="form-control" value="<?php if (isset($empleados['primer_apellido'])):
                    echo ($empleados['primer_apellido']);
                endif; ?>" />
        </div>
    </div>
    <div class="row mb-3">
        <label for="empleado" class="col-sm-2 col-form-label">Segundo Apellido</label>
        <div class="col-sm-10">
            <input type="text" name="data[segundo_apellido]" placeholder="Escribe aquí el Segundo apellido"
                class="form-control" value="<?php if (isset($empleados['segundo_apellido'])):
                    echo ($empleados['segundo_apellido']);
                endif; ?>" />
        </div>
    </div>
    <div class="row mb-3">
        <label for="empleado" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" name="data[nombre]" placeholder="Escribe aquí el Nombre" class="form-control" value="<?php if (isset($empleados['nombre'])):
                echo ($empleados['nombre']);
            endif; ?>" />
        </div>
    </div>
    <div class="row mb-3">
        <label for="empleado" class="col-sm-2 col-form-label">RFC</label>
        <div class="col-sm-10">
            <input type="text" name="data[rfc]" placeholder="Escribe aquí el RFC" class="form-control" value="<?php if (isset($empleados['rfc'])):
                echo ($empleados['rfc']);
            endif; ?>" />
        </div>
    </div>
    <div class="row mb-3">
        <label for="fotografia" class="col-sm-2 col-form-label">Fotografia</label>
        <div class="col-sm-10">
            <input type="text" name="data[fotografia]" placeholder="Escribe aquí el teléfono" class="form-control"
                value="<?php if (isset($empleados['fotografia'])):
                    echo ($empleados['fotografia']);
                endif; ?>" />
        </div>
    </div>

    <div class="row mb-3">
        <label for="id_usuario" class="col-sm-2 col-form-label">Id_usuario</label>
        <select name="data[id_usuario]" id="" class="form-select">
            <?php foreach ($usuarios as $usuario): ?>
                <?php
                $selected = "";
                if ($empleados['id_usuario'] == $usuario['id_usuario']) {
                    $selected = "selected";
                }
                ?>
                <option value="<?php echo ($usuario['id_usuario']); ?>" <?php echo ($selected); ?>>
                    <?php echo ($usuario['correo']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success" />
</form>