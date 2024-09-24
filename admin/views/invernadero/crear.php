<?php require('views/header.php') ?>
<h1>Nuevo Invernadero</h1>
<form action="invernadero.php?accion=nuevo" method="post">
    <div class="row mb-3">
                <label for="invernadero" class="col-sm-2 col-form-label">Nombre del Invernadero</label>
            <div class="col-sm-10">
                <input type="text" name="data[invernadero]" placeholder="Escribe aquí el nombre" class="form-control"/>
            </div>
    </div>
    <div class="row mb-3">
        <label for="latitud" class="col-sm-2 col-form-label">Latitud</label>
        <div class="col-sm-10">
            <input type="number" name="data[latitud]" placeholder="Escribe aquí la latitud" class="form-control"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="longitud" class="col-sm-2 col-form-label">Longitud</label>
        <div class="col-sm-10">
            <input type="number" name="data[longitud]" placeholder="Escribe aquí la longitud" class="form-control"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="area" class="col-sm-2 col-form-label">Área del invernadero (m<sup>2</sup>)</label>
        <div class="col-sm-10">
            <input type="number" name="data[area]" placeholder="Escribe aquí el nombre" class="form-control" />
        </div>
    </div>
    <div class="row mb-3">
        <label for="fecha_creacion" class="col-sm-2 col-form-label">Fecha de creación</label>
        <div class="col-sm-10">
            <input type="date" name="data[fecha_creacion]" placeholder="Escribe aquí el nombre" class="form-control"/>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>