<?php require_once('header.php');
require_once('invernadero.class.php');
$app = new Invernadero();
$data = $app->readAll();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Administrador</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Catálogo
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="invernadero.php">Invernadero</a></li>
                                <li><a class="dropdown-item" href="seccion.php">Secciones</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="empleado.php">Empleado</a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="usuario.php">Usuarios</a></li>
                                <li><a class="dropdown-item" href="rol.php">Roles</a></li>
                                <li><a class="dropdown-item" href="permiso.php">Permisos</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</nav>

<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" }],
            <?php foreach ($data as $invernadero): ?>
                ["<?php echo $invernadero['invernadero'] ?>", <?php echo $invernadero['area'] ?>, "#12e700"],
            <?php endforeach; ?>


        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options = {
            title: "Invernaderos",
            width: 600,
            height: 400,
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
</script>
<div id="columnchart_values" style="width: 900px; height: 300px;"></div> -->