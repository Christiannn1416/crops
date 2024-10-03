<?php require('views/header.php') ?>
<h1><?php if($accion == "crear"):echo("Nuevo ");else: echo("Modificar ");endif;  ?>Seccion</h1>
<form action="seccion.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif;?>" method="post">
    <div class="row mb-3">
                <label for="seccion" class="col-sm-2 col-form-label">Nombre de la Seccion</label>
            <div class="col-sm-10">
                <input type="text" name="data[seccion]" placeholder="Escribe aquí el nombre" class="form-control" value="<?php if(isset($secciones['seccion'])):echo($secciones['seccion']);endif; ?>"/>
            </div>
    </div>
    <div class="row mb-3">
        <label for="area" class="col-sm-2 col-form-label">Área de la sección (m<sup>2</sup>)</label>
        <div class="col-sm-10">
            <input type="number" name="data[area]" placeholder="Escribe aquí el área" class="form-control" value="<?php if(isset($secciones['area'])):echo($secciones['area']);endif; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="id_invernadero" class="col-sm-2 col-form-label">Id del invernadero</label>
        <div class="col-sm-10">
            <input type="number" name="data[id_invernadero]" placeholder="Escribe aquí el invernadero a la que pertenece la sección" class="form-control" value="<?php if(isset($secciones['id_invernadero'])):echo($secciones['id_invernadero']);endif; ?>"/>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>